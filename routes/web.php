<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\TrackingOrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderConfirmationController;
use App\Http\Controllers\TransactionController;

// Landing page
Route::get('/', [PromotionController::class, 'landing']);

// Auth routes
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Public tracking route
Route::get('lacak-pesanan/{tracking}', [TrackingOrderController::class, 'show'])
    ->name('tracking.show');

// Protected routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('dashboard', function () {
        return view('dashboard.index');
    })->middleware('can:superadmin');
    
    // Promotions
    Route::resource('promotions', PromotionController::class);
    
    // Tracking Orders
    Route::resource('tracking', TrackingOrderController::class)->except(['show']);
    Route::get('cetak', function(){
        return view('transaksi.cetak');
    });
    Route::get('tracking-user', [TrackingOrderController::class, 'showUser'])->name('tracking.showuser');
    // Transactions (halamanuser)
    Route::prefix('halamanuser')->group(function () {
        Route::get('/', [TransactionController::class, 'index'])->name('halamanuser.index');
        Route::get('/create', [TransactionController::class, 'create'])->name('halamanuser.create');
        Route::post('/', [TransactionController::class, 'store'])->name('halamanuser.store');
        Route::get('/{transaction}', [TransactionController::class, 'show'])->name('halamanuser.show');
        Route::get('/{transaction}/invoice', [TransactionController::class, 'invoice'])->name('halamanuser.invoice');
        Route::delete('/{transaction}', [TransactionController::class, 'destroy'])->name('halamanuser.destroy');
    });
    
    // Order Confirmation
    Route::prefix('order-confirmation')->group(function () {
        Route::get('/', [OrderConfirmationController::class, 'index'])->name('order.confirmation.index');
        Route::get('/{transaction}', [OrderConfirmationController::class, 'show'])->name('order.confirmation.show');
        Route::post('/{transaction}/approve', [OrderConfirmationController::class, 'approve'])->name('order.confirmation.approve');
        Route::post('/{transaction}/reject', [OrderConfirmationController::class, 'reject'])->name('order.confirmation.reject');
        Route::delete('/{transaction}', [OrderConfirmationController::class, 'destroy'])->name('order.confirmation.destroy');
    });
});