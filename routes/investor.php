<?php

use App\Http\Controllers\Investor\AuthController;
use App\Http\Controllers\Investor\PaymentController;
use App\Http\Controllers\Investor\ReportController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'investor.', 'prefix' => 'investor'], function () {
    Route::get('/', [AuthController::class, 'index'])->name('login.index');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::group(['as' => 'investor.', 'prefix' => 'investor', 'middleware' => ['investor']], function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [AuthController::class, 'edit'])->name('profile.index');
    Route::put('/change-images', [AuthController::class, 'changeImages'])->name('change-images');
    Route::put('/change-password', [AuthController::class, 'changePassword'])->name('change-password');
    Route::put('/profile', [AuthController::class, 'update'])->name('profile.update');
    Route::match(['get', 'post'], '/settings', [AuthController::class, 'settings'])->name('settings');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // Payment
    Route::resource('/payment', PaymentController::class);
});

// ================== Reports Management ================== //
Route::group(['as' => 'investor.', 'prefix' => 'investor', 'middleware' => ['investor']], function () {
    Route::get('/product-statement', [ReportController::class, 'ProductStatement'])->name('product-statement.index');
    Route::get('/product-wise-profit', [ReportController::class, 'productWiseProfit'])->name('product-wise-profit.index');
    Route::get('/statement', [ReportController::class, 'statement'])->name('statement.index');
    Route::get('/product-status', [ReportController::class, 'productStatus'])->name('product-status.index');
});
// ================== Reports Management ================== //
