<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Livewire\Volt\computed;

class TaskController extends Controller
{
    public function index(){
        $user = Auth::user();
        $tasks = $user->tasks; 
        $modal = false;
        return view('livewire.task-component',compact('tasks', 'modal'));

    }
}
