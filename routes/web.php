<?php

use Illuminate\Support\Facades\Route;

// Import semua Controller yang telah dibuat
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

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

Route::get('admin/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('admin/login', [AuthController::class, 'login'])->name('login.post');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Mengamankan Route Administrasi di balik tembok (Middleware)
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('events', AdminEventController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('partners', PartnerController::class);
        Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');
    });
});