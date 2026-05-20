<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PelangganController;
use Illuminate\Support\Facades\Route;

// 1. Halaman Utama (Tempat Form Login yang kita bikin di welcome.blade.php)
Route::get('/', function () {
    return view('welcome');
});

// 2. RUTE MODUL PELANGGAN (Punya Awin)
// Memproses data form login saat tombol "Masuk Aplikasi" diklik
Route::post('/proses-login-web', [PelangganController::class, 'login']);

// DIUBAH DI SINI: Sekarang rutenya lewat Controller dulu biar data tabelnya keambil!
Route::get('/dashboard-pelanggan', [PelangganController::class, 'dashboardWeb']);

// 3. Rute Bawaan Proyek / Auth Default (Jangan diganggu)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';