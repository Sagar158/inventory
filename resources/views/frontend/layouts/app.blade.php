<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Inventory">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- ========== Page Title ========== -->
    <title>{{ trans('general.inventory') }}</title>

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
    <style>
        .attr-nav>ul>li>a i {
            font-size: 38px !important;
        }
        .elementor img {
            height: auto;
            max-width: 100%;
            border: none;
            border-radius: 0;
            box-shadow: none;
        }

        nav.navbar.navbar-default.validnavs li.dropdown .dropdown-menu.cart-list .mini-cart-item-list .woocommerce-mini-cart-item .thumb .photo {
            height: 60px;
            width: 60px;
            background: var(--bg-gray);
            padding: 3px !important;
            display: flex;
            align-items: center;
        }
        nav.navbar.navbar-default.validnavs li.dropdown .dropdown-menu.cart-list .mini-cart-item-list .woocommerce-mini-cart-item a {
            padding: 0 !important;
            margin: 0;
            border: none;
            font-size: 16px;
        }
        nav.navbar.navbar-default.validnavs li.dropdown .dropdown-menu.cart-list .mini-cart-item-list .woocommerce-mini-cart-item .thumb a.remove
        {
            position: absolute;
            right: -6px;
            top: -5px;
            left: auto;
            height: 17px;
            width: 17px;
            background: #fd6363 !important;
            color: var(--white);
            line-height: 17px;
            text-align: center;
            font-size: 12px;
            border-radius: 50%;
        }

    </style>
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
    <script>
        function countCart()
        {
            var cart = JSON.parse(localStorage.getItem('cart')) || {};
            var numberOfItems = Object.keys(cart).length;
            $('#lblCartCount').html(numberOfItems);

            if(numberOfItems > 0)
            {
                var items = localStorage.getItem('cart');
                var cartObject = JSON.parse(items);
                var html = '';
                var totalAmount = 0;
                var productIds = [];
                Object.entries(cartObject).forEach(([key, value]) => {
                    productIds.push(key);
                    html += '<div class="woocommerce-mini-cart-item mini_cart_item">';
                    html += '<div class="info">';
                    html += '<span class="text-left">'+value.productName+'</span> <span class="text-right">'+value.quantity+'x - <span class="price"><span class="woocommerce-Price-amount amount"><bdi style="font-size:14px;">MAD '+value.productPrice+'</bdi></span></span></span>';
                    html += '</div>';
                    html += '</div>';
                    html += '<hr>';
                    productPrice = parseInt(value.productPrice) * parseInt(value.quantity);
                    totalAmount += parseInt(productPrice);
                });

                html += '<hr>';
                html += '<div class="total">';
                html += '<span class="mb-2">Sub Total:  <strong><span class="woocommerce-Price-amount amount">MAD '+totalAmount+'</span></strong></span>';
                html += '<hr>';
                html += '<a href="{{ route("viewCart") }}" class="btn secondary btn-theme btn-sm animation text-white text-center">View Cart</a>';
                html += '<a href="{{ route("checkout") }}" class="btn secondary btn-theme btn-sm animation text-white text-center mt-2">Checkout</a>';
                html += '</div>';

                $('.cart').html(html);
            }
            else{

                $('.cart').html('No Product in Cart');
            }

        }

        $(document).ready(function(){
            countCart();
        })
    </script>
</body>
</html>
