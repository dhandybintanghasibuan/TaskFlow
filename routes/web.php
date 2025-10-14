<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SplashController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SubTaskController; // Tambahkan ini
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute untuk halaman publik (landing page)
Route::get('/', [SplashController::class, 'index'])->name('splash');

// Semua rute di bawah ini hanya bisa diakses oleh pengguna yang sudah login
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Rute Dashboard & Main Menu
    Route::get('/dashboard', [TaskController::class, 'index'])->name('dashboard');
    Route::get('/calendar', function () {
        return view('calendar.index');
    })->name('calendar.index');

    // Rute Profil & Pengaturan
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/settings', [ProfileController::class, 'settings'])->name('profile.settings');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute Resource untuk Tugas (CRUD penuh)
    Route::resource('tasks', TaskController::class);

    // Rute Resource untuk Mata Kuliah
    Route::resource('courses', CourseController::class);
    
    // Rute Khusus untuk Fitur Tambahan
    // Rute untuk fitur-fitur di dalam halaman tugas
    Route::prefix('tasks')->name('tasks.')->group(function () {
        // Soft Deletes (Tong Sampah)
        Route::get('/trash', [TaskController::class, 'trash'])->name('trash');
        Route::post('/trash/{id}/restore', [TaskController::class, 'restore'])->name('restore');
        Route::delete('/trash/{id}/force-delete', [TaskController::class, 'forceDelete'])->name('forceDelete');
        
        // Update Status Langsung dari Dashboard
        Route::patch('/{task}/status', [TaskController::class, 'updateStatus'])->name('updateStatus');
    });

    // Rute untuk Sub-tugas
    Route::prefix('subtasks')->name('subtasks.')->group(function () {
        Route::post('/{task}', [SubTaskController::class, 'store'])->name('store');
        Route::patch('/{subTask}', [SubTaskController::class, 'update'])->name('update');
        Route::delete('/{subTask}', [SubTaskController::class, 'destroy'])->name('destroy');
    });

    // Rute API untuk Kalender
    Route::get('/api/tasks-for-calendar', [TaskController::class, 'tasksForCalendar'])->name('api.tasksForCalendar');
});

require __DIR__.'/auth.php';