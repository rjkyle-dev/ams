<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-center">
            <h2 class="font-semibold text-4xl text-gray-800 text-center leading-tight mt-5">
                {{ __('Account Details') }}
            </h2>
        </div>
    </x-slot>

    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex justify-center p-4 sm:p-8 shadow sm:rounded-lg">
                <div class="max-w-xl bg-white p-4 rounded-lg">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="flex justify-center p-4 sm:p-8 shadow sm:rounded-lg">
                <div class="max-w-xl bg-white p-4 rounded-lg">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="flex justify-center p-4 sm:p-8 shadow sm:rounded-lg">
                <div class="max-w-xl bg-white p-4 rounded-lg">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
