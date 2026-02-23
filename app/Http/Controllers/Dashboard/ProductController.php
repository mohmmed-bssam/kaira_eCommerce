<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['image', 'category'])->paginate(env('PAGE_SIZE'));
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = new Product();
        $categories = Category::select('id', 'title')->get();

        return view('dashboard.products.create', compact('product', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'content_en' => 'required|string',
            'content_ar' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sales_count' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $product = Product::create([
            'title' => [
                'en' => $request->title_en,
                'ar' => $request->title_ar
            ],
            'slug' => $request->slug,
            'content' => [
                'en' => $request->content_en,
                'ar' => $request->content_ar
            ],
            'price' => $request->price,
            'stock' => $request->stock,
            'sales_count' => $request->sales_count,
            'category_id' => $request->category_id,
        ]);
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads/products', 'custom');
            $product->image()->create([
                'path' => $path
            ]);
        }
        flash()->success('product created successfully');
        return redirect()->route('dashboard.products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
            $categories = Category::select('id', 'title')->get();
        return view('dashboard.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'slug' => "required|string|max:255|unique:products,slug,$product->id",
            'content_en' => 'required|string',
            'content_ar' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sales_count' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);
        $product->update([
            'title' => [
                'en' => $request->title_en,
                'ar' => $request->title_ar
            ],
            'slug' => $request->slug,
            'content' => [
                'en' => $request->content_en,
                'ar' => $request->content_ar
            ],
            'price' => $request->price,
            'stock' => $request->stock,
            'sales_count' => $request->sales_count,
            'category_id' => $request->category_id,
        ]);
        if ($request->hasFile('image')) {
            File::delete(public_path($product->image->path) );
            $path = $request->file('image')->store('uploads/products', 'custom');
                $product->image()->update([
                    'path' => $path
                ]);
        }
        flash()->info('product updated successfully');
        return redirect()->route('dashboard.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
            File::delete(public_path($product->image->path));
            $product->image()->delete();
        $product->delete();
        flash()->warning('product deleted successfully');
        return redirect()->route('dashboard.products.index');
    }
}
