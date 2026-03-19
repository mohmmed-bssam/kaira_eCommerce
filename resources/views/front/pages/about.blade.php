@extends('front.layouts.app')
@section('title', 'About')
@section('content')
    <div class="row justify-content-center">
        <h1 class="section-title text-center mt-4" data-aos="fade-up">{{ $settings['about_title'] }}</h1>
        <div class="col-md-6 text-center" data-aos="fade-up" data-aos-delay="300">
            <p>{{ $settings['about_content'] }}!</p>
        </div>
    </div>
@endsection
