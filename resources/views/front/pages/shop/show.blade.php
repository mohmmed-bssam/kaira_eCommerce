@extends('front.layouts.app')
@section('title', 'Show Product')

@section('content')

    <section class="product-details py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="product-image">
                        <img src="{{ asset($product->image->path) }}" alt="{{ $product->title_trans }}" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-6">
                    <h2 class="product-title">{{ $product->title_trans }}</h2>
                    <p class="product-price">{{ $product->price }}</p>
                    <p class="product-description">{{ $product->content_trans }}</p>
                    <form id="add-to-cart"
                                            action="{{ route('front.cart.store', $product->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-primary" type="submit">Add to Cart</button>
                                        </form>
                </div>
            </div>
        </div>
    </section>
@endsection
