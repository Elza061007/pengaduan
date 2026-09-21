<?php

use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Admin\LaporanController as AdminLaporanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'));

// arahkan user ke dashboard sesuai role
Route::get('/dashboard', function () {
    return auth()->user()->isAdmin()
        ? redirect()->route('admin.laporan.index')
        : redirect()->route('laporan.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// ===== SISWA =====
Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/buat', [LaporanController::class, 'create'])->name('laporan.create');
    Route::post('/laporan', [LaporanController::class, 'store'])->name('laporan.store');
    Route::get('/laporan/{laporan}', [LaporanController::class, 'show'])->name('laporan.show');
});

// ===== ADMIN =====
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/laporan', [AdminLaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/{laporan}', [AdminLaporanController::class, 'show'])->name('laporan.show');
    Route::put('/laporan/{laporan}', [AdminLaporanController::class, 'update'])->name('laporan.update');
    Route::delete('/laporan/{laporan}', [AdminLaporanController::class, 'destroy'])->name('laporan.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';