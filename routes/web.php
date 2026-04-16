<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.home');
});

Route::get('/login', function () {
    return view('frontend.login');
});

Route::get('/login/personal', function () {
    return view('frontend.login.personalbuyer.index');
})->name('login.personal');

Route::get('/login/business', function () {
    return view('frontend.login.businessbuyer.index');
})->name('login.business');

Route::get('/login/vendor', function () {
    return view('frontend.login.vendor.index');
})->name('login.vendor');

Route::get('/shop', function () {
    return view('frontend.shop');
});

Route::get('/order', function () {
    return view('frontend.order', ['currentStep' => 1]);
})->name('order.index');

Route::get('/order/advance-payment', function () {
    return view('frontend.order.advancepaymentpage', ['currentStep' => 2]);
})->name('order.advancepayment');

Route::get('/order/sample-process', function () {
    return view('frontend.order.sampleprocess', ['currentStep' => 3]);
})->name('order.sampleprocess');

Route::get('/order/sample-review', function () {
    return view('frontend.order.samplereview', ['currentStep' => 4]);
})->name('order.samplereview');

Route::get('/order/order-success', function () {
    return view('frontend.order.ordersuccess', ['currentStep' => 5]);
})->name('order.ordersuccess');

Route::get('/shop/single-product', function () {
    return view('frontend.productpage');
});

Route::get('/cart', function () {
    return view('frontend.cart');
});

Route::get('/order/track-order', function () {
    return view('frontend.trackorder');
});

Route::get('/order/view-order', function () {
    return view('frontend.vieworder');
});

Route::get('/wishlist', function () {
    return view('frontend.wishlist');
});

Route::get('/profile', function () {
    return view('frontend.profile.index');
});

Route::get('/profile/address', function () {
    return view('frontend.profile.index');
});

Route::get('/profile/orders-activity', function () {
    return view('frontend.profile.index');
});

Route::get('/profile/notification', function () {
    return view('frontend.profile.index');
});

Route::get('/profile/support-help', function () {
    return view('frontend.profile.index');
});

// Route::get('/how-it-works', function () {
//     return view('frontend.worksprocess');
// });

// Route::get('/contact', function () {
//     return view('frontend.contact');
// });