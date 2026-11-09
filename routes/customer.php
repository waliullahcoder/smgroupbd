<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\AuthController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CheckoutController;

Route::group(['as' => 'customer.', 'prefix' => 'customer'], function () {

    Route::group(['middleware' => ['guest']], function () {
        route::get('/redirect-login', [AuthController::class, 'redirectLogin'])->name('redirect-login');
        route::match(['get', 'post'], '/login-with-otp', [AuthController::class, 'sendOtp'])->name('send-otp');
        route::match(['get', 'post'], '/login', [AuthController::class, 'login'])->name('login');
        route::match(['get', 'post'], '/register', [AuthController::class, 'register'])->name('register');
    });

    Route::group(['middleware' => ['customer']], function () {
        route::match(['get', 'post'], '/profile', [AuthController::class, 'profile'])->name('profile');
        route::match(['get', 'post'], '/address', [AuthController::class, 'address'])->name('address');
        route::get('/orders/{id?}', [AuthController::class, 'orders'])->name('orders');
        route::get('/return-orders/{id?}', [AuthController::class, 'returnOrders'])->name('return-orders');
        route::post('/review', [AuthController::class, 'review'])->name('review');
        route::get('/wishlist', [AuthController::class, 'wishlist'])->name('wishlist');
        route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    });

    // Cart Management
    route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add-cart');
    route::post('/update-cart-qty', [CartController::class, 'updateCart'])->name('update-cart');
    route::get('/remove-from-cart', [CartController::class, 'removeFromCart'])->name('remove-cart');
    route::get('/cart', [CartController::class, 'cart'])->name('cart');
    route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
    route::post('/checkout', [CheckoutController::class, 'checkoutStore'])->name('checkout');
});

require __DIR__ . '/auth.php';
