<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
=======
use App\Http\Controllers\Api\PengirimanController;
>>>>>>> ee0f506ed85ed752e6031afae8f0ddae8e0bf594

Route::get('/', function () {
    return view('welcome');
});
<<<<<<< HEAD
=======

Route::prefix('api')->group(function () {

    Route::get('/pengiriman', [PengirimanController::class, 'index']);

    Route::post('/pengiriman', [PengirimanController::class, 'store']);

    Route::put('/pengiriman/{id}', [PengirimanController::class, 'update']);

    Route::delete('/pengiriman/{id}', [PengirimanController::class, 'destroy']);

});
>>>>>>> ee0f506ed85ed752e6031afae8f0ddae8e0bf594
