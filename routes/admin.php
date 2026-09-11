<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeTypeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\OccasionController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TicketController;
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
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // category
        Route::get('/category-list', [CategoryController::class, 'view'])->name('view_category');
        Route::post('/category-save', [CategoryController::class, 'save'])->name('save_category');
        Route::post('/category-delete', [CategoryController::class, 'destroy'])->name('delete_category');

        // occasions (home "Browse by need" cards)
        Route::get('/occasion-list', [OccasionController::class, 'view'])->name('view_occasion');
        Route::post('/occasion-save', [OccasionController::class, 'save'])->name('save_occasion');
        Route::post('/occasion-delete', [OccasionController::class, 'destroy'])->name('delete_occasion');

        // products
        Route::get('/product-list', [ProductController::class, 'index'])->name('product_list');
        Route::get('/get-variant-values/{attribute_id}', [ProductController::class, 'getVariantValues']);
        Route::get('/get-secondary-values/{attribute_id}', [ProductController::class, 'getSecondaryValues']);
        Route::post('/save-product', [ProductController::class, 'saveProduct'])->name('save_product');
        Route::post('/delete-product', [ProductController::class, 'deleteProduct'])->name('delete_product');

        //attribute values
        Route::get('/attribute-list', [AttributeController::class, 'view'])->name('view_attribute');
        Route::post('/attribute-save', [AttributeController::class, 'save'])->name('save_attribute');

        Route::get('/attribute-type', [AttributeTypeController::class, 'view'])->name('view_attribute_type');
        Route::post('/attribute-type-save', [AttributeTypeController::class, 'save'])->name('save_attribute_type');

        //coupon
        Route::get('/coupon-list', [CouponController::class, 'view'])->name('view_coupon');
        Route::post('/coupon-save', [CouponController::class, 'save'])->name('save_coupon');
        Route::post('/coupon-delete', [CouponController::class, 'destroy'])->name('delete_coupon');

        Route::prefix('orders')->controller(OrderController::class)->group(function () {
            Route::get('/list', 'view')->name('view.orders');
            Route::post('/update-status', 'updateStatus')->name('update.order.status');
        });

        // ticket lists
        Route::get('/ticket-lists', [TicketController::class, 'index'])->name('ticket_lists');
        Route::post('/ticket-save', [TicketController::class, 'saveTicket'])->name('ticket_save');
    });
});
