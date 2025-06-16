<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\TrackingOrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderConfirmationController;

// Landing page
Route::get('/', [PromotionController::class, 'landing']);

// Auth routes
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard routes (protected)
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard.index');
    })->middleware('can:superadmin');
    
    Route::resource('promotions', PromotionController::class);
    Route::resource('tracking', TrackingOrderController::class)->except(['show']);
    
    Route::get('cetak', function(){
        return view('transaksi.cetak');
    });
});
    
use App\Http\Controllers\TransactionController;

Route::middleware(['auth'])->group(function () {
    Route::get('halamanuser', [TransactionController::class, 'index'])->name('halamanuser.index');
});

// Public tracking route
Route::get('lacak-pesanan/{trackingOrder}', [TrackingOrderController::class, 'show'])
    ->name('tracking.show');


// ...

Route::middleware(['auth'])->group(function () {
    Route::get('halamanuser', [TransactionController::class, 'index'])->name('halamanuser.index');
    Route::get('halamanuser/create', [TransactionController::class, 'create'])->name('halamanuser.create');
    Route::post('halamanuser', [TransactionController::class, 'store'])->name('halamanuser.store');
    Route::get('halamanuser/{transaction}', [TransactionController::class, 'show'])->name('halamanuser.show');
    Route::get('halamanuser/{transaction}/invoice', [TransactionController::class, 'invoice'])->name('halamanuser.invoice');
    Route::delete('halamanuser/{transaction}', [TransactionController::class, 'destroy'])->name('halamanuser.destroy');
    
    // Order confirmation routes
    Route::get('order-confirmation', [OrderConfirmationController::class, 'index'])->name('order.confirmation.index');
    Route::post('order-confirmation/{transaction}/approve', [OrderConfirmationController::class, 'approve'])->name('order.confirmation.approve');
    Route::post('order-confirmation/{transaction}/reject', [OrderConfirmationController::class, 'reject'])->name('order.confirmation.reject');
    Route::delete('order-confirmation/{transaction}', [OrderConfirmationController::class, 'destroy'])->name('order.confirmation.destroy');

    Route::prefix('order-confirmation')->group(function () {
        Route::get('/', [OrderConfirmationController::class, 'index'])->name('order.confirmation.index');
        Route::get('/{transaction}', [OrderConfirmationController::class, 'show'])->name('order.confirmation.show');
        Route::post('/{transaction}/approve', [OrderConfirmationController::class, 'approve'])->name('order.confirmation.approve');
        Route::post('/{transaction}/reject', [OrderConfirmationController::class, 'reject'])->name('order.confirmation.reject');
        Route::delete('/{transaction}', [OrderConfirmationController::class, 'destroy'])->name('order.confirmation.destroy');
    });
});
// ...   