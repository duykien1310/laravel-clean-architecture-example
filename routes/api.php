<?php

use App\Http\Controllers\Product\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Order\OrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------`
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// User
Route::prefix('user')->group(function () {
    Route::post('/', [UserController::class, 'store']);
    Route::get('/', [UserController::class, 'show']);
    Route::put('/', [UserController::class, 'update']);
    Route::delete('/', [UserController::class, 'destroy']);
});

// Product
Route::prefix('product')->group(function () {
    Route::post('', [ProductController::class, 'store']);
    Route::get('', [ProductController::class, 'show']);
    Route::put('', [ProductController::class, 'update']);
    Route::delete('', [ProductController::class, 'destroy']);
});

// Order
Route::prefix('order')->group(function () {
    Route::post('', [OrderController::class, 'placeAnOrder']);
    Route::get('/user', [OrderController::class, 'getEagerOrder']);
});

// Route::prefix('auth')->group(function () {
//     Route::post('login', 'login');
//     Route::post('register', 'register');
//     Route::post('logout', 'logout');
//     Route::post('refresh', 'refresh');
// });
