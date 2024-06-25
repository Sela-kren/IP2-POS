<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/upload', function () {
//     return view('upload');
// });



Route::get('/upload', function () {
    return view('upload');
});

Route::post('/upload', [ProductController::class, 'store']);

// Route::get('/products', [ProductController::class, 'index']);
// Route::get('/product', function () {
//     return view('product');
// });
// Route::post('/products', [ProductController::class, 'createProducts']);

Route::get('/product-types/create', [ProductTypeController::class, 'create']);
Route::post('/product-types/create', [ProductTypeController::class, 'store']);

Route::get('/order', function () {
    return view('order');
});
Route::get('/order', [OrderController::class, 'showOrder']);
Route::get('/orders', function () {
    return view('order_form');
});

Route::post('/create-user', [UserController::class, 'create']);
Route::get('/create-user-form', function () {
    return view('create-user');
});