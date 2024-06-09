<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\PromotionHistoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});
// Route::post('/products', [ProductController::class, 'store']);

Route::get('/products', [ProductController::class, 'index']);

Route::post('/products/{id}/addstock', [ProductController::class, 'addStock']);
Route::post('/products/search', [ProductController::class, 'search']);

Route::get('/product_types', [ProductTypeController::class, 'index']);
// Route::post('/product_types/create', [ProductTypeController::class, 'store']);

Route::post('/promotion/manage', [PromotionController::class, 'managePromotion']);
Route::post('/promotion/{productId}', [PromotionController::class, 'deleteByProductId']);
Route::get('/promotion', [PromotionController::class, 'getPromotions']);

Route::get('/promotionHistory', [PromotionHistoryController::class, 'index']);


