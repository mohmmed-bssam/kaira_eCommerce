<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::latest()->paginate(10);
        return view('dashboard.blog-categories.index', compact('categories'));
    }

    public function create()
    {
        $blog_category = new BlogCategory();
        return view('dashboard.blog-categories.create', compact('blog_category'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:blog_categories,slug'],
        ]);


        BlogCategory::create($data);

        return redirect()->route('dashboard.blog-categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit(BlogCategory $blog_category)
    {
        return view('dashboard.blog-categories.edit', compact('blog_category'));
    }

    public function update(Request $request, BlogCategory $blog_category)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:blog_categories,slug,' . $blog_category->id],
        ]);


        $blog_category->update($data);

        return redirect()->route('dashboard.blog-categories.index')
            ->with('info', 'Category updated successfully.');
    }

    public function destroy(BlogCategory $blog_category)
    {
        $blog_category->delete();

        return redirect()->route('dashboard.blog-categories.index')
            ->with('warning', 'Category deleted successfully.');
    }
}
