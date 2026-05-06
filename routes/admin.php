<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CouponController;
use App\Http\Controllers\admin\DashBoardController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {

    Route::middleware(['guest'])->as('admin.')->group(function () {
        Route::view('/login', 'auth.login')->name('login');
        Route::view('/register', 'auth.register')->name('register');
        Route::controller(AuthController::class)->group(function () {
            Route::post('/authenticate', 'adminAuthenticate')->name('authenticate');
            Route::post('/register/update', 'registerUpdate')->name('register.update');
        });
    });

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [DashBoardController::class, 'index'])->name('dashboard');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::post('/user_logout', [AuthController::class, 'user_logout'])->name('user_logout');

        // category
        Route::get('/category-list', [CategoryController::class, 'view'])->name('view_category');
        Route::post('/category-save', [CategoryController::class, 'save'])->name('save_category');
        Route::post('/category-delete', [CategoryController::class, 'destroy'])->name('delete_category');

        // products
        Route::get('/product-list', [ProductController::class, 'index'])->name('product_list');
        Route::get('/get-variant-values/{attribute_id}', [ProductController::class, 'getVariantValues']);
        Route::get('/get-secondary-values/{attribute_id}', [ProductController::class, 'getSecondaryValues']);
        Route::post('/save-product', [ProductController::class, 'saveProduct'])->name('save_product');
        Route::post('/delete-product', [ProductController::class, 'deleteProduct'])->name('delete_product');

        //attribute values
        Route::get('/attribute-list', [AttributeController::class, 'view'])->name('view_attribute');
        Route::post('/attribute-save', [AttributeController::class, 'save'])->name('save_attribute');

        //coupon
        Route::get('/coupon-list', [CouponController::class, 'view'])->name('view_coupon');
        Route::post('/coupon-save', [CouponController::class, 'save'])->name('save_coupon');
        Route::post('/coupon-delete', [CouponController::class, 'destroy'])->name('delete_coupon');
    });
});
