@extends('front.layouts.app')
@section('title', 'Blog')
@section('content')
    <section class="blog-section">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between align-items-center mt-5 mb-3">
                <h4 class="text-uppercase">Read Blog Posts</h4>
                <a href="{{ route('front.blog.index') }}" class="btn-link">View All</a>
            </div>
            <div class="row">

                    <div class="col-md-4">
                        <article class="post-item">
                            <div class="post-image">
                                    <img src="{{ asset($post->image->path) }}" alt="image"
                                        class="post-grid-image img-fluid">
                            </div>
                            <div class="post-content">
                                <h5 class="post-title">{{ $post->title }}</h5>
                                <p>{{ $post->excerpt }}</p>
                            </div>
                            <div class="post-content">
                                <p>{{ $post->content }}</p>
                            </div>
                            <div class="post-meta">
                                <span class="post-date">{{ $post->created_at->format('F j, Y') }}</span>
                            </div>
                        </article>
                    </div>
            </div>
        </div>
    </section>
@endsection
