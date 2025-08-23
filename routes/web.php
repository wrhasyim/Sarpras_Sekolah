<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SarprasController;
use App\Http\Controllers\UserController;
// Tambahkan controller lain jika ada (UserController, LaporanController, etc)

// Halaman Awal & Login
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Sarpras (bisa diakses oleh semua role dengan batasan di controller)
    Route::resource('sarpras', SarprasController::class)->parameters([
    'sarpras' => 'sarpras'
]);

    // Rute khusus Admin
    Route::middleware(['role:admin'])->group(function() {
        // Route untuk manajemen user, kelas, laporan, dll.
         Route::resource('users', UserController::class);
        // Route::get('/laporan', [LaporanController::class, 'index']);
    });
});