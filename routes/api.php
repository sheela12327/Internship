<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;


use Illuminate\Support\Facades\Route;

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/featured', [ProductController::class, 'featured']);
Route::get('/products/top-selling', [ProductController::class, 'topSelling']);
Route::get('/products/{product}', [ProductController::class, 'show']);
Route::get('/products/{product}/stock', [ProductController::class, 'stock']);

Route::post('/cart/add', [CartController::class, 'add']);
Route::get('/cart/{user}', [CartController::class, 'view']);
Route::put('/cart/item/{item}', [CartController::class, 'update']);
Route::delete('/cart/item/{item}', [CartController::class, 'remove']);

Route::post('/order/place', [OrderController::class, 'place']);
