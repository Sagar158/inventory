@extends('frontend.layouts.app')
@section('content')
    @include('frontend.components.banner',['pageName' => 'Certificates'])
    <div class="contact-area default-padding" style="background-image: url({{ asset('frontend/assets/img/shape/28.png') }});">
        <div class="container">
            <div class="row align-center">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Certificate</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($certificates))
                            @foreach ($certificates as $certificate)
                                <tr>
                                    <td>{{ $certificate->title }}</td>
                                    <td><a href="{{ asset($certificate->pdf) }}">View {{ $certificate->title }} Certificate</a></td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
