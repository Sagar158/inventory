<section>
    <header>
        <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ trans('general.profile_information') }}
        </h4>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-sm-12 col-md-4">
                    <x-text-input id="first_name" name="first_name" placeholder="{{ trans('general.first_name') }}" type="text" :value="old('first_name', $user->first_name)" required autofocus autocomplete="first_name" />
                </div>
                <div class="col-lg-4 col-sm-12 col-md-4">
                    <x-text-input id="last_name" name="last_name" placeholder="{{ trans('general.last_name') }}" type="text" :value="old('last_name', $user->last_name)" required autofocus autocomplete="last_name" />
                </div>
                <div class="col-lg-4 col-sm-12 col-md-4">
                    <x-text-input id="email" name="email" type="email" placeholder="{{ trans('general.email') }}" :value="old('email', $user->email)" required autocomplete="username" />
                </div>
                <div class="col-lg-4 col-sm-12 col-md-4">
                    <x-text-input id="date_of_birth" name="date_of_birth" type="date" placeholder="{{ trans('general.date_of_birth') }}" :value="old('date_of_birth', $user->date_of_birth)" required autofocus autocomplete="name" />
                </div>
                <div class="col-lg-4 col-sm-12 col-md-4">
                    <x-text-input id="contact_number" name="contact_number" placeholder="{{ trans('general.contact_number') }}" type="text" :value="old('contact_number', $user->contact_number)" required autofocus autocomplete="name" />
                </div>
                <div class="col-lg-4 col-sm-12 col-md-4">
                    <x-text-input id="address" name="address" type="text" placeholder="{{ trans('general.address') }}" :value="old('address', $user->address)" required autofocus autocomplete="name" />
                </div>
                <div class="col-lg-4 col-sm-12 col-md-4">
                    <x-text-input id="age" name="age" type="text" placeholder="{{ trans('general.age') }}" :value="old('age', $user->age)" required autofocus autocomplete="name" />
                </div>
                <div class="col-lg-4 col-sm-12 col-md-4">
                    <x-select-box id="gender" name="gender" :value="old('gender', $user->gender)" :values="\App\Helpers\Helper::$gender" autocomplete="off" placeholder="{{ trans('general.gender') }}" />
                </div>
                <div class="col-lg-12 col-sm-12 col-md-12">
                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ trans('general.save') }}</x-primary-button>

                        @if (session('status') === 'profile-updated')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600 dark:text-gray-400"
                            >{{ trans('general.saved') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </form>
</section>
