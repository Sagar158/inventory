@php
    $route = (!isset($supplier->id) ? route('suppliers.store') : route('suppliers.update',$supplier->id));
@endphp
<x-app-layout title="{{ $title }}">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <x-page-heading title="{{ trans('general.create_update') }} {{ trans('general.supplier') }}"></x-page-heading>
        <x-back-button></x-back-button>

        <div class="container-fluid card mt-3">
            <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
                {{ @csrf_field() }}
                <div class="row card-body">
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="name" type="text" name="name" :value="old('name', $supplier->name)" autofocus autocomplete="off" placeholder="{{ trans('general.supplier_name') }}" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="email" type="email" name="email" :value="old('email', $supplier->email)" autofocus autocomplete="off" placeholder="{{ trans('general.email') }}" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="phone" type="text" name="phone" :value="old('phone', $supplier->phone)" autofocus autocomplete="off" placeholder="{{ trans('general.phone') }}" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="address" type="text" name="address" :value="old('address', $supplier->address)" autofocus autocomplete="off" placeholder="{{ trans('general.address') }}" />
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
