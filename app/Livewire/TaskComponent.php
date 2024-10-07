<?php

namespace App\Livewire;

use App\Mail\SharedTask;
use App\Models\Task;
use Livewire\Component;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\Types\Null_;


class TaskComponent extends Component
{
    public $tasks = [];
    public $title;
    public $id;
    public $description;
    public $modal = false; // permite abrir el modal que vamos a crear con la tarea 
    public $users = [];
    public $isUpdating = false;
    public $miTarea = null;
    public $permiso;
    public $modalShare = false;
    public $user_id;

    public function mount()
    {
        $this->users = User::where('id', '!=', auth()->user()->id)->get(); // devuelve los usuarios no autenticados
        $this->tasks = $this->getTask();
    }
    // la funcion siguiente renderiza todas las tareas
    public function getTask()
    {
        $user = auth()->user(); // auth() se refiere al usuario autenticado 
        $misTareas = Task::where('user_id', auth()->user()->id)->get(); // esta linea recupera todas las tareas en la que aparece mi
        $misSharedTasks = $user->sharedTasks()->get();
        return $misSharedTasks->merge($misTareas);
    }

    public function renderAllTasks()
    {
        $this->tasks = $this->getTask()->sortByDesc('id');
    }

    public function render()
    {

        return view('livewire.task-component');
    }

    private function clearFields()
    {
        $this->title = '';
        $this->description = '';
    }
    public function openCreateModal(Task $task = null)
    {
        $this->isUpdating = false;
        if ($task) {
            $this->miTarea = $task;
            $this->title =  $task->title;
            $this->description = $task->description;
            $this->id = $task->id;
        } else {
            $this->clearFields();
        }
        $this->modal = true;
    }

    public function closeCreateModal()
    {
        $this->modal = false;
    }
    public function createOrUpdateTask()
    {
        if ($this->miTarea->id) {
            $task = Task::find($this->miTarea->id);
            $task->update([
                'title' => $this->title,
                'description' => $this->description
            ]);
        } else {
            $task = Task::create([
                'title' => $this->title,
                'description' => $this->description,
                'user_id' => auth()->user()->id
            ]);
        }


        $this->clearFields();
        $this->modal = false;
        $this->tasks = $this->getTask()->sortByDesc('id');
    }

    public function updateTask(Task $task)
    {
        $this->title = $task->title;
        $this->description = $task->description;
        $this->modal = true; // abrirá el modal para la edición de la tarea 
    }

    public function deleteTask(Task $task)
    {
        $task->delete();
        $this->tasks = $this->getTask()->sortByDesc('id');
    }
    public function removeAllTasks() {}

    public function openShareModal(Task $task)
    {

        $this->modalShare = true;
        $this->miTarea = $task;
    }
    public function shareTask()
    {
        $task = Task::find($this->miTarea->id);
        $user = User::find($this->user_id);
        $user->sharedTasks()->attach($task->id, ['permision' => $this->permiso]);
        $this->closeShareModal();
        $this->tasks = $this->getTask()->sortbyDesc('id');
        //Mail::to($user)->send(new SharedTask($task, User::find(auth()->user()->id))); /// send manda email sin encolar por lo que 
        // en nuestra app veriamos un leve retraso
        //para encolar utilizaremos las siguiente instruccion:
        Mail::to($user)->queue(new SharedTask($task, User::find(auth()->user()->id)));
    }

    public function closeShareModal()
    {
        $this->modalShare = false;
    }

    public function taskUnshared(Task $task)
    { // recibe la tarea a descompartir
        $user = User::find(auth()->user()->id); // en la variable usuario mete el id del usuario autenticado 
        $user->sharedTasks()->detach($task->id); // a ese usuario le buscamos con que usuario comparte la tarea y la desasociamos ojo que 
        // la funcion se encuentra en el modelo donde previamente definimos la relacion 
        $this->task = $this->getTask()->sortByDesc('id'); // recargamos tareas 

    }
}
