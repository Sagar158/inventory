<x-app-layout title="{{ $title }}">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <x-page-heading title="{{ __('Slider Show') }}"></x-page-heading>
        <x-back-button></x-back-button>
        <div class="container-fluid card mt-3">
            <div class="row card-body">
                <div class="col-lg-12 col-sm-12 col-md-12">
                    <div class="table-responsive pt-3">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Title</td>
                                    <td>{{ $slider->title }}</td>
                                </tr>
                                <tr>
                                    <td>Sub Title</td>
                                    <td>{{ $slider->subtitle }}</td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td>{!! $slider->description !!}</td>
                                </tr>
                                <tr>
                                    <td>Image</td>
                                    <td><img src="{{ asset($slider->image) }}" class="image-thumbnail" alt=""></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
