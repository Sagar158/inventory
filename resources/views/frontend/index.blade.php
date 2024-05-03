@extends('frontend.layouts.app')
@section('content')
    <div class="services-style-one-area default-padding bg-gray half-bg-theme">
        <div class="shape-extra">
            <img src="assets/img/shape/18.png" alt="Image Not Found">
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
                                            <a href="{{ route('product') }}" class="btn btn-theme secondary btn-sm radius animation">View Details</a>
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
