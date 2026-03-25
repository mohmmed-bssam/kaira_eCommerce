<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartComposer
{
    public function compose(View $view)
    {
        $cartCount = 0;
        $cartItems = collect();

        if (Auth::check()) {

            $cart = Cart::with(['items.product'])
                ->where('user_id', Auth::id())
                ->first();

            if ($cart) {
                $cartItems = $cart->items->filter(fn($item) => $item->product);
                $cartCount = $cartItems->sum('quantity');
            }
        }

        $view->with([
            'cartCount' => $cartCount,
            'cartItems' => $cartItems,
            'cart' => $cart ?? null
        ]);
    }
}