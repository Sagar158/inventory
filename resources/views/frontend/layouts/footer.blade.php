<footer class="bg-dark text-light" style="background-image: url(frontend/assets/img/shape/brush-down.png);">
    <div class="container">
        <div class="f-items default-padding">
            <div class="row">

                <!-- Single Itme -->
                <div class="col-lg-3 col-md-12 item">
                    <div class="footer-item link">
                        <h4 class="widget-title">Explore</h4>
                        <ul>
                            <li>
                                <a href="{{ route('home') }}">Home</a>
                            </li>
                            <li>
                                <a href="{{ route('product') }}">Products</a>
                            </li>
                            <li>
                                <a href="{{ route('contactus') }}">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Single Itme -->
                <div class="col-lg-3 col-md-12 item">
                    <div class="footer-item contact">
                        <h4 class="widget-title">Contact Info</h4>
                        <ul>
                            <li>
                                <div class="icon">
                                    <i class="fas fa-home"></i>
                                </div>
                                <div class="content">
                                    {{-- <strong>Address:</strong> {{ \App\Helpers\Helper::information()->location }} --}}
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="content">
                                    <strong>Email:</strong>
                                    {{-- <a href="mailto:{{ \App\Helpers\Helper::information()->email }}">{{ \App\Helpers\Helper::information()->email }}</a> --}}
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="content">
                                    <strong>Phone:</strong>
                                    {{-- <a href="tel:{{ \App\Helpers\Helper::information()->phone }}">{{ \App\Helpers\Helper::information()->phone }}</a> --}}
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
                    <p>&copy; Copyright 2024. All Rights Reserved by <a href="#">United Foods</a></p>
                </div>
                <div class="col-lg-6 text-end">
                </div>
            </div>
        </div>
        <!-- End Footer Bottom -->
    </div>
</footer>
