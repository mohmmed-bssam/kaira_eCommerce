@extends('front.layouts.app')
@section('title', 'Slider')
@section('content')
      {{-- sliders --}}
      <section id="billboard" class="bg-light py-5">
        <div class="container">
            <div class="row">
                <div class="swiper main-swiper py-4" data-aos="fade-up" data-aos-delay="600">
                    <div class="swiper-wrapper d-flex border-animation-left">
                        @foreach ($sliders as $slider)
                            <div class="swiper-slide">
                                <div class="banner-item image-zoom-effect">
                                    <div class="image-holder">

                                            <img src="{{ asset($slider->image->path) }}" alt="product" class="img-fluid">

                                    </div>
                                    <div class="banner-content py-4">
                                        <h5 class="element-title text-uppercase">
                                            <a href="#" class="item-anchor">{{ $slider->title_trans }}</a>
                                        </h5>
                                        <p>{{ $slider->content_trans }}</p>

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
        </div>
    </section>
@endsection
