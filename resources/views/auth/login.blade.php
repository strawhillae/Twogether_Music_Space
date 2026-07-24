<x-guest-layout>
    <h2 class="text-2xl font-bold text-white text-center mb-1">Login</h2>
    <p class="text-center text-gray-300 mb-6">Welcome Back</p>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-white" />
            <x-text-input id="email" class="block mt-1 w-full bg-white/20 text-white placeholder-gray-300 border-white/30" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-white" />
            <x-text-input id="password" class="block mt-1 w-full bg-white/20 text-white placeholder-gray-300 border-white/30"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm" name="remember">
                <span class="ms-2 text-sm text-gray-200">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-300 hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot?') }}
                </a>
            @endif

            <x-primary-button>
                {{ __('Login') }}
            </x-primary-button>
        </div>
    </form>

    <p class="text-center text-gray-300 mt-6">
        {{ __('Belum punya akun?') }}
        <a href="{{ route('register') }}" class="text-indigo-300 underline">{{ __('Register') }}</a>
    </p>
</x-guest-layout>