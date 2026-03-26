@extends('front.layouts.app')
@section('title', 'Wishlist')
@section('content')
 <section id="best-sellers" class="best-sellers product-carousel py-5 position-relative overflow-hidden">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between align-items-center mt-5 mb-3">
                <h4 class="text-uppercase">Best Selling Items</h4>
            </div>
            <div class="swiper product-swiper open-up" data-aos="zoom-out">
                <div class="swiper-wrapper d-flex">
                    @foreach ($wishlists as $wishlist)
                        <div class="swiper-slide">
                            <div class="product-item image-zoom-effect link-effect">
                                <div class="image-holder position-relative">
                                    <a href="{{ route('front.product.show', $wishlist->product->slug) }}">
                                        <img src="{{ asset($wishlist->product->image->path) }}" alt="categories"
                                            class="product-image img-fluid">
                                    </a>
                                    @php
                                    $product = $wishlist->product;
                                        $inWishlist = in_array($product->id, $wishlistProductIds ?? []);
                                    @endphp
                                    @auth

                                            <a href="#" class="btn-icon btn-wishlist wishlist-toggle"
                                                data-product-id="{{ $product->id }}">
                                                <svg width="24" height="24" viewBox="0 0 24 24" class="wishlist-heart"
                                                    fill="{{ $inWishlist ? 'red' : 'none' }}"
                                                    stroke="{{ $inWishlist ? 'red' : 'black' }}">
                                                    <use xlink:href="#heart"></use>
                                                </svg>
                                            </a>

                                    @endauth



                                    <div class="product-content">
                                        <h5 class="element-title text-uppercase fs-5 mt-3">
                                            <a
                                                href="{{ route('front.product.show', $wishlist->product->slug) }}">{{ $wishlist->product->title_trans }}</a>
                                        </h5>
                                        <a href="#"
                                            onclick="event.preventDefault(); document.getElementById('add-to-cart-{{ $wishlist->product->id }}').submit();"
                                            class="text-decoration-none" data-after="Add to cart">
                                            <span>{{ $wishlist->product->price }}</span>
                                        </a>

                                        <form id="add-to-cart-{{ $wishlist->product->id }}"
                                            action="{{ route('front.cart.store', $wishlist->product->id) }}" method="POST"
                                            style="display:none;">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
                <div class="swiper-pagination"></div>
            </div>
            <div class="icon-arrow icon-arrow-left"><svg width="50" height="50" viewBox="0 0 24 24">
                    <use xlink:href="#arrow-left"></use>
                </svg></div>
            <div class="icon-arrow icon-arrow-right"><svg width="50" height="50" viewBox="0 0 24 24">
                    <use xlink:href="#arrow-right"></use>
                </svg></div>
        </div>
    </section>
    {{-- <div class="container py-5">

        <h2 class="mb-4">Wishlist</h2>

        <table class="table">

            <thead>
                <tr>

                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Customer Name</th>

                    <th></th>
                </tr>
            </thead>

            <tbody>

                @forelse ($wishlists as $wishlist)
                    <tr>
                        <td class="d-flex align-items-center gap-3">
                            <img src="{{ $wishlist->product->image->path }}" width="60">

                        </td>
                        <td>
                            {{ $wishlist->product->title_trans }}
                        </td>
                        <td>
                            {{ $wishlist->user->name }}
                        </td>

                        <td>
                            <form action="{{ route('front.wishlist.destroy', $wishlist->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm remove-btn" type="submit">
                                    Remove
                                </button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <div class="alert alert-info">
                        Your wishlist is empty
                    </div>
                @endforelse
            </tbody>
        </table>


    </div> --}}

@endsection
