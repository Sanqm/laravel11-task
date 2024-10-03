<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use Illuminate\Database\Query\IndexHint;
use Illuminate\Support\Facades\Route;
use App\Livewire\TaskComponent;
use Illuminate\Console\View\Components\Task;

//Route::view('/', 'welcome');
Route::redirect('/', 'dashboard'); // con esto conseguimos que nuestra 
// app entre firectamente en el login. 

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('dashboard profile', TaskComponent::class)
->middleware(['auth', 'verified'])
 ->name('dashboard livewire');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
