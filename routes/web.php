<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SarprasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\RekapController;
// Tambahkan controller lain jika ada (UserController, LaporanController, etc)

// Halaman Awal & Login
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Rekap Sarpras
    Route::get('/rekap', [RekapController::class, 'index'])->name('rekap.index');
    Route::get('/rekap/create', [RekapController::class, 'create'])->name('rekap.create');
    Route::post('/rekap', [RekapController::class, 'store'])->name('rekap.store');

    // Sarpras (bisa diakses oleh semua role dengan batasan di controller)
   Route::resource('sarpras', SarprasController::class)->except(['show'])->parameters([
    'sarpras' => 'sarpras'
]);

    // Rute khusus Admin
    Route::middleware(['role:admin'])->group(function() {
        // Route untuk manajemen user, kelas, laporan, dll.
         Route::resource('users', UserController::class);
        // Route::get('/laporan', [LaporanController::class, 'index']);
    });

// Rute khusus Wali Kelas <-- TAMBAHKAN GRUP BARU INI
    Route::middleware(['role:wali_kelas'])->group(function() {
        Route::get('/sarpras-kelas/edit', [SarprasController::class, 'showBulkEditForm'])->name('sarpras.bulk.edit');
        Route::post('/sarpras-kelas/update', [SarprasController::class, 'bulkUpdate'])->name('sarpras.bulk.update');
    });

	// Rute untuk Admin dan TU <-- TAMBAHKAN GRUP BARU INI
    Route::middleware(['role:admin,tu'])->group(function() {
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/excel', [LaporanController::class, 'exportExcel'])->name('laporan.excel');
        Route::get('/laporan/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.pdf');
	Route::resource('kelas', KelasController::class);
Route::get('sarpras/import', [SarprasController::class, 'showImportForm'])->name('sarpras.import.form');
    Route::post('sarpras/import', [SarprasController::class, 'import'])->name('sarpras.import');
    Route::get('sarpras/export', [SarprasController::class, 'export'])->name('sarpras.export');
    });
});