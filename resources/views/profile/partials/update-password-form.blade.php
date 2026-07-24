<section>
    <header>
        <h2 class="text-lg font-medium text-white">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6 mt-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm text-gray-400 mb-1">{{ __('Current Password') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password"
                   class="w-full bg-transparent border-0 border-b border-white/20 focus:border-[#6A1E55] focus:ring-0 text-white px-0 py-2 transition">
            @error('current_password', 'updatePassword')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password" class="block text-sm text-gray-400 mb-1">{{ __('New Password') }}</label>
            <input id="update_password_password" name="password" type="password" autocomplete="new-password"
                   class="w-full bg-transparent border-0 border-b border-white/20 focus:border-[#6A1E55] focus:ring-0 text-white px-0 py-2 transition">
            @error('password', 'updatePassword')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm text-gray-400 mb-1">{{ __('Confirm Password') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                   class="w-full bg-transparent border-0 border-b border-white/20 focus:border-[#6A1E55] focus:ring-0 text-white px-0 py-2 transition">
            @error('password_confirmation', 'updatePassword')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-[#6A1E55] hover:bg-[#8a2a70] text-white font-semibold px-6 py-2.5 rounded-xl transition">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-300">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>