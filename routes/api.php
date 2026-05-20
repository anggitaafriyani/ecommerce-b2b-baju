<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
// use App\Http\Controllers\CartController;

Route::apiResource('orders', OrderController::class);
// Route::apiResource('cart', CartController::class);