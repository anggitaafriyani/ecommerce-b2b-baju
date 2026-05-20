<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

Route::apiResource('cart', CartController::class);
Route::apiResource('orders', OrderController::class);