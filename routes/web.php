<?php

use Illuminate\Support\Facades\Route;

// Import semua Controller yang telah dibuat
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Auth\GoogleController;

/*
|--------------------------------------------------------------------------
| Sisi Pengguna (User Area)
|--------------------------------------------------------------------------
*/

// Halaman Beranda (Step 3.4.3)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman Detail Event (Step 3.4.3)
Route::get('/event/detail', [EventController::class, 'show'])->name('event.detail');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

// Submit review for an event (only authenticated users who purchased)
Route::post('/events/{event}/reviews', [ReviewController::class, 'store'])->name('events.reviews.store');

// Public partner profile with reviews
Route::get('/partners/{partner}', [PartnerController::class, 'show'])->name('partners.show');

// Halaman Checkout
Route::get('/checkout/{event}', [CheckoutController::class, 'create'])->name('checkout.create');
Route::post('/checkout/{event}', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/payment/{order_id}', [CheckoutController::class, 'payment'])->name('checkout.payment');
Route::get('/success/{order_id}', [CheckoutController::class, 'success'])->name('checkout.success');

// Halaman Tiket (Step 3.4.3)
Route::get('/ticket', [EventController::class, 'ticket'])->name('ticket');


/*
|--------------------------------------------------------------------------
| Sisi Admin (Admin Area) - Group Routing (Step 3.4.6)
|--------------------------------------------------------------------------
| Semua rute di bawah ini akan memiliki prefix '/admin' di URL-nya 
| dan nama rute akan diawali dengan 'admin.'
*/

Route::middleware('redirect.if.authenticated')->group(function () {
    Route::get('admin/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('admin/login', [AuthController::class, 'login'])->name('login.post');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
    
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Mengamankan Route Administrasi di balik tembok (Middleware)
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('events', AdminEventController::class);
        Route::resource('organizations', \App\Http\Controllers\Admin\OrganizationController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('partners', PartnerController::class);
        Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');
        Route::post('transactions/{transaction}/resend-reminder', [TransactionController::class, 'resendReminder'])->name('transactions.resendReminder');
        Route::get('whatsapp-logs', [\App\Http\Controllers\Admin\WhatsAppLogController::class, 'index'])->name('whatsapp_logs.index');
    });
});

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('auth.google.callback');

Route::post('/midtrans/callback', [\App\Http\Controllers\MidtransWebhookController::class, 'handle']);