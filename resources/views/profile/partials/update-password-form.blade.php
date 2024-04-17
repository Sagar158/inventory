<section>
    <header>
        <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Password') }}
        </h4>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-sm-12 col-md-4">
                    <x-text-input id="update_password_current_password" placeholder="Current Password" name="current_password" type="password"  autocomplete="current-password" />
                </div>
                <div class="col-lg-4 col-sm-12 col-md-4">
                    <x-text-input id="update_password_password" name="password" type="password" placeholder="New Password" autocomplete="new-password" />
                </div>
                <div class="col-lg-4 col-sm-12 col-md-4">
                    <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" placeholder="Confirm Password" autocomplete="new-password" />
                </div>
                <div class="col-lg-12 col-sm-12 col-md-12">
                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>

                        @if (session('status') === 'password-updated')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600 dark:text-gray-400"
                            >{{ __('Saved.') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
