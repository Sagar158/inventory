<x-app-layout title="{{ $title }}">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Contact Us Information') }}
        </h2>
    </x-slot>
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <x-page-heading title="{{ __('Contact Us Information') }}"></x-page-heading>
        <x-alert></x-alert>
        <div class="container-fluid card mt-3">
            <form action="{{ route('contact-us.information.update', 1) }}" method="POST" enctype="multipart/form-data">
                {{ @csrf_field() }}
                <div class="row card-body">
                    <div class="col-lg-4 col-sm-4 col-md-4">
                        <x-text-input id="phone" type="text" name="phone" :value="old('phone', $information->phone)" required autofocus placeholder="Mobile" />
                    </div>
                    <div class="col-lg-4 col-sm-4 col-md-4">
                        <x-text-input id="location" type="text" name="location" :value="old('location', $information->location)" required autofocus placeholder="Location" />
                    </div>
                    <div class="col-lg-4 col-sm-4 col-md-4">
                        <x-text-input id="short_location" type="text" name="short_location" :value="old('short_location', $information->short_location)" required autofocus placeholder="Short Location" />
                    </div>
                    <div class="col-lg-4 col-sm-4 col-md-4">
                        <x-text-input id="email" type="email" name="email" :value="old('email', $information->email)" required autofocus placeholder="Email" />
                    </div>
                    <div class="col-lg-4 col-sm-4 col-md-4">
                        <x-text-input id="facebook" type="text" name="facebook" :value="old('facebook', $information->facebook)" autofocus placeholder="Facebook" />
                    </div>
                    <div class="col-lg-4 col-sm-4 col-md-4">
                        <x-text-input id="twitter" type="text" name="twitter" :value="old('twitter', $information->twitter)" autofocus placeholder="Twitter" />
                    </div>
                    <div class="col-lg-4 col-sm-4 col-md-4">
                        <x-text-input id="youtube" type="text" name="youtube" :value="old('youtube', $information->youtube)" autofocus placeholder="Youtube" />
                    </div>
                    <div class="col-lg-4 col-sm-4 col-md-4">
                        <x-text-input id="linkedin" type="text" name="linkedin" :value="old('linkedin', $information->linkedin)" autofocus placeholder="LinkedIn" />
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 mt-2">
                        <x-primary-button class="btn btn-primary">
                            {{ __('Submit') }}
                        </x-primary-button>
                        <x-back-button></x-back-button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
