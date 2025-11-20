<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ajax\DashboardController;

Route::prefix('dashboard')->group(function () {
    Route::post('changeStatus', [DashboardController::class, 'changeStatus'])->name('ajax.changeStatus');
    Route::post('/sort', [DashboardController::class, 'sort'])->name('ajax.banner_icons.sort');
});
