<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="admin_fname" :value="__('First Name')" />
            <x-text-input id="admin_fname" name="admin_fname" type="text" class="mt-1 block w-full" :value="old('admin_fname', $user->admin_fname)" required autofocus autocomplete="admin_fname" />
            <x-input-error class="mt-2" :messages="$errors->get('admin_fname')" />
        </div>
        <div>
            <x-input-label for="admin_lname" :value="__('Last Name')" />
            <x-text-input id="admin_lname" name="admin_lname" type="text" class="mt-1 block w-full" :value="old('admin_lname', $user->admin_lname)" required autofocus autocomplete="admin_lname" />
            <x-input-error class="mt-2" :messages="$errors->get('admin_lname')" />
        </div>
        <div>
            <x-input-label for="admin_uname" :value="__('Username')" />
            <x-text-input id="admin_uname" name="admin_uname" type="text" class="mt-1 block w-full" :value="old('admin_uname', $user->admin_uname)" required autofocus autocomplete="admin_uname" />
            <x-input-error class="mt-2" :messages="$errors->get('admin_uname')" />
        </div>

        <div>
            <x-input-label for="admin_email" :value="__('Email')" />
            <x-text-input id="admin_email" name="admin_email" type="email" class="mt-1 block w-full" :value="old('admin_email', $user->admin_email)" required autocomplete="admin_email" />
            <x-input-error class="mt-2" :messages="$errors->get('admin_email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
