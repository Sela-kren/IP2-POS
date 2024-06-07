<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

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

Route::get('/products', [ProductController::class, 'index']);
// Route::get('/product', function () {
//     return view('product');
// });
// Route::post('/products', [ProductController::class, 'createProducts']);