<?php

use App\Http\Controllers\Web\HomeController;
use Illuminate\Support\Facades\Route;
require __DIR__ . '/admin.php';


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', function () {
    return view('frontend.login', [
        'title' => 'Login'
    ]);
});

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

Route::get('/shop', function () {
    return view('frontend.shop',[
        'title' => 'Shop'
        ]);
});

Route::get('/order', function () {
    return view('frontend.order', [
        'currentStep' => 1,
        'title' => 'Customize & Order'
    ]);
})->name('order.index');

Route::get('/order/advance-payment', function () {
    return view('frontend.order.advancepaymentpage', [
        'currentStep' => 2,
        'title' => 'Advance Payment'
    ]);
})->name('order.advancepayment');

Route::get('/order/sample-process', function () {
    return view('frontend.order.sampleprocess', [
        'currentStep' => 3,
        'title' => 'Sample Process'
    ]);
})->name('order.sampleprocess');

Route::get('/order/sample-review', function () {
    return view('frontend.order.samplereview', [
        'currentStep' => 4,
        'title' => 'Sample Review'
    ]);
})->name('order.samplereview');


Route::get('/order/order-success', function () {
    return view('frontend.order.ordersuccess', [
        'currentStep' => 5,
        'title' => 'Order Success'
    ]);
})->name('order.ordersuccess');


Route::get('/shop/single-product', function () {
    return view('frontend.productpage', [
        'title' => 'Product Details'
    ]);
});

Route::get('/cart', function () {
    return view('frontend.cart', [
        'title' => 'Shopping Cart'
    ]);
});

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

Route::get('/wishlist', function () {
    return view('frontend.wishlist', [
        'title' => 'Wishlist'
    ]);
});

Route::get('/profile', function () {
    return view('frontend.profile.index', [
        'title' => 'My Profile'
    ]);
});

Route::get('/profile/address', function () {
    return view('frontend.profile.index', [
        'title' => 'My Address'
    ]);
});

Route::get('/profile/orders-activity', function () {
    return view('frontend.profile.index', [
        'title' => 'Orders & Activity'
    ]);
});

Route::get('/profile/notification', function () {
    return view('frontend.profile.index', [
        'title' => 'Notifications'
    ]);
});

Route::get('/profile/support-help', function () {
    return view('frontend.profile.index', [
        'title' => 'Support & Help'
    ]);
});

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
