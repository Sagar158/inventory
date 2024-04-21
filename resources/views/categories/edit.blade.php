@php
    $route = (!isset($category->id) ? route('categories.store') : route('categories.update',$category->id));
@endphp
<x-app-layout title="{{ $title }}">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <x-page-heading title="{{ trans('general.create_update') }} {{ trans('general.categories') }}"></x-page-heading>
        <x-back-button></x-back-button>

        <div class="container-fluid card mt-3">
            <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
                {{ @csrf_field() }}
                <div class="row card-body">
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <x-text-input id="name" type="text" name="name" :value="old('name', $category->name)" required autofocus autocomplete="off" placeholder="{{ trans('general.name') }}" />
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <x-select-box id="status" name="status" :value="old('status', $category->status)" :values="\App\Helpers\Helper::$status" autocomplete="off" placeholder="{{ trans('general.status') }}" />
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 mt-2">
                        <x-primary-button class="btn btn-primary">
                            {{ trans('general.save') }}
                        </x-primary-button>
                        <x-back-button></x-back-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
