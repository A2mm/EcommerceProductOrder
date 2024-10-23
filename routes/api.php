<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Orders\OrderController;
use App\Http\Controllers\Products\ProductController;

Route::prefix('v1')
->group(function ()
{

    /**
    ** Auth Routes
    */
    Route::prefix('auth')
    ->group(function ()
    {
        Route::post('login', [AuthController::class, 'login'])->name('login');
    });

    /**
    ** Product Routes
    */
    Route::prefix('products')
    ->middleware(['api', 'auth:sanctum'])
    ->as('products.')
    ->group(function ()
    {
        Route::get('', [ProductController::class, 'index'])->name('list');
        Route::get('{id}', [ProductController::class, 'show']);
        Route::post('', [ProductController::class, 'create'])->name('create');
        Route::put('{id}', [ProductController::class, 'update']);
        Route::delete('{id}', [ProductController::class, 'delete']);
    });

    /**
    ** Order Routes
    */
    Route::prefix('orders')
    ->middleware(['api', 'auth:sanctum'])
    ->group(function ()
    {
        Route::get('', [OrderController::class, 'index']);
        Route::get('{id}', [OrderController::class, 'show']);
        Route::post('', [OrderController::class, 'create']);
    });

});
