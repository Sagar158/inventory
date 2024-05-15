<footer class="bg-dark text-light" style="background-image: url(frontend/assets/img/shape/brush-down.png);">
    <div class="container">
        <div class="f-items default-padding">
            <div class="row">

                <!-- Single Itme -->
                <div class="col-lg-3 col-md-12 item">
                    <div class="footer-item link">
                        <h4 class="widget-title">{{ trans('general.explore') }}</h4>
                        <ul>
                            <li>
                                <a href="{{ route('home') }}">{{ trans('general.home') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('product') }}">{{ trans('general.all_products') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('contactus') }}">{{ trans('general.contact-us') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Single Itme -->
                <div class="col-lg-3 col-md-12 item">
                    <div class="footer-item contact">
                        <h4 class="widget-title">{{ trans('general.contact-info') }}</h4>
                        <ul>
                            <li>
                                <div class="icon">
                                    <i class="fas fa-home"></i>
                                </div>
                                <div class="content">
                                    <strong>Address:</strong> {{ isset(\App\Helpers\Helper::information()->location) ? \App\Helpers\Helper::information()->location : '' }}
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="content">
                                    <strong>{{ trans('general.email') }}:</strong>
                                    @if(isset(\App\Helpers\Helper::information()->email))
                                        <a href="mailto:{{ \App\Helpers\Helper::information()->email }}">{{ \App\Helpers\Helper::information()->email }}</a>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="content">
                                    <strong>{{ trans('general.phone') }}:</strong>
                                    @if(isset(\App\Helpers\Helper::information()->phone))
                                        <a href="tel:{{ \App\Helpers\Helper::information()->phone }}">{{ \App\Helpers\Helper::information()->phone }}</a>
                                    @endif
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Single Itme -->

            </div>
        </div>
        <!-- Start Footer Bottom -->
        <div class="footer-bottom">
            <div class="row">
                <div class="col-lg-6">
                    <p>&copy; {{ trans('general.all_right_reserved_by') }} <a href="#">{{ trans('general.ims') }}</a></p>
                </div>
                <div class="col-lg-6 text-end">
                </div>
            </div>
        </div>
        <!-- End Footer Bottom -->
    </div>
</footer>
