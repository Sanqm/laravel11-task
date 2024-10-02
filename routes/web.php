<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::redirect('/', 'dashboard'); // con esto conseguimos que nuestra 
// app entre firectamente en el login. 

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
