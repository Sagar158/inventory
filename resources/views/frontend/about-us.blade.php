@extends('frontend.layouts.app')
@section('content')
    @include('frontend.components.banner',['pageName' => 'About Us'])


        <div class="about-style-one-area default-padding">
            <!-- Shape -->
            <div class="shape-right-top">
                <img src="{{ asset('frontend/assets/img/shape/leaf.png') }}" alt="Image not found">
            </div>
            <!-- End Shape -->

            <div class="container">
                <div class="row align-center">
                    <div class="col-xl-12 col-lg-12 about-style-one">
                        <div class="row align-center">
                            <div class="col-xl-7 col-lg-12">
                                <h2 class="heading">Our Mission</h2>
                                <p>
                                    {!! $aboutUs->our_mission !!}
                                </p>
                                <h2 class="heading">Our Vision</h2>
                                <p>
                                    {!! $aboutUs->our_vission !!}
                                </p>
                            </div>
                            <div class="col-xl-5 col-lg-12 pl-50 pl-md-15 pl-xs-15">
                                <div class="top-product-item">
                                    <img src="{{ asset('frontend/assets/img/icon/palm-tree.png') }}" alt="Icon">
                                    <h5><a href="services-details.html">Dates Production</a></h5>
                                    <p>
                                        Cultivating date palms in arid regions, producing nutritious fruits through manual pollination and careful harvesting.
                                    </p>
                                </div>
                                <div class="top-product-item">
                                    <img src="{{ asset('frontend/assets/img/icon/mango.png') }}" alt="Icon">
                                    <h5><a href="services-details.html">Mangoes Production</a></h5>
                                    <p>
                                        Growing mango trees in tropical climates, yielding sweet, juicy fruits after meticulous cultivation and pruning.                                    </p>
                                </div>
                                <div class="top-product-item">
                                    <img src="{{ asset('frontend/assets/img/icon/rice.png') }}" alt="Icon">
                                    <h5><a href="services-details.html">Rice Production</a></h5>
                                    <p>
                                        Farming rice in water-rich paddies, involving sowing, flooding, and harvesting for staple grain production.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- Start Farmer============================================= -->
        <div class="farmer-area default-padding bottom-less bg-gray" style="background-image: url({{ asset('frontend/assets/img/shape/36.png') }});">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="site-heading text-center">
                            <h5 class="sub-title">Our Management Team</h5>
                            <div class="devider"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="row">

                            <!-- Single Item -->
                            @if(!empty($teams))
                                @foreach ($teams as $team)
                                    <div class="col-lg-4 farmer-stye-one">
                                        <div class="farmer-style-one-item">
                                            <div class="thumb">
                                                <img src="{{ asset($team->image) }}" class="thumbnail-319" alt="Image Not Found">
                                            </div>
                                            <div class="info">
                                                <span>{{ $team->designation }}</span>
                                                <h4><a href="#">{{ $team->name }}</a></h4>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            @endif
                            <!-- End Single Item -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- End Farmer -->

@endsection
