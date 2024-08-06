<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Protegiendo las rutas con el middleware 'api_token'
Route::middleware(['api_token'])->group(function () {
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('products', ProductController::class);
    Route::post('webhook/products/count', [ProductController::class, 'countByCategory']);
    Route::post('webhook/categories/list', [CategoryController::class, 'listCategories']); 
});
