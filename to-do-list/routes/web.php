<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;


Route::get('/index', function () {
    return view('index');
})->name('index');

Route::get("/home", [TasksController::class, 'listTasks'])->name('home');

Route::get('/tasks/create', [TasksController::class, 'create'])->name('tasks.create');

// Route for storing a new task (create)
Route::post('/tasks', [TasksController::class, 'store'])->name('tasks.store');

// Route for updating an existing task
Route::put('/tasks/{task}', [TasksController::class, 'update'])->name('tasks.update');

// Route for deleting a task
Route::delete('/tasks/{task}', [TasksController::class, 'destroy'])->name('tasks.destroy');

Route::put('/tasks/check/{task}', [TasksController::class, 'check'])->name('tasks.check');