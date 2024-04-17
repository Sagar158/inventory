@php
    $route = (!isset($user->id) ? route('users.store') : route('users.update',$user->id));
@endphp
<x-app-layout title="{{ $title }}">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <x-page-heading title="{{ __('Create / Update Users') }}"></x-page-heading>
        <x-back-button></x-back-button>

        <div class="container-fluid card mt-3">
            <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
                {{ @csrf_field() }}
                <div class="row card-body">
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="first_name" type="text" name="first_name" :value="old('first_name', $user->first_name)" autofocus autocomplete="off" placeholder="First Name" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="last_name" type="text" name="last_name" :value="old('last_name', $user->last_name)" autofocus autocomplete="off" placeholder="Last Name" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="email" type="email" name="email" :value="old('email', $user->email)" autofocus autocomplete="off" placeholder="Email" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-select-box id="user_type_id" name="user_type_id" :value="old('user_type_id', $user->user_type_id)" :values="\App\Helpers\Helper::fetchUserType()" autocomplete="off" placeholder="User Access Level" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="contact_number" type="text" name="contact_number" :value="old('contact_number', $user->contact_number)" autofocus autocomplete="off" placeholder="Contact Number" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="date_of_birth" type="date" name="date_of_birth" :value="old('date_of_birth', $user->date_of_birth)" autofocus autocomplete="off" placeholder="Date of Birth" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="age" type="text" name="age" :value="old('age', $user->age)" autofocus autocomplete="off" placeholder="Age" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="address" type="text" name="address" :value="old('address', $user->address)" autofocus autocomplete="off" placeholder="Address" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="password" type="password" name="password" :value="old('password')" autofocus autocomplete="off" placeholder="Password" />
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 mt-2">
                        <x-primary-button class="btn btn-primary">
                            {{ __('Save') }}
                        </x-primary-button>
                        <x-back-button></x-back-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
