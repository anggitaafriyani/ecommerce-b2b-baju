<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PengirimanController;
use App\Http\Controllers\CartController;
// use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('home');
});

Route::prefix('api')->group(function () {

    Route::get('/pengiriman', [PengirimanController::class, 'index']);

    Route::post('/pengiriman', [PengirimanController::class, 'store']);

    Route::put('/pengiriman/{id}', [PengirimanController::class, 'update']);

    Route::delete('/pengiriman/{id}', [PengirimanController::class, 'destroy']);

});
Route::get('/products', function () {
    return view('products');
});

Route::get('/orders', function () {
    return view('orders.index');
});

Route::get('/cart', function () {
    return view('cart.index');
});

Route::resource('cart', CartController::class);

