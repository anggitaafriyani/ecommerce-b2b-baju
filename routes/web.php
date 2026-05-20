<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// 1. Halaman Utama (Tempat Form Login & Tabel Pelanggan via jQuery AJAX)
Route::get('/', function () {
    return view('welcome');
});

// ====================================================================
// RUTE MODUL PELANGGAN LAMA DI SINI SUDAH DIHAPUS (SUDAH PINDAH KE routes/api.php)
// ====================================================================

// 3. Rute Bawaan Proyek / Auth Default (Jangan diganggu - Tetap Dipertahankan)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';