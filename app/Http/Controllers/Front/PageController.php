<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\ContactUs;
use App\Models\BlogPost;
use App\Models\Massage;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function about()
    {
        return view('front.pages.about');
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscriptions,email',
        ]);

       Subscription::create([
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Thank you for subscribing to our newsletter!');
    }
    public function account()
    {
        $customer=User::findOrFail(Auth::id())->load('orders');
        return view('front.pages.account', compact('customer'));
    }
    public function contact()
    {
        return view('front.pages.contact');
    }
    public function contactStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);
        $data = $request->all();
        Massage::create($data);
        Mail::to('mohmmedbssam97@gmail.com')->send(new ContactUs($data));

        // Here you can handle the contact form submission, e.g., save to database or send an email

        return redirect()->back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }
    public function blog()
    {
        $posts = BlogPost::with('image','category')->where('status', 'published')->latest()->paginate(6);
        return view('front.pages.blog.index', compact('posts'));
    }
    public function blogShow($slug)
    {
        $post = BlogPost::with('image','category')->where('slug', $slug)->where('status', 'published')->firstOrFail();
        return view('front.pages.blog.blog-show', compact('post'));
    }
}