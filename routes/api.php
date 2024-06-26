<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\DishController;
use App\Http\Controllers\Api\DeclarationController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PdfController;
use App\Http\Controllers\Api\SocialAuthController;

Route::get('/authorize/{provider}/redirect', [SocialAuthController::class, 'redirectToProvider'])->name('api.social.redirect');
Route::get('/authorize/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback'])->name('api.social.callback');

Route::prefix('/auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/declaration', [DeclarationController::class, 'store']);
    Route::get('/check-declaration-status', [DeclarationController::class, 'checkDeclarationStatus']);

    Route::get('/restaurants', [RestaurantController::class, 'index']);
    Route::post('/restaurants', [RestaurantController::class, 'store']);
    Route::get('/restaurants/edit/{id}', [RestaurantController::class, 'edit']);
    Route::post('/restaurants/{id}', [RestaurantController::class, 'update']);
    Route::get('/user-restaurants', [RestaurantController::class, 'getUserRestaurants']);
    Route::get('/restaurants-search', [RestaurantController::class, 'search']);
    Route::get('/restaurants/{restaurantId}/average-rating', [RestaurantController::class, 'getAverageRating']);

    Route::get('/categories', [CategoryController::class, 'index']);

    Route::get('/restaurant-dishes/{restaurant_id}', [DishController::class, 'getRestaurantDishes']);
    Route::post('/dish', [DishController::class, 'store']);
    Route::get('/dish-recommendations', [DishController::class, 'dishRecommendations']);

    Route::get('/user', [UserController::class, 'index']);
    Route::put('/user/{id}', [UserController::class, 'update']);

    Route::get('/user-orders', [OrderController::class, 'getUserOrders']);
    Route::post('/create-order', [OrderController::class, 'createOrder']);
    Route::get('/restaurant-orders/{restaurant_id}', [OrderController::class, 'getRestaurantOrders']);
    Route::put('/orders/{orderId}', [OrderController::class, 'updateOrderStatus']);

    Route::post('/comments',[CommentController::class, 'store']);

    Route::get('/generate-pdf-comments/{id}', [PdfController::class, 'generatePDFComments']);
    Route::post('/download-pdf', [PdfController::class, 'downloadPDF']);
});
