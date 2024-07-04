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
use App\Http\Middleware\CorsMiddleware;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('logout', [AuthController::class, 'logout']);
    // other routes
});




Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});
// Route::post('/products', [ProductController::class, 'store']);

// products route
Route::get('/products', [ProductController::class, 'index']);

Route::post('/products/{id}/addstock', [ProductController::class, 'addStock']);
Route::post('/products/search', [ProductController::class, 'search']);
Route::get('/products/all', [ProductController::class, 'show']);
Route::post('/products/update/{id}', [ProductController::class, 'updateP']);
Route::post('/products/create', [ProductController::class, 'create']);
Route::get('products/{id}', [ProductController::class, 'getProductById']);
Route::get('products/delete/{id}', [ProductController::class, 'delete']);



Route::get('/product_types', [ProductTypeController::class, 'index']);
// Route::post('/product_types/create', [ProductTypeController::class, 'store']);
Route::get('/product-types/{id}', [ProductTypeController::class, 'show']);


//promotion route
Route::post('/promotion/manage', [PromotionController::class, 'managePromotion']);
Route::post('/promotion/delete/{productId}', [PromotionController::class, 'deleteByProductId']);
Route::get('/promotion', [PromotionController::class, 'getPromotions']);
Route::get('/promotion/{id}', [PromotionController::class, 'getPromotionByid']);
Route::get('/promotionHistory', [PromotionHistoryController::class, 'index']);
Route::get('/promotionHistory/{productId}', [PromotionHistoryController::class, 'getPromotionHistoryByProductId']);



// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/user', [UserController::class, 'create'])->middleware('adminMiddleware');
Route::get('/user-types/{id}', [UserController::class, 'getUserType']);
Route::get('/user', [UserController::class, 'getData'])->middleware('adminMiddleware'); // Read Many Records
Route::get('user/{id}', [UserController::class, 'view'])->middleware('adminMiddleware'); // View a Record
Route::post('user/update/{id}', [UserController::class, 'update']); // Update Existing Record
Route::delete('user/{id}', [UserController::class, 'delete']); // Delete a record

Route::get('/getproduct', [OrderController::class, 'getProducts']);
Route::post('/orders', [OrderController::class, 'makeOrder']);
Route::get('/o/{id}', [OrderController::class, 'getOrderDetails']);

Route::post('/product-types/create', [ProductTypeController::class, 'store']);


Route::get('/profile', [ProfileController::class, 'view']); // Get Data

Route::middleware(['adminMiddleware'])->group(function () {
    Route::get('/restricted', function () {
        return response()->json(['message' => 'Authorized']);
    });

    Route::get('/another-restricted-route', function () {
        return response()->json(['message' => 'Authorized']);
    });
});

