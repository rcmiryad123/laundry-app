<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TopbarController;

Auth::routes();

// Rute untuk halaman utama
Route::get('/', [App\Http\Controllers\HomeController::class, 'root']);

// Rute-rute yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {
    // Rute untuk topbar
    Route::get('/topbar', [TopbarController::class, 'index'])->name('topbar');

    // Get all Order di tabel
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    // Get all Order di tabel JSON Format
    Route::get('/orders/json', [OrderController::class, 'indexJson'])->name('orders.json');
    // Get Order by ID
    Route::get('/order/{order:id}', [OrderController::class, 'DetailsOrder'])->name('orders.details');
    // Finished Order -- Memfinishkan Order yang sudah selesai
    Route::get('/finish-order/{order:id}', [OrderController::class, 'FinishedOrder'])->name('orders.finished');
    // Add Order
    Route::post('/add-order', [OrderController::class, 'store'])->name('orders.add');
    // Get Order by ID
    Route::get('/invoices/{order:id}', [OrderController::class, 'InvoicesDetailsOrder'])->name('invoices.details');
});

// Rute untuk aplikasi SPA (Single Page Application)
Route::get('/{any}', [App\Http\Controllers\HomeController::class, 'index'])->where('any', '.*');

