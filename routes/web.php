<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TopbarController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PaketLaundryController;

// Rute untuk halaman utama
Route::get('/', [App\Http\Controllers\HomeController::class, 'root']);

// Rute-rute yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {
    // Rute untuk topbar
    Route::get('/topbar', [TopbarController::class, 'index'])->name('topbar');

    // Rute-rute terkait order
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/on-going-orders', [OrderController::class, 'showOnGoingOrders'])->name('on-going-orders');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::put('/order/finish/{orderId}', [OrderController::class, 'finish'])->name('orders.finish');
    Route::get('/orders/{orderId}', [OrderController::class, 'getOrderDetails']);

    // Rute untuk logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Rute Paket Laundry
    Route::get('/paket-laundry/{nama_paket}', [PaketLaundryController::class, 'getByNamaPaket']);
});

// Rute-rute yang tidak memerlukan autentikasi
Route::get('/orders/not-finished', [OrderController::class, 'getOrdersNotFinish']);
Route::get('/all-orders', [OrderController::class, 'getOrdersAll']);

// Rute untuk aplikasi SPA (Single Page Application)
Route::get('/{any}', [App\Http\Controllers\HomeController::class, 'index'])->where('any', '.*');

