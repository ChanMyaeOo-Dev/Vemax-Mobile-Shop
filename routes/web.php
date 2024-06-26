<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('/');

Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::get("/shop/{slug}", [HomeController::class, "detail"])->name("detail");
Route::get("/buy-now/{slug}", [HomeController::class, "buyNow"])->name("buy-now");

Route::post('/buyNowOrderUpload', [OrderController::class, "buyNowOrderUpload"])->name("buyNowOrderUpload");

// Admin Routes
Route::middleware(["auth"])->prefix("admin")->group(function () {
    Route::get("/dashboard", [DashboardController::class, "dashboard"])->name("dashboard");
    Route::resource("products", ProductController::class);

    Route::get('/trash', [ProductController::class, "getTrash"])->name('trash');
    Route::post('/restore', [ProductController::class, "restore"])->name('restore');
    Route::delete('/force_delete', [ProductController::class, "forceDelete"])->name('force_delete');

    Route::resource("categories", CategoryController::class);
    Route::resource("photos", PhotoController::class);
    Route::resource("orders", OrderController::class);

    Route::get('/order-shipping', [OrderController::class, "shippingOrders"])->name('order-shipping');
    Route::get('/order-delivered', [OrderController::class, "deliveredOrders"])->name('order-delivered');
});
//Auth Routes
Route::middleware(['auth'])->group(function () {
    Route::resource("users", UserController::class);
    Route::resource("carts", CartController::class);
    Route::get("order-detail/{id}", [UserController::class, "orderDetail"])->name("order-detail");

    Route::get('generatePDF/{id}', [UserController::class, "generatePDF"])->name("generatePDF");
});
