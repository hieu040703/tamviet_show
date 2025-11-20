<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\HomePageController;
use App\Http\Controllers\Frontend\RouterController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;


Route::get('/', [HomePageController::class, 'getHomePage'])->name('homepage.index');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');
Route::get('{canonical}.html', [RouterController::class, 'handle'])->where('canonical', '^(?!login$)(?!admin$)[A-Za-z0-9\-_]+$')->name('router.handle');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/checkout/buy-now/{id}', [CheckoutController::class, 'buyNow'])->name('checkout.buyNow');


