@extends('frontend.layouts.app')
@section('content')
@push('css')
<style>
    .description {
        max-height: 100px; /* Adjust as needed */
        overflow: hidden;
        transition: max-height 0.3s ease;
    }

    .expanded {
        max-height: 1000px; /* Adjust as needed */
    }
</style>
@endpush
@include('frontend.components.banner',['pageName' => 'Meet The Team'])
    <div class="contact-area default-padding" style="background-image: url({{ asset('frontend/assets/img/shape/28.png') }});">
        <div class="container">
            <div class="row align-center">
                <h1 class="font-weight-bold"><b>Team</b></h1>
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
                                                    <span>{{ $team->name }}</span>
                                                    <h4><a href="Javascipt:void(0)">{{ $team->designation }}</a></h4>
                                                    <p class="description">{{ strip_tags($team->description) }} </p>
                                                    <span class="toggle-button cursor-pointer text-success">Show More...</span>
                                                    <div class="d-flex justify-content-center mt-2">
                                                        <a class="btn btn-theme secondary btn-md radius animation" href="tel:{{ $team->mobile }}">Contact</a>
                                                    </div>
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
        </div>
    </div>

    @push('scripts')
            <script>
                $(document).ready(function() {
                    $('.toggle-button').click(function() {
                        var $this = $(this);
                        var $description = $this.prev('.description');
                        $description.toggleClass('expanded');
                        $this.text($description.hasClass('expanded') ? 'Show Less' : 'Show More...');
                    });
                });
            </script>
    @endpush

@endsection


