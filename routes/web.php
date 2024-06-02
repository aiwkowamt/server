<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DeclarationController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/users', [UserController::class, 'index'])->middleware('auth:sanctum')->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->middleware('auth:sanctum')->name('users.create');
Route::post('/users', [UserController::class, 'store'])->middleware('auth:sanctum')->name('users.store');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->middleware('auth:sanctum')->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->middleware('auth:sanctum')->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->middleware('auth:sanctum')->name('users.destroy');

Route::get('/roles', [RoleController::class, 'index'])->middleware('auth:sanctum')->name('roles.index');
Route::get('/roles/create', [RoleController::class, 'create'])->middleware('auth:sanctum')->name('roles.create');
Route::post('/roles', [RoleController::class, 'store'])->middleware('auth:sanctum')->name('roles.store');
Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->middleware('auth:sanctum')->name('roles.edit');
Route::put('/roles/{role}', [RoleController::class, 'update'])->middleware('auth:sanctum')->name('roles.update');
Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->middleware('auth:sanctum')->name('roles.destroy');

Route::get('/declarations', [DeclarationController::class, 'index'])->middleware('auth:sanctum')->name('declarations.index');
Route::get('/declarations/{declaration}/edit', [DeclarationController::class, 'edit'])->middleware('auth:sanctum')->name('declarations.edit');
Route::put('/declarations/{declaration}', [DeclarationController::class, 'update'])->middleware('auth:sanctum')->name('declarations.update');

Route::get('/restaurants', [RestaurantController::class, 'index'])->middleware('auth:sanctum')->name('restaurants.index');
Route::get('/restaurants/{restaurant}/edit', [RestaurantController::class, 'edit'])->middleware('auth:sanctum')->name('restaurants.edit');
Route::delete('/restaurants/{restaurant}', [RestaurantController::class, 'destroy'])->middleware('auth:sanctum')->name('restaurants.destroy');
Route::put('/restaurants/{restaurant}', [RestaurantController::class, 'update'])->middleware('auth:sanctum')->name('restaurants.update');
Route::delete('/restaurants/{restaurant}', [RestaurantController::class, 'destroy'])->middleware('auth:sanctum')->name('restaurants.destroy');


Route::get('/categories', [CategoryController::class, 'index'])->middleware('auth:sanctum')->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->middleware('auth:sanctum')->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->middleware('auth:sanctum')->name('categories.store');
