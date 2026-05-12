<?php

use Illuminate\Support\Facades\Route;

// Import semua Controller yang telah dibuat
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Admin\EventController as AdminEventController;

/*
|--------------------------------------------------------------------------
| Sisi Pengguna (User Area)
|--------------------------------------------------------------------------
*/

// Halaman Beranda (Step 3.4.3)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman Detail Event (Step 3.4.3)
Route::get('/event/detail', [EventController::class, 'show'])->name('event.detail');

// Halaman Checkout (Step 3.4.3)
Route::get('/checkout', [EventController::class, 'checkout'])->name('event.checkout');

// Halaman Tiket (Step 3.4.3)
Route::get('/ticket', [EventController::class, 'ticket'])->name('ticket');


/*
|--------------------------------------------------------------------------
| Sisi Admin (Admin Area) - Group Routing (Step 3.4.6)
|--------------------------------------------------------------------------
| Semua rute di bawah ini akan memiliki prefix '/admin' di URL-nya 
| dan nama rute akan diawali dengan 'admin.'
*/

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    // Dashboard Admin (Step 3.4.5) -> url: /admin
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Kelola Event (Step 3.4.5) -> url: /admin/events
    Route::resource('events', AdminEventController::class);

    // Manajemen Kategori (Latihan 3.5) -> url: /admin/categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

    // Laporan Transaksi -> url: /admin/transactions
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');

});