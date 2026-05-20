<?php

use App\Http\Controllers\PelangganController;
use Illuminate\Support\Facades\Route;

// 1. Endpoint untuk menampilkan semua data pelanggan (Ambil Data via AJAX GET)
Route::get('/pelanggan', [PelangganController::class, 'index']);

// 2. Endpoint untuk registrasi akun toko baru (POST)
Route::post('/pelanggan/register', [PelangganController::class, 'register']);

// 3. Endpoint untuk proses masuk aplikasi / login (POST via AJAX)
Route::post('/pelanggan/login', [PelangganController::class, 'login']);