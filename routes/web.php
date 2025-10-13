<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SplashController; // Tambahkan ini
use App\Http\Controllers\TaskController;   // Tambahkan ini
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// 1. Rute utama (root) diubah untuk menampilkan Splash Screen
Route::get('/', [SplashController::class, 'index']);

// 2. Rute /dashboard diubah untuk menampilkan daftar tugas dari TaskController
Route::get('/dashboard', [TaskController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 3. Tambahkan rute resource untuk semua fitur tugas (tambah, edit, hapus, dll.)
    Route::resource('tasks', TaskController::class);
    Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');

    // --- Rute Baru untuk Kalender ---
    Route::get('/calendar', function () {
        return view('calendar.index');
    })->name('calendar.index');

    Route::get('/api/tasks-for-calendar', [TaskController::class, 'tasksForCalendar'])->name('api.tasksForCalendar');
    // ---------------------------------
});

require __DIR__.'/auth.php';