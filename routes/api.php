<?php

use App\Http\Controllers\Api\ {
    AuthController,
    BasketController,
    CategoryController,
    ProductController,
    ShowcaseController,
    UserController,
};

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware(['auth:api'])->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);

        Route::apiResources([
            'showcases' => ShowcaseController::class,
            'categories' => CategoryController::class,
            'products' => ProductController::class,
        ], ['except' => ['create', 'edit']]);

        Route::apiResource('users', UserController::class)->except(['create', 'edit', 'store']);

        Route::prefix('users/{user}')->group(function () {
            Route::get('products', [UserController::class, 'products']);
            Route::get('favorites', [UserController::class, 'favorites']);
            Route::get('basket', [UserController::class, 'basket']);
        });

        Route::prefix('products/{product}')->group(function () {
            Route::post('favorite', [ProductController::class, 'addFavorite']);
            Route::delete('favorite', [ProductController::class, 'removeFavorite']);
        });

        Route::prefix('showcases/{showcase}')->group(function () {
            Route::post('basket', [BasketController::class, 'addBasket']);
            Route::delete('basket', [BasketController::class, 'removeBasket']);
        });
    });
});
