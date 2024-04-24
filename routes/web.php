<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('/');

// Admin Routes
Route::middleware(["auth"])->prefix("admin")->group(function () {
    Route::resource("products", ProductController::class);
    Route::resource("categories", CategoryController::class);
});
