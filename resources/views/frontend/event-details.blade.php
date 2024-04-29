@extends('frontend.layouts.app')
@section('content')
<div class="blog-area single full-blog full-blog default-padding">
    <div class="container">
        <div class="blog-items">
            <div class="row">
                <div class="blog-content col-lg-10 offset-lg-1 col-md-12">

                    <div class="blog-style-two item">
                        <h2><strong>{{ $event->name }}</strong></h2>
                        <div class="thumb">
                            <a href="{{ route('eventDetails', $event->id) }}"><img style="width: 100%;" src="{{ isset($event->primaryImage->image) ? asset($event->primaryImage->image) : asset('assets/images/placeholder.jpg') }}" alt="Thumb"><</a>
                            <div class="date"><strong>{{ date('j', strtotime($event->created_at)) }}</strong> <span>{{ date('F, Y', strtotime($event->created_at)) }}</span></div>
                        </div>
                        <div class="info">
                            {!! $event->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
