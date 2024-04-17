<x-guest-layout>
    <div class="auth-form-wrapper px-4 py-5">

        <a href="#" class="noble-ui-logo d-block mb-2">We<span>Care</span></a>
        <h5 class="text-muted font-weight-normal mb-4">Create a free account.</h5>
        <form method="POST" action="{{ route('register') }}">
            @csrf
                 <x-text-input id="first_name" class="block w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" placeholder="First Name" />
                 <x-text-input id="last_name" class="block w-full" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="last_name" placeholder="Last Name" />
                 <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Email" />
                 <x-text-input id="date_of_birth" class="block w-full" type="date" name="date_of_birth" :value="old('date_of_birth')" required autocomplete="username" placeholder="Date of Birth" />
                 <x-text-input id="contact_number" class="block w-full" type="text" name="contact_number" :value="old('contact_number')" required autofocus autocomplete="contact_number" placeholder="Contact Number" />
                 <x-text-input id="age" class="block w-full" min="1" type="number" name="age" :value="old('age')" required autofocus autocomplete="age" placeholder="Age" />
                 <x-select-box id="gender" name="gender" :value="old('gender')" :values="\App\Helpers\Helper::$gender" autocomplete="off" placeholder="Gender" />
                 <x-text-input id="address" class="block w-full" type="text" name="address" :value="old('address')" required autofocus autocomplete="address" placeholder="Home Address" />
                 <x-text-input id="password" class="block w-full" type="password" name="password" required autocomplete="new-password" placeholder="Password" />
                 <x-text-input id="password_confirmation" class="block w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password" />
                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                    <x-primary-button class="ms-4">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
        </form>
    </div>
</x-guest-layout>
