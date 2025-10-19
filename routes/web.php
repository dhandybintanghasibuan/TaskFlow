<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SplashController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SubTaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SplashController::class, 'index'])->name('splash');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [TaskController::class, 'index'])->name('dashboard');
    Route::get('/calendar', fn() => view('calendar.index'))->name('calendar.index');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/settings', [ProfileController::class, 'settings'])->name('profile.settings');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('tasks', TaskController::class);
    Route::resource('courses', CourseController::class);
    
    Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');

    Route::get('/trash', [TaskController::class, 'trash'])->name('tasks.trash');
    Route::post('/trash/{id}/restore', [TaskController::class, 'restore'])->name('tasks.restore');
    Route::delete('/trash/{id}/force-delete', [TaskController::class, 'forceDelete'])->name('tasks.forceDelete');

    Route::post('/tasks/{task}/subtasks', [SubTaskController::class, 'store'])->name('subtasks.store');
    Route::patch('/subtasks/{subTask}', [SubTaskController::class, 'update'])->name('subtasks.update');
    Route::delete('/subtasks/{subTask}', [SubTaskController::class, 'destroy'])->name('subtasks.destroy');

    Route::get('/api/tasks-for-calendar', [TaskController::class, 'tasksForCalendar'])->name('api.tasksForCalendar');
});

require __DIR__.'/auth.php';