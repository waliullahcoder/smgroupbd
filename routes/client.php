<?php

use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\ClientOrderController;
use App\Http\Controllers\Client\ClientReportController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'client.', 'prefix' => 'client'], function () {
    Route::get('/', [AuthController::class, 'index'])->name('login.index');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::group(['as' => 'client.', 'prefix' => 'client', 'middleware' => ['client_permission']], function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard.index');
    Route::get('/profile', [AuthController::class, 'edit'])->name('profile.index');
    Route::put('/change-images', [AuthController::class, 'changeImages'])->name('change-images');
    Route::put('/change-password', [AuthController::class, 'changePassword'])->name('change-password');
    Route::put('/profile', [AuthController::class, 'update'])->name('profile.update');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('/product-request', ClientOrderController::class);
});

// ================== Reports Management ================== //
Route::group(['as' => 'client.', 'prefix' => 'client', 'middleware' => ['client_permission']], function () {
    Route::get('/purchase-log', [ClientReportController::class, 'purchaseLog'])->name('purchase-log.index');
    Route::get('/return-log', [ClientReportController::class, 'returnLog'])->name('return-log.index');
    Route::get('/payment-log', [ClientReportController::class, 'paymentLog'])->name('payment-log.index');
    Route::get('/statement', [ClientReportController::class, 'statement'])->name('statement.index');
});
// ================== Reports Management ================== //
