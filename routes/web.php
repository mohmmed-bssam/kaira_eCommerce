<?php
// Front Controllers
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController as FrontProductController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\WishlistController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\PageController;
// Dashboard Controllers
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
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::prefix(LaravelLocalization::setLocale())->group(function () {
        // Website Routes
        Route::name('front.')->group(function () {

            // Home
            Route::get('/', [HomeController::class, 'index'])->name('home');

            // Shop
            Route::get('/shop', [FrontProductController::class, 'index'])->name('shop.index');
            Route::get('/product/{product:slug}', [FrontProductController::class, 'show'])->name('product.show');
            Route::get('/category/{category:slug}', [FrontProductController::class, 'category'])->name('category.show');

            // Cart
            Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
            Route::middleware('auth')->group(function () {
                Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])
                    ->name('cart.updateQuantity');
                Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.store');
                Route::patch('/cart/{item}', [CartController::class, 'update'])->name('cart.update');
                Route::delete('/cart/{item}', [CartController::class, 'destroy'])->name('cart.destroy');
            });
            // Wishlist
            Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
            Route::post('/wishlist/{product}', [WishlistController::class, 'store'])->name('wishlist.store');
            Route::delete('/wishlist/{product}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

            // Checkout
            Route::middleware(['auth'])->group(function () {
                Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
                Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
            });

            // Static Pages
            Route::prefix('pages')->name('pages.')->group(function () {
                Route::get('/about', fn() => view('front.pages.about'))->name('about');
                Route::get('/account', fn() => view('front.pages.account'))->name('account');
                Route::get('/tracking', fn() => view('front.pages.tracking'))->name('tracking');
            });
            //payment
            Route::get('/payment/{order}', [PaymentController::class, 'checkout'])->name('payment.checkout');

            Route::get('/payment/success/{order}', [PaymentController::class, 'success'])->name('payment.success');

            Route::get('/payment/cancel/{order}', [PaymentController::class, 'cancel'])->name('payment.cancel');


            Route::get('/blog', [PageController::class, 'blog'])->name('blog.index');
            Route::get('/contact', [PageController::class, 'contact'])->name('contact');
            Route::post('/contact', [PageController::class, 'contactStore'])->name('contact.store');
            Route::post('/subscribe', [PageController::class, 'subscribe'])->name('subscribe');
        }
    );
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
            Route::get('payments', [DashboardPaymentController::class, 'payments'])->name('payments');
        });
    });
});




require __DIR__ . '/auth.php';
