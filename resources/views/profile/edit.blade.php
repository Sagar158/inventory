<x-app-layout>
    <x-slot name="header">
        <h4 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ trans('general.profile') }}
        </h4>
    </x-slot>

    <div class="py-12">
        <div class="max-w-12xl mx-auto sm:px-12 lg:px-12 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    @include('profile.partials.update-profile-information-form')
            </div>

            <div class="p-4 sm:p-12 mt-2 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                @include('profile.partials.update-password-form')
            </div>

        </div>
    </div>
</x-app-layout>
