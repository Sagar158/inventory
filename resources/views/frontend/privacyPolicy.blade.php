@extends('frontend.layouts.app')
@section('content')
    <!-- Start Contact Us  ============================================= -->
        <div class="contact-area default-padding" style="background-image: url({{ asset('frontend/assets/img/shape/28.png') }});">
            <div class="container">
                <div class="row align-center">
                    <h1 class="font-weight-bold"><b>Privacy Policy</b></h1>
                    {!! $privacyPolicy->privacy_policy !!}
                </div>
            </div>
        </div>
    <!-- End Contact -->
@endsection
