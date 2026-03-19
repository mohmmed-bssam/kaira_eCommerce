<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
   public function index(){
        $user_id = Auth::id();
        $wishlists = Wishlist::with('product')
        ->where('user_id', $user_id)
        ->latest()
        ->take(6)
        ->get();

        return view('front.pages.wishlist.index',compact('wishlists'));
    }
    public function store($productId){
        $Wishlist= Wishlist::where('product_id',$productId)
        ->where('user_id', Auth::id())->first();

        if(!$Wishlist){
            Wishlist::create([
                'product_id'=>$productId,
                'user_id'=>Auth::id(),
            ]);
            flash()->success('the product is added Wishlist');
            return redirect()->route('front.wishlist.index');

        }
    }
    public function destroy($id){
        Wishlist::where('id', $id)
            ->delete();
        flash()->warning('the product is not Wishlist');
        return redirect()->back();
    }
}
