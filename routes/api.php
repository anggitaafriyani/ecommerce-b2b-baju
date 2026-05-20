<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PaymentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Modul Pembayaran
Route::get('/pembayaran', [PaymentController::class, 'index']); 
Route::post('/pembayaran', [PaymentController::class, 'store']);
Route::put('/pembayaran/{id}', [PaymentController::class, 'update']);
Route::delete('/pembayaran/{id}', [PaymentController::class, 'destroy']);