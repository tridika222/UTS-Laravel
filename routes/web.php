<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\Islogin;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'LoginView']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware (Islogin::class)->group(function () {
    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/products', [ProductController::class, 'index']) ;
    Route::get('/products/create', [ProductController::class, 'create']) ;
    Route::get('/products/edit/{id}', [ProductController::class, 'edit']) ;
    Route::post('/products/store', [ProductController::class, 'store']) ;
    Route::put('/products/{id}', [ProductController::class, 'update']) ;
    Route::delete('/products/{id}', [ProductController::class, 'delete']) ;
    
    Route::get('/categories', [CategoryController::class, 'index']) ;
    Route::get('/categories/create', [CategoryController::class, 'create']) ;
    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit']) ;
    Route::post('/categories/store', [CategoryController::class, 'store']) ;
    Route::put('/categories/{id}', [CategoryController::class, 'update']) ;
    Route::delete('/categories/{id}', [CategoryController::class, 'delete']) ;
});

