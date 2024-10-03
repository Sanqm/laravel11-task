<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;
use App\Models\User;

class TaskComponent extends Component
{

    public $tasks = [];
    public $title;
    public $description;
    public $modal = false; // permite abrir el modal que vamos a crear con la tarea 
    public $users = [];
    public $var = "cagarro como un carro";
    public function mount() {
        $this->users = User::where('id', '!=', auth()->user()->id)->get();
    }

    public function getTask(){
        return Task::where('user_id', auth()->user()->id)->get();
    }

    public function render()
    {
      
        return view('livewire.task-component');
        
    }

    private function clearFields(){
        $this->title = '';
        $this->description = '';
    }
    public function openCreateModal(){
        $this->clearFields();
        $this->modal= true;
    }
    public function closeCreateModal(){
        $this->modal = false;
    }
    public function createTask() {
        $newTask = new Task();
        $newTask->title = $this->title;
        $newTask->description = $this->description;
        $newTask->user_id = $this->auth()->user()->id;
        $newTask->save();
        $this->clearFields();
        $this->modal= false;
        $this->tasks = $this->getTask();
        
    }

    public function updateTask(Task $task) {
        $this->title = $task->title;
        $this->description = $task->description;
        $this->modal = true;
    }
    
}
