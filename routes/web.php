<?php
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\HomePageController;
use App\Http\Controllers\Frontend\RouterController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\AccountController;

Route::get('/nhom-bai-viet-tuyen-dung', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');

    return 'Đã clear cache xong trên server!';
});
Route::get('/storage-link-hiu', function () {
    Artisan::call('storage:link');
    return 'Đã chạy storage:link xong!';
});
Route::get('/', [HomePageController::class, 'getHomePage'])->name('homepage.index');
Route::get('/cart.html', [CartController::class, 'index'])->name('cart.index');
Route::get('/checkout.html', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout.html', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout-success.html', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/category.html', [CategoryController::class, 'index'])->name('category.index');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');
Route::group(['middleware' => ['web', 'customer.auth']], function () {
    Route::get('/account.html', [AccountController::class, 'index'])->name('account.index');
    Route::get('/account.setting.html', [AccountController::class, 'setting'])->name('account.setting');
    Route::get('account/personal-info.html', [AccountController::class, 'profile'])->name('account.personal-info');
    Route::post('/account/profile.html', [AccountController::class, 'updateProfile'])->name('account.profile.update');
    Route::get('account/contact-history.html', [AccountController::class, 'contactHistory'])->name('account.contact-history');
});
Route::get('{canonical}.html', [RouterController::class, 'handle'])->where('canonical', '^(?!login$)(?!admin$)[A-Za-z0-9\-_]+$')->name('router.handle');

