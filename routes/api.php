<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\DishController;
use App\Http\Controllers\Api\DeclarationController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RestaurantController;

Route::prefix('/auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/user-role', [AuthController::class, 'getUserRole'])->middleware('auth:sanctum');
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/declaration', [DeclarationController::class, 'store']);
    Route::get('/check-declaration-status', [DeclarationController::class, 'checkDeclarationStatus']);

    Route::get('/restaurants', [RestaurantController::class, 'index']);
    Route::post('/restaurants', [RestaurantController::class, 'store']);
    Route::get('/restaurants/edit/{id}', [RestaurantController::class, 'edit']);
    Route::put('/restaurants/{id}', [RestaurantController::class, 'update']);
    Route::get('/user-restaurants', [RestaurantController::class, 'getUserRestaurants']);
    Route::get('/restaurants-search', [RestaurantController::class, 'search']);

    Route::get('/categories', [CategoryController::class, 'index']);

    Route::get('/restaurant-dishes/{restaurant_id}', [DishController::class, 'getRestaurantDishes']);
    Route::post('/dish', [DishController::class, 'store']);
});
