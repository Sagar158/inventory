@extends('frontend.layouts.app')
@section('content')
<div class="contact-area default-padding" style="background-image: url({{ asset('frontend/assets/img/shape/28.png') }});">
    <div class="blog-area full-blog blog-standard default-padding">
        <div class="container">
            <div class="row align-center">
                <h1 class="font-weight-bold"><b>Events</b></h1>
                @if(!empty($events))
                    @foreach ($events as $event)
                        <div class="blog-content col-xl-10 offset-xl-1 col-md-12">
                            <div class="blog-item-box">
                                <!-- Single Item -->
                                <div class="item">
                                    <div class="thumb">
                                        <a href="{{ route('eventDetails', $event->id) }}"><img style="width: 100%;" src="{{ isset($event->primaryImage->image) ? asset($event->primaryImage->image) : asset('assets/images/placeholder.jpg') }}" alt="Thumb"></a>
                                        <div class="date"><strong>{{ date('j', strtotime($event->created_at)) }}</strong> <span>{{ date('F, Y', strtotime($event->created_at)) }}</span></div>
                                    </div>
                                    <div class="info">
                                        <h2 class="title">
                                            <a href="{{ route('eventDetails', $event->id) }}">{{ $event->name }}</a>
                                        </h2>
                                        <p>
                                            {{ strstr(strip_tags($event->description), '.', true) }}
                                        </p>
                                        <a class="btn mt-10 btn-md btn-theme animation" href="{{ route('eventDetails', $event->id) }}">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            {{ $events->links() }}
        </div>
    </div>

</div>
@endsection
