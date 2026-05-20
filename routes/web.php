<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
// use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/orders', function () {
    return view('orders.index');
});

Route::get('/cart', function () {
    return view('cart.index');
});

Route::resource('cart', CartController::class);

