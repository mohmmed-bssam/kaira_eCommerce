<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function toggle($productId)
    {
        $wishlist = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($wishlist) {
            $wishlist->delete();

            return response()->json([
                'status' => 'removed',
                'message' => 'Removed from wishlist',
                'product_id' => $productId,
            ]);
        }

        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $productId,
        ]);

        return response()->json([
            'status' => 'added',
            'message' => 'Added to wishlist',
            'product_id' => $productId,
        ]);
    }
    public function index()
    {
        $wishlists = Wishlist::with('product.image')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('front.pages.wishlist.index', compact('wishlists'));
    }

    public function destroy($id){
        Wishlist::where('id', $id)
            ->delete();
        flash()->warning('the product is not Wishlist');
        return redirect()->back();
    }
}