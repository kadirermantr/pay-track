<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ShowcaseController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'v1'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('logout', [AuthController::class, 'logout']);

        Route::apiResources([
            'showcases' => ShowcaseController::class,
            'categories' => CategoryController::class,
            'products' => ProductController::class,
        ], ['except' => ['create', 'edit']]);

        Route::apiResource('users', UserController::class)->except(['create', 'edit', 'store']);

        Route::get('users/{user}/products', [UserController::class, 'products']);
        Route::get('users/{user}/favorites', [UserController::class, 'favorites']);
        Route::post('products/{product}/favorite', [ProductController::class, 'addFavorite']);
        Route::delete('products/{product}/favorite', [ProductController::class, 'removeFavorite']);
    });
});
