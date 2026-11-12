<?php

use App\Http\Controllers\Admin\ShopController;
use App\Http\Controllers\Web\AddressController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\OrderController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\ReviewController;
use App\Http\Controllers\Web\TicketController;
use App\Http\Controllers\Web\UserLoginController;
use App\Http\Controllers\Web\VendorController;
use App\Http\Controllers\Web\WishlistController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/admin.php';


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/save-wishlist', [WishlistController::class, 'saveWishlist'])->name('save_wishlist');
Route::post('/product/review', [ReviewController::class, 'store'])->name('product.review.store');
Route::post('/logo-request', [TicketController::class, 'store'])->name('logo_request.store');

Route::get('/login', function () {
    return view('frontend.login', [
        'title' => 'Login'
    ]);
})->name('login');


Route::post('/user-logout', [UserLoginController::class, 'userLogout'])->name('user_logout');

Route::post('/user/authenticate', [UserLoginController::class, 'userAuthenticate'])->name('user_authenticate');
Route::post('/user/register/update', [UserLoginController::class, 'userRegisterUpdate'])->name('user_register_update');
Route::get('/login/personal', function () {
    return view('frontend.login.personalbuyer.index', [
        'title' => 'Personal Login'
    ]);
})->name('login.personal');

Route::get('/login/business', function () {
    return view('frontend.login.businessbuyer.index', [
        'title' => 'Business Login'
    ]);
})->name('login.business');

Route::get('/login/vendor', function () {
    return view('frontend.login.vendor.index', [
        'title' => 'Vendor Login'
    ]);
})->name('login.vendor');
Route::post('/vendor/register', [VendorController::class, 'register'])->name('vendor.register');

Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/shop/single-product/{id}', [ShopController::class, 'show'])->name('shop.single-product');

Route::get('/order', [OrderController::class, 'create'])->name('order.index');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');

Route::get('/order/advance-payment', [OrderController::class, 'advancePayment'])->name('order.advancepayment');
Route::post('/order/advance-payment/pay', [OrderController::class, 'confirmPayment'])->name('order.advancepayment.pay');

Route::get('/order/sample-process', [OrderController::class, 'sampleProcess'])->name('order.sampleprocess');
Route::get('/order/sample-review', [OrderController::class, 'sampleReview'])->name('order.samplereview');
Route::post('/order/sample-review/request-changes', [OrderController::class, 'requestSampleChanges'])->name('order.sample.request_changes');
Route::post('/order/sample-review/approve', [OrderController::class, 'approveSample'])->name('order.sample.approve');


Route::get('/order/order-success', function () {
    return view('frontend.order.ordersuccess', [
        'currentStep' => 5,
        'title' => 'Order Success'
    ]);
})->name('order.ordersuccess');


// Route::get('/shop/single-product', function () {
//     return view('frontend.productpage', [
//         'title' => 'Product Details'
//     ]);
// });

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'store'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'updateQuantity'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'destroy'])->name('cart.remove');
Route::post('/cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.apply_coupon');
Route::post('/cart/remove-coupon', [CartController::class, 'removeCoupon'])->name('cart.remove_coupon');

Route::get('/order/track-order', function () {
    return view('frontend.trackorder', [
        'title' => 'Track Order'
    ]);
});

Route::get('/order/view-order', function () {
    return view('frontend.vieworder', [
        'title' => 'View Order'
    ]);
});

Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/profile/address', [ProfileController::class, 'index'])->name('profile.address');
Route::get('/profile/orders-activity', [ProfileController::class, 'index'])->name('profile.orders_activity');
Route::get('/profile/notification', [ProfileController::class, 'index'])->name('profile.notification');
Route::get('/profile/support-help', [ProfileController::class, 'index'])->name('profile.support_help');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::post('/profile/address/add', [AddressController::class, 'store'])->name('address.store');
Route::post('/profile/address/{address}/update', [AddressController::class, 'update'])->name('address.update');
Route::post('/profile/address/{address}/delete', [AddressController::class, 'destroy'])->name('address.delete');

Route::post('/support/ticket', [TicketController::class, 'storeSupport'])->name('support.ticket.store');

Route::get('/how-it-works', function () {
    return view('frontend.worksprocess', [
        'title' => 'How It Works'
    ]);
});

Route::get('/contact', function () {
    return view('frontend.contact', [
        'title' => 'Contact Us'
    ]);
});

Route::get('/payment-success', function () {
    return view('frontend.payment.successful', [
        'title' => 'Payment Success'
    ]);
});

Route::get('/payment-failed', function () {
    return view('frontend.payment.failed', [
        'title' => 'Payment Failed'
    ]);
});
