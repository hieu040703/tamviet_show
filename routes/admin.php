<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PostCatalogueController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BannerItemController;
use App\Http\Controllers\Admin\WidgetController;
<<<<<<< HEAD
use App\Http\Controllers\Admin\WidgetItemController;
=======
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\SystemController;
>>>>>>> hieu/update-feature

Route::get('control', function () {
    $control = session('control');
    if ($control) {
        session(['control' => null]);
    } else {
        session(['control' => 'pace-done sidebar-xs']);
    }
    return back();
})->name('control');
Route::get('/login', [LoginController::class, 'showLogin'])->name('login')->middleware('login');;
Route::post('/login', [LoginController::class, 'login'])->name('login')->middleware('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('backend.home')->middleware('auth:admin');
    /* Category */
    Route::group(['prefix' => 'categories'], function () {
<<<<<<< HEAD
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/delete/{id}', [CategoryController::class, 'delete'])->name('categories.delete');
    });
    /* Brand */
    Route::group(['prefix' => 'brands'], function () {
        Route::get('/', [BrandController::class, 'index'])->name('brands.index');
        Route::get('/create', [BrandController::class, 'create'])->name('brands.create');
        Route::post('/store', [BrandController::class, 'store'])->name('brands.store');
        Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('brands.edit');
        Route::put('/update/{id}', [BrandController::class, 'update'])->name('brands.update');
        Route::delete('/delete/{id}', [BrandController::class, 'delete'])->name('brands.delete');
    });
    /* Product */
    Route::group(['prefix' => 'products'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('products.index')->middleware(['auth:admin', 'permission:view_product']);;
=======
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index')->middleware('auth:admin', 'permission:view_category');
        Route::get('/create', [CategoryController::class, 'create'])->name('categories.create')->middleware('auth:admin', 'permission:create_category');
        Route::post('/store', [CategoryController::class, 'store'])->name('categories.store')->middleware('auth:admin', 'permission:create_category');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit')->middleware('auth:admin', 'permission:edit_category');
        Route::put('/update/{id}', [CategoryController::class, 'update'])->name('categories.update')->middleware('auth:admin', 'permission:edit_category');
        Route::delete('/delete/{id}', [CategoryController::class, 'delete'])->name('categories.delete')->middleware('auth:admin', 'permission:delete_category');
    });
    /* Brand */
    Route::group(['prefix' => 'brands'], function () {
        Route::get('/', [BrandController::class, 'index'])->name('brands.index')->middleware('auth:admin', 'permission:view_brand');
        Route::get('/create', [BrandController::class, 'create'])->name('brands.create')->middleware('auth:admin', 'permission:create_brand');
        Route::post('/store', [BrandController::class, 'store'])->name('brands.store')->middleware('auth:admin', 'permission:create_brand');
        Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('brands.edit')->middleware('auth:admin', 'permission:edit_brand');
        Route::put('/update/{id}', [BrandController::class, 'update'])->name('brands.update')->middleware('auth:admin', 'permission:edit_brand');
        Route::delete('/delete/{id}', [BrandController::class, 'delete'])->name('brands.delete')->middleware('auth:admin', 'permission:delete_brand');
    });
    /* Product */
    Route::group(['prefix' => 'products'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('products.index')->middleware(['auth:admin', 'permission:view_product']);
>>>>>>> hieu/update-feature
        Route::get('/create', [ProductController::class, 'create'])->name('products.create')->middleware(['auth:admin', 'permission:create_product']);
        Route::post('/store', [ProductController::class, 'store'])->name('products.store')->middleware(['auth:admin', 'permission:create_product']);
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('products.edit')->middleware(['auth:admin', 'permission:edit_product']);
        Route::put('/update/{id}', [ProductController::class, 'update'])->name('products.update')->middleware(['auth:admin', 'permission:edit_product']);
        Route::delete('/delete/{id}', [ProductController::class, 'delete'])->name('products.delete')->middleware(['auth:admin', 'permission:delete_product']);
    });

    Route::group(['prefix' => 'posts'], function () {
        /* Post */
<<<<<<< HEAD
        Route::get('/', [PostController::class, 'index'])->name('posts.index');
        Route::get('/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/store', [PostController::class, 'store'])->name('posts.store');
        Route::get('/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/update/{id}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/delete/{id}', [PostController::class, 'delete'])->name('posts.delete');
        /* Post Catalogue*/
        Route::group(['prefix' => 'catalogues'], function () {
            Route::get('/', [PostCatalogueController::class, 'index'])->name('post_catalogues.index');
            Route::get('/create', [PostCatalogueController::class, 'create'])->name('post_catalogues.create');
            Route::post('/store', [PostCatalogueController::class, 'store'])->name('post_catalogues.store');
            Route::get('/edit/{id}', [PostCatalogueController::class, 'edit'])->name('post_catalogues.edit');
            Route::put('/update/{id}', [PostCatalogueController::class, 'update'])->name('post_catalogues.update');
            Route::delete('/delete/{id}', [PostCatalogueController::class, 'delete'])->name('post_catalogues.delete');
=======
        Route::get('/', [PostController::class, 'index'])->name('posts.index')->middleware(['auth:admin', 'permission:view_post']);
        Route::get('/create', [PostController::class, 'create'])->name('posts.create')->middleware(['auth:admin', 'permission:create_post']);
        Route::post('/store', [PostController::class, 'store'])->name('posts.store')->middleware(['auth:admin', 'permission:create_post']);
        Route::get('/edit/{id}', [PostController::class, 'edit'])->name('posts.edit')->middleware(['auth:admin', 'permission:edit_post']);
        Route::put('/update/{id}', [PostController::class, 'update'])->name('posts.update')->middleware(['auth:admin', 'permission:edit_post']);
        Route::delete('/delete/{id}', [PostController::class, 'delete'])->name('posts.delete')->middleware(['auth:admin', 'permission:delete_post']);
        /* Post Catalogue*/
        Route::group(['prefix' => 'catalogues'], function () {
            Route::get('/', [PostCatalogueController::class, 'index'])->name('post_catalogues.index')->middleware(['auth:admin', 'permission:view_post_catalogue']);
            Route::get('/create', [PostCatalogueController::class, 'create'])->name('post_catalogues.create')->middleware(['auth:admin', 'permission:create_post_catalogue']);
            Route::post('/store', [PostCatalogueController::class, 'store'])->name('post_catalogues.store')->middleware(['auth:admin', 'permission:create_post_catalogue']);
            Route::get('/edit/{id}', [PostCatalogueController::class, 'edit'])->name('post_catalogues.edit')->middleware(['auth:admin', 'permission:edit_post_catalogue']);
            Route::put('/update/{id}', [PostCatalogueController::class, 'update'])->name('post_catalogues.update')->middleware(['auth:admin', 'permission:edit_post_catalogue']);
            Route::delete('/delete/{id}', [PostCatalogueController::class, 'delete'])->name('post_catalogues.delete')->middleware(['auth:admin', 'permission:delete_post_catalogue']);
>>>>>>> hieu/update-feature
        });
    });
    /* USER */
    Route::group(['prefix' => 'users'], function () {
<<<<<<< HEAD
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/store', [UserController::class, 'store'])->name('users.store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
    });
    /* Role */
    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('roles.index');
        Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('/store', [RoleController::class, 'store'])->name('roles.store');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
        Route::put('/update/{id}', [RoleController::class, 'update'])->name('roles.update');
        Route::delete('/delete/{id}', [RoleController::class, 'delete'])->name('roles.delete');
    });
    /* PERMISSIONS */
    Route::group(['prefix' => 'permissions'], function () {
        Route::get('/', [PermissionController::class, 'index'])->name('permissions.index');
        Route::get('/create', [PermissionController::class, 'create'])->name('permissions.create');
        Route::post('/store', [PermissionController::class, 'store'])->name('permissions.store');
        Route::get('/edit/{id}', [PermissionController::class, 'edit'])->name('permissions.edit');
        Route::put('/update/{id}', [PermissionController::class, 'update'])->name('permissions.update');
        Route::delete('/delete/{id}', [PermissionController::class, 'delete'])->name('permissions.delete');
    });
    /* BANNER */
    Route::group(['prefix' => 'banners'], function () {
        Route::get('/', [BannerController::class, 'index'])->name('banners.index');
        Route::get('/create', [BannerController::class, 'create'])->name('banners.create');
        Route::post('/store', [BannerController::class, 'store'])->name('banners.store');
        Route::get('/edit/{id}', [BannerController::class, 'edit'])->name('banners.edit');
        Route::put('/update/{id}', [BannerController::class, 'update'])->name('banners.update');
        Route::delete('/delete/{id}', [BannerController::class, 'delete'])->name('banners.delete');
=======
        Route::get('/', [UserController::class, 'index'])->name('users.index')->middleware(['auth:admin', 'permission:view_user']);
        Route::get('/create', [UserController::class, 'create'])->name('users.create')->middleware(['auth:admin', 'permission:create_user']);
        Route::post('/store', [UserController::class, 'store'])->name('users.store')->middleware(['auth:admin', 'permission:create_user']);
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('users.edit')->middleware(['auth:admin', 'permission:edit_user']);
        Route::put('/update/{id}', [UserController::class, 'update'])->name('users.update')->middleware(['auth:admin', 'permission:edit_user']);
        Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('users.delete')->middleware(['auth:admin', 'permission:delete_user']);
    });
    /* Role */
    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('roles.index')->middleware(['auth:admin', 'permission:view_role']);
        Route::get('/create', [RoleController::class, 'create'])->name('roles.create')->middleware(['auth:admin', 'permission:create_role']);
        Route::post('/store', [RoleController::class, 'store'])->name('roles.store')->middleware(['auth:admin', 'permission:create_role']);
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit')->middleware(['auth:admin', 'permission:edit_role']);
        Route::put('/update/{id}', [RoleController::class, 'update'])->name('roles.update')->middleware(['auth:admin', 'permission:edit_role']);
        Route::delete('/delete/{id}', [RoleController::class, 'delete'])->name('roles.delete')->middleware(['auth:admin', 'permission:delete_role']);
    });
    /* PERMISSIONS */
    Route::group(['prefix' => 'permissions'], function () {
        Route::get('/', [PermissionController::class, 'index'])->name('permissions.index')->middleware(['auth:admin', 'permission:view_permission']);
        Route::get('/create', [PermissionController::class, 'create'])->name('permissions.create')->middleware(['auth:admin', 'permission:create_permission']);
        Route::post('/store', [PermissionController::class, 'store'])->name('permissions.store')->middleware(['auth:admin', 'permission:create_permission']);
        Route::get('/edit/{id}', [PermissionController::class, 'edit'])->name('permissions.edit')->middleware(['auth:admin', 'permission:edit_permission']);
        Route::put('/update/{id}', [PermissionController::class, 'update'])->name('permissions.update')->middleware(['auth:admin', 'permission:edit_permission']);
        Route::delete('/delete/{id}', [PermissionController::class, 'delete'])->name('permissions.delete')->middleware(['auth:admin', 'permission:delete_permission']);
    });
    /* BANNER */
    Route::group(['prefix' => 'banners'], function () {
        Route::get('/', [BannerController::class, 'index'])->name('banners.index')->middleware(['auth:admin', 'permission:view_banner']);
        Route::get('/create', [BannerController::class, 'create'])->name('banners.create')->middleware(['auth:admin', 'permission:create_banner']);
        Route::post('/store', [BannerController::class, 'store'])->name('banners.store')->middleware(['auth:admin', 'permission:create_banner']);
        Route::get('/edit/{id}', [BannerController::class, 'edit'])->name('banners.edit')->middleware(['auth:admin', 'permission:edit_banner']);
        Route::put('/update/{id}', [BannerController::class, 'update'])->name('banners.update')->middleware(['auth:admin', 'permission:edit_banner']);
        Route::delete('/delete/{id}', [BannerController::class, 'delete'])->name('banners.delete')->middleware(['auth:admin', 'permission:delete_banner']);
>>>>>>> hieu/update-feature
    });

    /* BANNER ITEM */
    Route::group(['prefix' => 'banner-items'], function () {
<<<<<<< HEAD
        Route::get('/', [BannerItemController::class, 'index'])->name('banner_items.index');
        Route::get('/create', [BannerItemController::class, 'create'])->name('banner_items.create');
        Route::post('/store', [BannerItemController::class, 'store'])->name('banner_items.store');
        Route::get('/edit/{id}', [BannerItemController::class, 'edit'])->name('banner_items.edit');
        Route::put('/update/{id}', [BannerItemController::class, 'update'])->name('banner_items.update');
        Route::delete('/delete/{id}', [BannerItemController::class, 'delete'])->name('banner_items.delete');

        // SORT
        Route::post('/sort', [BannerItemController::class, 'sort'])->name('banner_items.sort');
    });
    /* Widget */
    Route::group(['prefix' => 'widgets'], function () {
        Route::get('/', [WidgetController::class, 'index'])->name('widgets.index');
        Route::get('/create', [WidgetController::class, 'create'])->name('widgets.create');
        Route::post('/store', [WidgetController::class, 'store'])->name('widgets.store');
        Route::get('/edit/{id}', [WidgetController::class, 'edit'])->name('widgets.edit');
        Route::post('/update/{id}', [WidgetController::class, 'update'])->name('widgets.update');
        Route::post('/delete/{id}', [WidgetController::class, 'destroy'])->name('widgets.destroy');
    });
    /* Widget items – lồng theo widget */
    Route::group(['prefix' => 'widget-items'], function () {
        Route::get('/create/{widget}', [WidgetItemController::class, 'create'])->name('widget_items.create');
        Route::post('/store/{widget}', [WidgetItemController::class, 'store'])->name('widget_items.store');
        Route::get('/edit/{id}', [WidgetItemController::class, 'edit'])->name('widget_items.edit');
        Route::post('/update/{id}', [WidgetItemController::class, 'update'])->name('widget_items.update');
        Route::post('/delete/{id}', [WidgetItemController::class, 'destroy'])->name('widget_items.destroy');

        // AJAX search
        Route::get('/search', [WidgetItemController::class, 'search'])->name('widget_items.search');
=======
        Route::get('/', [BannerItemController::class, 'index'])->name('banner_items.index')->middleware(['auth:admin', 'permission:view_banner_item']);
        Route::get('/create', [BannerItemController::class, 'create'])->name('banner_items.create')->middleware(['auth:admin', 'permission:create_banner_item']);
        Route::post('/store', [BannerItemController::class, 'store'])->name('banner_items.store')->middleware(['auth:admin', 'permission:create_banner_item']);
        Route::get('/edit/{id}', [BannerItemController::class, 'edit'])->name('banner_items.edit')->middleware(['auth:admin', 'permission:edit_banner_item']);
        Route::put('/update/{id}', [BannerItemController::class, 'update'])->name('banner_items.update')->middleware(['auth:admin', 'permission:edit_banner_item']);
        Route::delete('/delete/{id}', [BannerItemController::class, 'delete'])->name('banner_items.delete')->middleware(['auth:admin', 'permission:delete_banner_item']);
    });
    /* Widget */
    Route::group(['prefix' => 'widgets'], function () {
        Route::get('/', [WidgetController::class, 'index'])->name('widgets.index')->middleware(['auth:admin', 'permission:view_widget']);
        Route::get('/create', [WidgetController::class, 'create'])->name('widgets.create')->middleware(['auth:admin', 'permission:create_widget']);
        Route::post('/', [WidgetController::class, 'store'])->name('widgets.store')->middleware(['auth:admin', 'permission:create_widget']);
        Route::get('/edit/{widget}', [WidgetController::class, 'edit'])->name('widgets.edit')->middleware(['auth:admin', 'permission:edit_widget']);
        Route::put('/update/{widget}', [WidgetController::class, 'update'])->name('widgets.update')->middleware(['auth:admin', 'permission:edit_widget']);
        Route::delete('/{id}', [WidgetController::class, 'delete'])->name('widgets.delete')->middleware(['auth:admin', 'permission:delete_widget']);
    });
    /* Menu */
    Route::group(['prefix' => 'menus'], function () {
        Route::get('/', [MenuController::class, 'index'])->name('menus.index')->middleware(['auth:admin', 'permission:view_menu']);
        Route::get('/create', [MenuController::class, 'create'])->name('menus.create')->middleware(['auth:admin', 'permission:create_menu']);
        Route::post('/', [MenuController::class, 'store'])->name('menus.store')->middleware(['auth:admin', 'permission:create_menu']);
        Route::get('/edit/{menu}', [MenuController::class, 'edit'])->name('menus.edit')->middleware(['auth:admin', 'permission:edit_menu']);
        Route::put('/update/{menu}', [MenuController::class, 'update'])->name('menus.update')->middleware(['auth:admin', 'permission:edit_menu']);
        Route::delete('/{menu}', [MenuController::class, 'delete'])->name('menus.delete')->middleware(['auth:admin', 'permission:delete_menu']);
        Route::get('/{menu}/items', [MenuController::class, 'items'])->name('menus.items')->middleware(['auth:admin', 'permission:view_menu_item']);
        Route::post('/{menu}/items/save', [MenuController::class, 'saveItems'])->name('menus.items.save')->middleware(['auth:admin', 'permission:save_menu_item']);
    });
    /* Contact */
    Route::group(['prefix' => 'contacts'], function () {
        Route::get('/', [ContactController::class, 'index'])->name('contacts.index')->middleware(['auth:admin', 'permission:view_contact']);
        Route::get('/edit/{id}', [ContactController::class, 'edit'])->name('contacts.edit')->middleware(['auth:admin', 'permission:edit_contact']);
        Route::put('/update/{id}', [ContactController::class, 'update'])->name('contacts.update')->middleware(['auth:admin', 'permission:edit_contact']);
        Route::delete('/{id}', [ContactController::class, 'delete'])->name('contacts.delete')->middleware(['auth:admin', 'permission:delete_contact']);
    });
    /* SystemLibrary */
    Route::group(['prefix' => '/system'], function () {
        Route::get('/', [SystemController::class, 'index'])->name('system.index');
        Route::post('create', [SystemController::class, 'store'])->name('system.store');
>>>>>>> hieu/update-feature
    });
});
