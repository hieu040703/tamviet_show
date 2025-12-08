<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ajax\BannerItemController;
use App\Http\Controllers\Ajax\DashboardController;
use App\Http\Controllers\Ajax\MenuController;
use App\Http\Controllers\Ajax\WidgetController;
use App\Http\Controllers\Ajax\Auth\CustomerAuthController;
use App\Http\Controllers\Ajax\ContactController;

use App\Http\Controllers\Frontend\BrandController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CategoryController;


Route::prefix('dashboard')->group(function () {
    Route::post('changeStatus', [DashboardController::class, 'changeStatus'])->name('ajax.changeStatus');
    Route::post('/sort', [DashboardController::class, 'sort'])->name('ajax.banner_icons.sort');
});
Route::get('widgets/search-items', [WidgetController::class, 'searchItems'])->name('ajax.widgets.searchItems');
// SORT
Route::post('/sort', [BannerItemController::class, 'sort'])->name('ajax.banner_items.sort');

Route::get('//search-router', [MenuController::class, 'searchRouter'])->name('ajax.menus.searchRouter');

/* Category */
Route::post('/category/filter', [CategoryController::class, 'filterAjaxAll'])->name('ajax.category.filter.all');
Route::get('/category/{id}/filter', [CategoryController::class, 'filterAjax'])->name('ajax.category.filter');
Route::get('/category/{id}/load-more', [CategoryController::class, 'loadMore'])->name('ajax.category.loadMore');
Route::get('/category/load-more', [CategoryController::class, 'loadMoreAll'])->name('ajax.category.loadMore.all');
/* Brand */
Route::get('/brand/{id}/filter', [BrandController::class, 'filterAjax'])->name('ajax.brand.filter');
Route::get('/brand/{id}/load-more', [BrandController::class, 'loadMore'])->name('ajax.brand.loadMore');

/* Cart */
Route::post('/cart/ajax-add', [CartController::class, 'ajaxAdd'])->name('cart.ajaxAdd');
Route::post('/cart/ajax-update', [CartController::class, 'ajaxUpdate'])->name('cart.ajaxUpdate');
Route::post('/cart/ajax-remove', [CartController::class, 'ajaxRemove'])->name('cart.ajaxRemove');
Route::post('cart/clear', [CartController::class, 'ajaxClear'])->name('cart.ajaxClear');

/* Customer */
Route::post('login', [CustomerAuthController::class, 'ajaxLogin'])->name('ajax.login');
Route::post('register', [CustomerAuthController::class, 'ajaxRegister'])->name('ajax.register');
Route::post('logout', [CustomerAuthController::class, 'ajaxLogout'])->name('ajax.logout');

/* Contact */
Route::post('contact-request/{id}/update-status', [ContactController::class, 'updateStatus'])->name('ajax.contact-request.updateStatus');
