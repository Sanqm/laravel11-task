<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;
use App\Models\User;
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

    public function mount()
    {
        $this->users = User::where('id', '!=', auth()->user()->id)->get();
        $this->tasks = $this->getTask();
    }

    public function getTask()
    {
        return Task::where('user_id', auth()->user()->id)->get();
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
        }else{
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
}
