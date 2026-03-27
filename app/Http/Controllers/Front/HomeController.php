<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pest\Matchers\Any;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::with('image')->latest()->take(6)->get();
        $categories = Category::with('image')->latest()->take(3)->get();
        $products = Product::with('image')->latest()->take(6)->get();
        $wishlists = Wishlist::with('product.image')->latest()->take(6)->get();
        $bestSellingProducts = Product::with('image')
            ->orderByDesc('sales_count')
            ->take(6)
            ->get();
        $recommendedProducts = Product::with('image')->inRandomOrder()
            ->take(6)
            ->get();
            $blog_posts = BlogPost::with('image','category')->where('status', 'published')->latest()->take(3)->get();


        return view('front.home', compact('sliders', 'categories', 'products', 'wishlists', 'bestSellingProducts', 'recommendedProducts', 'blog_posts'));
    }
}