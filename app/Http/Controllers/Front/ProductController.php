<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category','image')->latest()->take(8)->get();
                                            // $Wishlist = Wishlist::where('product_id', $product->id)->first();

        return view('front.pages.shop.index', compact('products'));
    }

    public function show($slug)
    {
        // Fetch product by slug
        $product = Product::where('slug', $slug)->with('category','image')->firstOrFail();
        return view('front.pages.shop.show', compact('product'));
    }
}