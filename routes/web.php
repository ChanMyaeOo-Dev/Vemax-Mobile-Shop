<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('/');

// Admin Routes
Route::middleware(["auth"])->prefix("admin")->group(function () {
    Route::resource("products", ProductController::class);
    Route::resource("categories", CategoryController::class);
    Route::resource("photos", PhotoController::class);
    Route::resource("orders", OrderController::class);
});
//Auth Routes
Route::middleware(['auth'])->group(function () {
    Route::resource("users", UserController::class);
    Route::resource("carts", CartController::class);
});
