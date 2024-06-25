<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\PromotionHistoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);


Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});
// Route::post('/products', [ProductController::class, 'store']);

// products route
Route::get('/products', [ProductController::class, 'index']);

Route::post('/products/{id}/addstock', [ProductController::class, 'addStock']);
Route::post('/products/search', [ProductController::class, 'search']);
Route::get('/products/all', [ProductController::class, 'show']);

Route::get('/product_types', [ProductTypeController::class, 'index']);
// Route::post('/product_types/create', [ProductTypeController::class, 'store']);
Route::get('/product-types/{id}', [ProductTypeController::class, 'show']);


//promotion route
Route::post('/promotion/manage', [PromotionController::class, 'managePromotion']);
Route::post('/promotion/{productId}', [PromotionController::class, 'deleteByProductId']);
Route::get('/promotion', [PromotionController::class, 'getPromotions']);
Route::get('/promotionHistory', [PromotionHistoryController::class, 'index']);

// Route::get('/users', [UserController::class, 'index'])->name('users.index');
// Route::post('/users', [UserController::class, 'store'])->name('users.create');
// Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
// Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');


Route::post('/user', [UserController::class, 'create']);
Route::get('/types', [UserController::class, 'getUserType']);
Route::get('/user', [UserController::class, 'getData']); // Read Many Records
Route::get('user/{id}', [UserController::class, 'view']); // View a Record
Route::post('user/{id}', [UserController::class, 'update']); // Update Existing Record
Route::delete('user/{id}', [UserController::class, 'delete']); // Delete a record

Route::get('/getproduct', [OrderController::class, 'getProducts']);
Route::post('/orders', [OrderController::class, 'makeOrder']);
