<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return auth()->check() ? redirect()->route('todo.index') : redirect()->route('login');
});

// Auth routes (login, register, logout)
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'store'])->name('login.store');
Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'create'])->name('login');
Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'store'])->name('register.store');
Route::get('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('register');
Route::post('/logout', [\App\Http\Controllers\Auth\LogoutController::class, 'destroy'])->name('logout');

// Protected routes (only authenticated users)
Route::middleware('auth')->group(function () {
    // Place custom routes before the resource route so they are not matched
    // by the resource's `/{todo}` show route (which would treat 'daily'/'weekly' as an id).
    Route::get('/todo/daily', [TodoController::class, 'daily'])->name('todo.daily');
    Route::get('/todo/weekly', [TodoController::class, 'weekly'])->name('todo.weekly');
    //route untuk toggle status via POST
    Route::post('/todo/{todo}/toggle', [TodoController::class, 'toggle'])->name('todo.toggle');

    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::get('/todo/rekomendasi',[TodoController::class, 'rekomendasi'])->name('todo.rekomendasi');

    // register resource routes for Todo without global policy middleware
    // (we'll enforce ownership inside controller methods where needed)
    Route::resource('todo', TodoController::class);
});




