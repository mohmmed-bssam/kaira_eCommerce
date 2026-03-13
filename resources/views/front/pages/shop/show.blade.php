@extends('front.layouts.app')
@section('title', 'Show Product')

@section('content')

    <section class="product-details py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="product-image">
                        <img src="{{ asset($product->images->first()->path) }}" alt="{{ $product->title_trans }}" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-6">
                    <h2 class="product-title">{{ $product->title_trans }}</h2>
                    <p class="product-price">{{ $product->price }}</p>
                    <p class="product-description">{{ $product->content_trans }}</p>
                    <a href="#" class="btn btn-primary">Add to Cart</a>
                </div>
            </div>
        </div>
    </section>
@endsection
