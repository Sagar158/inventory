    <!-- Start Header Top
    ============================================= -->
    <div class="top-bar-area text-light">
        <div class="container">
            <div class="row align-center">
                <div class="col-lg-9">
                    <div class="flex-item left">
                        <p>
                            We only sell 100% quality things.
                        </p>
                        <ul>
                            <li>
                                <i class="fas fa-map-marker-alt"></i> {{ \App\Helpers\Helper::information()->short_location }}
                            </li>
                            <li>
                                <i class="fas fa-phone-alt"></i> {{ \App\Helpers\Helper::information()->phone }}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 text-end">
                    <div class="social">
                        <ul>
                            @if(!empty(\App\Helpers\Helper::information()->facebook))
                                <li>
                                    <a href="{{ \App\Helpers\Helper::information()->facebook }}" target="_blank">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                            @endif
                            @if(!empty(\App\Helpers\Helper::information()->twitter))
                                <li>
                                    <a href="{{ \App\Helpers\Helper::information()->twitter }}" target="_blank">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                            @endif
                            @if(!empty(\App\Helpers\Helper::information()->youtube))
                                <li>
                                    <a href="{{ \App\Helpers\Helper::information()->youtube }}" target="_blank">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                </li>
                            @endif
                            @if(!empty(\App\Helpers\Helper::information()->linkedin))
                                <li>
                                    <a href="{{ \App\Helpers\Helper::information()->linkedin }}" target="_blank">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Top -->

    <!-- Header
    ============================================= -->
    <header>
        <!-- Start Navigation -->
        <nav class="navbar mobile-sidenav inc-shape navbar-common navbar-sticky navbar-default validnavs">

            <!-- Start Top Search -->
            <div class="top-search">
                <div class="container-xl">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Search">
                        <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                    </div>
                </div>
            </div>
            <!-- End Top Search -->

            <div class="container d-flex justify-content-between align-items-center">


                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset('/assets/images/logo.jpg') }}" class="logo" alt="Logo">
                    </a>
                </div>
                <!-- End Header Navigation -->

                <!-- Main Nav -->
                <div class="main-nav-content">
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="navbar-menu">

                        <img src="{{ asset('assets/images/logo.jpg') }}" class="mobile-size-logo" alt="Logo">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                            <i class="fa fa-times"></i>
                        </button>

                        <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('product') }}">Products</a></li>
                            <li><a href="{{ route('contactus') }}">Contact us</a></li>
                            @if(Auth::check())
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Explore Admin</a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('dashboard') }}">Go To Dashboard</a></li>
                                    <li>
                                        <a href="javascript:void(0);" class="logout-click">Logout</a>
                                        <form action="{{ route('logout') }}" method="POST" id="logout-form">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            @else
                                <li><a href="{{ route('login') }}">Login</a></li>
                            @endif
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->

                    <div class="attr-right">
                        <!-- Start Atribute Navigation -->
                        <div class="attr-nav">
                            <ul>
                                <li class="contact">
                                    <div class="call">
                                        <div class="icon">
                                            <i class="fas fa-comments-alt-dollar"></i>
                                        </div>
                                        <div class="info">
                                            <p>Have any Questions?</p>
                                            <h5><a href="mailto:{{ \App\Helpers\Helper::information()->email }}">{{ \App\Helpers\Helper::information()->email }}</a></h5>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- End Atribute Navigation -->

                    </div>

                    <!-- Overlay screen for menu -->
                    <div class="overlay-screen"></div>
                    <!-- End Overlay screen for menu -->

                </div>
                <!-- Main Nav -->
            </div>
        </nav>
        <!-- End Navigation -->
    </header>

    @push('scripts')
        <script>
            $(document).ready(function(){
                $('.logout-click').on('click',function(){
                    $('#logout-form').submit();
                });
            });
        </script>
    @endpush
