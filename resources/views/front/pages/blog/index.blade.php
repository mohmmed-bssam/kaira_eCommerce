@extends('front.layouts.app')
@section('title', 'Blog')
@section('content')
    <section class="blog-section">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between align-items-center mt-5 mb-3">
                <h4 class="text-uppercase">Read Blog Posts</h4>
            </div>
            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-md-4">
                        <article class="post-item">
                            <div class="post-image">
                                <a href="{{ route('front.blog.show', $post->slug) }}">
                                    <img src="{{ asset($post->image->path) }}" alt="image"
                                        class="post-grid-image img-fluid">
                                </a>
                            </div>
                            <div class="post-content">
                                <h5 class="post-title"><a href="{{ route('front.blog.show', $post->slug) }}">{{ $post->title }}</a></h5>
                                <p>{{ $post->excerpt }}</p>
                            </div>
                            <div class="post-meta">
                                <span class="post-date">{{ $post->created_at->format('F j, Y') }}</span>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

