<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\Api\PengirimanController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Modul Pembayaran
Route::get('/pembayaran', [PaymentController::class, 'index']); 
Route::post('/pembayaran', [PaymentController::class, 'store']);
Route::put('/pembayaran/{id}', [PaymentController::class, 'update']);
Route::delete('/pembayaran/{id}', [PaymentController::class, 'destroy']);


Route::get('/tes-api', function () {
    return response()->json([
        'message' => 'API terbaca'
    ]);
});

Route::get('/pengiriman', [PengirimanController::class, 'index']);
Route::post('/pengiriman', [PengirimanController::class, 'store']);
Route::put('/pengiriman/{id}', [PengirimanController::class, 'update']);
Route::delete('/pengiriman/{id}', [PengirimanController::class, 'destroy']);
