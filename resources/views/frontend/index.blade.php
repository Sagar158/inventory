@extends('frontend.layouts.app')
@section('content')
    <!-- Start Banner Area
    ============================================= -->
    @include('frontend.components.slider')
    <!-- End Main -->
    <!-- Start Services
    ============================================= -->
    <div class="services-style-one-area default-padding bg-gray half-bg-theme">
        <div class="shape-extra">
            <img src="assets/img/shape/18.png" alt="Image Not Found">
        </div>
        <div class="container">
            <div class="heading-left">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="left-info">
                            <h5 class="sub-title">What we do</h5>
                            <h2 class="title">Currently we are<br> selling Dates, Mangoes, and Rice</h2>
                        </div>
                    </div>
                    <div class="col-lg-6 offset-lg-1">
                        <div class="right-info">
                            <p>

                            </p>
                            <a class="btn btn-theme btn-md radius animation" href="{{ route('about-us') }}">Show More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="services-style-one-carousel swiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Single Item -->
                            @if(!empty($products))
                                @foreach($products as $product)
                                    <div class="swiper-slide">
                                        <div class="services-style-one text-center">
                                            <div class="thumb">
                                                <img src="{{ isset($product->primaryImage->image) ? asset($product->primaryImage->image) : asset('assets/images/placeholder.jpg') }}" style="width:150px; height:150px;border-radius:50%;" alt="Image Not Found">
                                            </div>
                                            <h5><a href="{{ route('product') }}">{{ $product->name }}</a></h5>
                                            <a href="{{ route('product') }}"" class="btn btn-theme secondary btn-sm radius animation">View Details</a>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Services -->

    <!-- Start Product
    ============================================= -->
    <div class="product-list-area default-padding-bottom bottom-less bg-dark text-center text-light">
        <div class="shape-bottom-right">
            <img src="{{ asset('frontend/assets/img/shape/21.png') }}" alt="Image Not Found">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-10 offset-xl-1 mb-50 mb-xs-30">
                    <h1 class="text-white font-weight-bold">
                        Founded in 1978, United Foods has grown to become a market leading exporter of the world’s finest palm dates.
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product Area -->

    <!-- Start Contact Us
    ============================================= -->
    <div class="contact-area bg-gray default-padding" style="background-image: url(frontend/assets/img/shape/28.png);">
        <div class="container">
            <div class="row align-center">
                @include('frontend.contact-us-form')
            </div>
        </div>
    </div>
    <!-- End Contact -->

@endsection
