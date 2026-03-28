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
        $cart = Cart::with(['items.product.image'])
            ->where('user_id', Auth::id())
            ->first();

        return view('front.pages.cart.index', compact('cart'));
    }

    public function store(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        if ($product->stock <= 0) {
            flash()->error('Product is out of stock');
            return back();
        }

        $userId = Auth::id();

        $cart = Cart::with('items.product')->firstOrCreate([
            'user_id' => $userId
        ]);

        $cartItem = CartItem::with('cart', 'product')->where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {

            // ❗ تحقق قبل الزيادة
            if ($cartItem->quantity + 1 > $product->stock) {
                flash()->error('No more stock available for this product');
                return back();
            }

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
        return back();
    }



    public function updateQuantity(Request $request)
    {
        $item = CartItem::with('cart', 'product')->findOrFail($request->item_id);

        $product = $item->product;

        if ($request->type == 'plus') {

            // ❗ تحقق من المخزون
            if ($item->quantity + 1 > $product->stock) {
                return response()->json([
                    'error' => 'Stock limit reached'
                ], 400);
            }

            $item->quantity += 1;
        } else {
            $item->quantity = max(1, $item->quantity - 1);
        }

        $item->save();

        $cart = $item->cart->load('items');

        $cartTotal = $cart->items->sum(fn($i) => $i->price * $i->quantity);
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
