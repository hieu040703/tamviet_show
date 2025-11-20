<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ajax\DashboardController;
use App\Http\Controllers\Ajax\WidgetController;
use App\Http\Controllers\Ajax\BannerItemController;
use App\Http\Controllers\Ajax\MenuController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\BrandController;

Route::prefix('dashboard')->group(function () {
    Route::post('changeStatus', [DashboardController::class, 'changeStatus'])->name('ajax.changeStatus');
    Route::post('/sort', [DashboardController::class, 'sort'])->name('ajax.banner_icons.sort');
});
Route::get('widgets/search-items', [WidgetController::class, 'searchItems'])->name('ajax.widgets.searchItems');
// SORT
Route::post('/sort', [BannerItemController::class, 'sort'])->name('ajax.banner_items.sort');

Route::get('/ajax/search-router', [MenuController::class, 'searchRouter'])->name('ajax.menus.searchRouter');

/* Category */
Route::get('ajax/category/{id}/filter', [CategoryController::class, 'filterAjax'])->name('ajax.category.filter');
Route::get('ajax/category/{id}/load-more', [CategoryController::class, 'loadMore'])->name('ajax.category.loadMore');
/* Brand */
Route::get('ajax/brand/{id}/filter', [BrandController::class, 'filterAjax'])->name('ajax.brand.filter');
Route::get('ajax/brand/{id}/load-more', [BrandController::class, 'loadMore'])->name('ajax.brand.loadMore');
