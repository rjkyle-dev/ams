<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <!-- Left Column: Takes up 2/3 of the width on medium screens and larger -->
    <div class="md:basis-2/3 lg:basis-7/12 flex flex-col items-center justify-center space-y-4">
        <!-- Images stacked on top of each other -->
        <div class="flex gap-3">
            <img src="{{ asset('images/logos/IC.svg') }}" alt="Logo 1" class="w-32 md:w-40 lg:w-44 drop-shadow-lg">
            <img src="{{ asset('images/logos/ICSA.svg') }}" alt="Logo 2" class="w-32 md:w-40 lg:w-44 drop-shadow-lg">
        </div>

        <!-- Text below the images -->
        <h1 class="text-3xl md:text-5xl lg:text-8xl font-extrabold text-center drop-shadow-2xl">
            <span class="text-yellow-400">Attendance</span>
            <span class="text-white">Management</span>
            <span class="text-yellow-400">System</span>
        </h1>
    </div>


                

    <!-- Right Column: Takes up 1/3 of the width on medium screens and larger -->
    <div
        class="md:basis-1/3 lg:basis-5/12 border-4 border-purple-900 md:border md:border-purple-900 lg:border-t-4 lg:border-b-4 lg:border-l-4 lg:border-r-0 bg-white p-6 py-12 rounded-xl md:rounded-l-3xl md:rounded-r-none shadow-md">
        <h1 class="text-3xl font-semibold text-center pb-14 text-purple-800">Register as Admin</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="grid grid-cols-2 gap-4">
                <!-- First Name -->
                <div>
                    <x-input-label for="first_name" :value="__('First Name')" />
                    <x-text-input id="first_name" class="block mt-1 w-full" placeholder="John" type="text"
                        name="admin_fname" :value="old('first_name')" required autofocus autocomplete="first_name" />
                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                </div>

                <!-- Last Name -->
                <div>
                    <x-input-label for="last_name" :value="__('Last Name')" />
                    <x-text-input id="last_name" class="block mt-1 w-full" placeholder="Doe" type="text"
                        name="admin_lname" :value="old('last_name')" required autocomplete="last_name" />
                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                </div>

                <!-- Username -->
                <div>
                    <x-input-label for="username" :value="__('Username')" />
                    <x-text-input id="username" class="block mt-1 w-full" placeholder="JohnDoe" type="text"
                        name="username" :value="old('username')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email Address')" />
                    <x-text-input id="email" class="block mt-1 w-full" placeholder="example@gmail.com"
                        type="email" name="email" :value="old('email')" required autocomplete="email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                        placeholder="Password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        placeholder="Confirm Password" name="password_confirmation" required
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>

            <div class="flex items-center justify-end mt-6">
                <x-primary-button class="ms-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
            <div class="flex justify-center mt-3">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
