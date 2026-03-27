<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with('category','image')->latest()->paginate(10);
        return view('dashboard.blog-posts.index', compact('posts'));
    }

    public function create()
    {
        $blog_post = new BlogPost();
        $categories = BlogCategory::all();
        return view('dashboard.blog-posts.create', compact('categories', 'blog_post'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:blog_posts,slug'],
            'excerpt' => ['nullable', 'string'],
            'content' => ['required', 'string'],
            'image' => ['required', 'image'],
            'category_id' => ['required', 'exists:blog_categories,id'],
            'status' => ['required', 'in:draft,published'],
        ]);
        unset($data['image']);

        $blog_post = BlogPost::create($data);

        if ($request->hasFile('image')) {

            $path = $request->file('image')->store('uploads/blog-posts', 'custom');
            $blog_post->image()->create([
                'path' => $path
            ]);
        }


        return redirect()->route('dashboard.blog-posts.index')
            ->with('success', 'Post created successfully.');
    }

    public function edit(BlogPost $blog_post)
    {
        $categories = BlogCategory::all();
        return view('dashboard.blog-posts.edit', compact('blog_post', 'categories'));
    }

    public function update(Request $request, BlogPost $blog_post)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:blog_posts,slug,' . $blog_post->id],
            'excerpt' => ['nullable', 'string'],
            'content' => ['required', 'string'],
            'image' => ['image'],
            'category_id' => ['nullable', 'exists:blog_categories,id'],
            'status' => ['required', 'in:draft,published'],
        ]);
        unset($data['image']);
        $blog_post->update($data);

        if ($request->hasFile('image')) {

            File::delete(public_path($blog_post->image->path));

            $path = $request->file('image')->store('uploads/blog-posts', 'custom');
            $blog_post->image()->update([
                'path' => $path
            ]);
        }


        return redirect()->route('dashboard.blog-posts.index')
            ->with('info', 'Post updated successfully.');
    }

    public function destroy(BlogPost $blog_post)
    {
        if ($blog_post->image) {
            File::delete(public_path($blog_post->image->path));
        }
        $blog_post->image()->delete();
        $blog_post->delete();

        return redirect()->route('dashboard.blog-posts.index')
            ->with('warning', 'Post deleted successfully.');
    }
}
