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

    public function mount() {
        $this->tasks = Task::where('user_id',auth()->user()->id)->get();
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
}
