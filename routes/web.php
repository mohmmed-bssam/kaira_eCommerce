<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\SliderController;
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
        Route::get('settings', [DashboardController::class, 'settings'])->name('settings');
        Route::put('settings', [DashboardController::class, 'settings_update']);
        Route::get('subscriptions', [DashboardController::class, 'subscriptions'])->name('subscriptions');
        Route::get('messages', [DashboardController::class, 'messages'])->name('messages');
        Route::delete('delete_messages/{id}', [DashboardController::class, 'delete_messages'])->name('delete_messages');
    });
});




require __DIR__ . '/auth.php';
