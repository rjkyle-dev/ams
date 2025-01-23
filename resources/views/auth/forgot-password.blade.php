<x-guest-layout>
    <div class="min-h-screen flex justify-center flex-col">
        <div class="flex justify-center mb-3">
            <img src="{{ asset('images/logos/IC.svg') }}" alt="Logo 1" class="w-20 md:w-30 lg:w-36 drop-shadow-lg">
            <img src="{{ asset('images/logos/ICSA.svg') }}" alt="Logo 1" class="w-20 md:w-30 lg:w-36 drop-shadow-lg">
        </div>
        <!-- Card Container -->
        <div class="max-w-md w-full bg-white shadow-md rounded-lg p-6">
            <!-- Header -->
            <h2 class="text-2xl font-bold text-gray-800 text-center">Forgot Your Password?</h2>
            <p class="text-sm text-gray-600 text-center mt-2">
                No problem! Enter your email address below, and we'll send you a link to reset your password.
            </p>

            <!-- Session Status -->
            <x-auth-session-status class="mt-4" :status="session('status')" />

            <!-- Form -->
            <form method="POST" action="{{ route('password.email') }}" class="mt-6">
                @csrf
                
                <!-- Email Address -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required 
                        autofocus 
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Enter your email"
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-center mt-6">
                    <button 
                        type="submit" 
                        class="w-full px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Email Password Reset Link
                    </button>
                </div>
            </form>

            <!-- Footer -->
            <div class="mt-6 text-center">
                <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:underline">
                    Back to Login
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
