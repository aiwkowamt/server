<?php

use Illuminate\Support\Facades\Route;
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
});
