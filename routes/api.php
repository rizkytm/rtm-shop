<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\OrderController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group( function () {
    Route::resource('products', ProductController::class)->only([
        'index', 'show', 'store'
    ]);

    Route::get('cart', [CartController::class, 'getCart']);
    Route::post('cart', [CartController::class, 'addToCart']);
    Route::post('cart/remove', [CartController::class, 'removeFromCart']);
    Route::post('cart/clear', [CartController::class, 'clearCart']);

    Route::post('checkout', [OrderController::class, 'checkout']);
    Route::get('orders', [OrderController::class, 'getAllOrders']);
});
