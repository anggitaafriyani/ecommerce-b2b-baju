<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PengirimanController;

Route::get('/tes-api', function () {
    return response()->json([
        'message' => 'API terbaca'
    ]);
});

Route::get('/pengiriman', [PengirimanController::class, 'index']);
Route::post('/pengiriman', [PengirimanController::class, 'store']);
Route::put('/pengiriman/{id}', [PengirimanController::class, 'update']);
Route::delete('/pengiriman/{id}', [PengirimanController::class, 'destroy']);