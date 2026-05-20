<?php

use App\Http\Controllers\PelangganController;
use Illuminate\Support\Facades\Route;

// Endpoint untuk Akun Pelanggan B2B
Route::post('/pelanggan/register', [PelangganController::class, 'register']);
Route::post('/pelanggan/login', [PelangganController::class, 'login']);