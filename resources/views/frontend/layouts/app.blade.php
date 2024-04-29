<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Agrul - Organic Farm Agriculture Template">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- ========== Page Title ========== -->
    <title>Agrul - Organic Farm Agriculture Template</title>

    <!-- ========== Favicon Icon ========== -->
    <link rel="shortcut icon" href="{{ asset('frontend/assets/img/favicon.png') }}" type="image/x-icon">

    <!-- ========== Start Stylesheet ========== -->
    <link href="{{ asset('frontend/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/themify-icons.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/elegant-icons.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/flaticon-set.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/magnific-popup.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/swiper-bundle.min.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/validnavs.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/helper.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/shop.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/unit-test.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/style.css')}}" rel="stylesheet">
    <!-- ========== End Stylesheet ========== -->
    @stack('css')

</head>
<body>
    <div class="se-pre-con"></div>
    @include('frontend.layouts.header')
        @yield('content')
    @include('frontend.layouts.footer')
    <script src="{{ asset('frontend/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.appear.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/modernizr.custom.13711.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/progress-bar.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/circle-progress.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/count-to.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.scrolla.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/YTPlayer.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/TweenMax.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/loopcounter.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/validnavs.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
    @stack('scripts')
</body>
</html>
