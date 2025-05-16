<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

// Redirect homepage to product listing
Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::get('/admin/orders', [AdminController::class, 'orders'])->middleware('auth')->name('admin.orders');


// Auth routes
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Product routes — only require auth; admin restriction is in controller
Route::resource('products', ProductController::class)->middleware('auth');

// Cart routes (accessible to all)
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');

// Checkout routes (authenticated users only)
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [OrderController::class, 'create'])->name('checkout.form');
    Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');
});
