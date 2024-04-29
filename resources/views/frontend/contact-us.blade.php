@extends('frontend.layouts.app')
@section('content')
@push('css')
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet' />
@endpush
        <div class="contact-area default-padding" style="background-image: url({{ asset('frontend/assets/img/shape/28.png') }});">
            <div class="container">
                <div class="row align-center">
                    <h1 class="font-weight-bold"><b>Contact Us</b></h1>
                    @include('frontend.contact-us-form')
                </div>
                <div class="row align-center mt-4">
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <h1 class="font-weight-bold"><b>Our Factory</b></h1>
                        <p class="mb-4">Old National Highway near MDS mart therhi (Habibabad) Dist. Khairpur, Sindh, Pakistan.</p>
                        <div id='map' style='height: 500px;'></div>
                    </div>
                </div>
            </div>
        </div>
    @push('scripts')
        <script src='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js'></script>
        <script>
            mapboxgl.accessToken = 'pk.eyJ1Ijoic2FnYXI2NjciLCJhIjoiY2xyc3ZpaHF4MDAzbzJybG1tZTZ3Mm8yNSJ9.g1WSjd9khWmo_6444PlAEg';
            var map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/streets-v11',
                center: [68.7551, 27.5256],
                zoom: 12
            });

            var marker = new mapboxgl.Marker()
                .setLngLat([68.7551, 27.5256])
                .addTo(map);
        </script>
    @endpush
@endsection
