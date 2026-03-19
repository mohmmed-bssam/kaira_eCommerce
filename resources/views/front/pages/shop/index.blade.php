@extends('front.layouts.app')

@section('title', 'Shop')

@section('content')

    <section id="new-arrival" class="new-arrival product-carousel py-5 position-relative overflow-hidden">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between align-items-center mt-5 mb-3">
                <h4 class="text-uppercase">Our New Arrivals</h4>
            </div>
            <div class="swiper product-swiper open-up" data-aos="zoom-out">
                <div class="swiper-wrapper d-flex">
                    @foreach ($products as $product)
                        <div class="swiper-slide">
                            <div class="product-item image-zoom-effect link-effect">
                                <div class="image-holder position-relative">
                                    <a href="{{ route('front.product.show', $product->slug) }}">
                                        <img src="{{ asset($product->image->path) }}" alt="categories"
                                            class="product-image img-fluid">
                                    </a>

                                    <a href="#"
                                        onclick="event.preventDefault(); document.getElementById('add-to-wishlist-{{ $product->id }}').submit();"
                                        class="btn-icon btn-wishlist" >
                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                            <use xlink:href="#heart"></use>
                                        </svg>
                                     </a>

                                    <form id="add-to-wishlist-{{ $product->id }}"
                                        action="{{ route('front.wishlist.store', $product->id) }}" method="POST"
                                        style="display:none;">
                                        @csrf
                                    </form>
                                    <div class="product-content">
                                        <h5 class="element-title text-uppercase fs-5 mt-3">
                                            <a
                                                href="{{ route('front.product.show', $product->slug) }}">{{ $product->title_trans }}</a>
                                        </h5>
                                        <a href="#"
                                            onclick="event.preventDefault(); document.getElementById('add-to-cart-{{ $product->id }}').submit();"
                                            class="text-decoration-none" data-after="Add to cart">
                                            <span>{{ $product->price }}</span>
                                        </a>

                                        <form id="add-to-cart-{{ $product->id }}"
                                            action="{{ route('front.cart.store', $product->id) }}" method="POST"
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

@endsection
