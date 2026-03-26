<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Setting;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\View\Composers\CartComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        $settings = Setting::all()->pluck('value', 'key')->toArray();
        View::share('settings', $settings);

        View::composer('*', CartComposer::class);

        View::composer('*', function ($view) {

            $wishlistProductIds = Auth::check()
                ? Wishlist::where('user_id', Auth::id())->pluck('product_id')->toArray()
                : [];

            $wishlistCount = Auth::check()
                ? Wishlist::where('user_id', Auth::id())->count()
                : 0;

            $view->with('wishlistProductIds', $wishlistProductIds);
            $view->with('wishlistCount', $wishlistCount);
        });
        
    }
}