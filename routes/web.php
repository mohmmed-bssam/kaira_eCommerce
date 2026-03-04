<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\OrderTrackingController;
use App\Http\Controllers\Dashboard\PaymentController as DashboardPaymentController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\SliderController;
use App\Http\Controllers\OrderController as ControllersOrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Dashboard Routes
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::resource('sliders', SliderController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        Route::resource('orders', OrderController::class)->only(['index', 'show', 'update', 'destroy']);
        Route::resource('payments', PaymentController::class)->only(['index', 'show']);

        // Tracking داخل الطلب
        Route::post('orders/{order}/tracking', [OrderTrackingController::class, 'store'])->name('orders.tracking.store');
        Route::delete('orders/{order}/tracking/{tracking}', [OrderTrackingController::class, 'destroy'])->name('orders.tracking.destroy');
        Route::get('settings', [DashboardController::class, 'settings'])->name('settings');
        Route::put('settings', [DashboardController::class, 'settings_update']);
        Route::get('subscriptions', [DashboardController::class, 'subscriptions'])->name('subscriptions');
        Route::get('messages', [DashboardController::class, 'messages'])->name('messages');
        Route::delete('delete_messages/{id}', [DashboardController::class, 'delete_messages'])->name('delete_messages');
        Route::get('customers', [DashboardPaymentController::class, 'customers'])->name('customers');
        Route::get('payments', [DashboardPaymentController::class, 'payments'])->name( 'payments');
    });
});




require __DIR__ . '/auth.php';
