<div class="banner-area navigation-circle text-light banner-style-one zoom-effect overflow-hidden">
    <!-- Slider main container -->
    <div class="banner-fade">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">

            <!-- Single Item -->
            @if(!empty($slides))
                @foreach ($slides as $slide)
                    <div class="swiper-slide banner-style-one">
                        <div class="banner-thumb bg-cover shadow dark" style="background: url({{ $slide->image }});"></div>
                        <div class="container">
                            <div class="row align-center">
                                <div class="col-xl-7">
                                    <div class="content">
                                        <h4>{{ $slide->title }}</h4>
                                        <h2><strong>{{ $slide->subtitle }}</strong></h2>
                                        <p>
                                            {{ strip_tags($slide->description) }}
                                        </p>

                                        <div class="button">
                                            <a class="btn btn-theme secondary btn-md radius animation" href="{{ route('certificates') }}">View Certificates</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            <!-- End Single Item -->

        </div>

        <!-- Navigation -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

    </div>
</div>
