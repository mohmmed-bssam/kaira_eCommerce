<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Flasher\Prime\flash;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::with(['items.product.images'])
            ->where('user_id', Auth::id())
            ->first();
        return view('front.pages.cart.index', compact('cart'));
    }

    public function store(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        $userId = Auth::id();

        $cart = Cart::firstOrCreate([
            'user_id' => $userId
        ]);

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {

            $cartItem->quantity += 1;
            $cartItem->save();
        } else {

            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'price' => $product->price,
                'quantity' => 1
            ]);
        }
        flash()->success('Product added to cart successfully!');
        return redirect()->back();
    }

    // public function update(Request $request, $itemId)
    // {
    //     $item = CartItem::findOrFail($itemId);
    //     $quantity = max(1, $request->quantity);

    //     $item->update([
    //         'quantity' => $quantity
    //     ]);

    //     return back();
    // }

    public function updateQuantity(Request $request)
    {
        $item = CartItem::with('cart')->findOrFail($request->item_id);

        if ($request->type == 'plus') {
            $item->quantity += 1;
        } else {
            $item->quantity = max(1, $item->quantity - 1);
        }

        $item->save();

        $cart = $item->cart->load('items');

        $cartTotal = $cart->items->sum(function ($i) {
            return $i->price * $i->quantity;
        });

        $cartCount = $cart->items->sum('quantity');

        return response()->json([
            'quantity' => $item->quantity,
            'itemTotal' => $item->price * $item->quantity,
            'cartTotal' => $cartTotal,
            'cartCount' => $cartCount
        ]);
    }

    public function destroy($itemId)
    {
        $item = CartItem::findOrFail($itemId);

        $cart = $item->cart;

        $item->delete();

        $cart->load('items');

        $cartTotal = $cart->items->sum(fn($i) => $i->price * $i->quantity);

        $cartCount = $cart->items->sum('quantity');

        return response()->json([
            'cartTotal' => $cartTotal,
            'cartCount' => $cartCount
        ]);
    }
}