@php
    $isAdmin = request()->routeIs('admin.*');
    $updateProfileRoute = $isAdmin ? route('admin.profile.update') : route('profile.update');
@endphp

<section x-data="{ editing: {{ $errors->any() ? 'true' : 'false' }} }">
    <header class="flex items-start justify-between gap-4">
        <div>
            <h2 class="text-lg font-medium text-white">
                {{ __('Profile Information') }}
            </h2>
            <p class="mt-1 text-sm text-gray-400">
                {{ __("Update your account's profile information and email address.") }}
            </p>
        </div>

        <button type="button" x-show="!editing" @click="editing = true"
            class="shrink-0 text-sm bg-[#6A1E55]/30 border border-[#6A1E55]/60 hover:bg-[#6A1E55]/50 text-white font-medium px-4 py-2 rounded-lg transition">
            Edit Profil
        </button>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ $updateProfileRoute }}" class="space-y-6 mt-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label for="first_name" class="block text-sm text-gray-400 mb-1">{{ __('First Name') }}</label>
                <input id="first_name" name="first_name" type="text" value="{{ old('first_name', $user->first_name) }}" required autofocus
                       :disabled="!editing"
                       :class="editing ? 'border-white/20 focus:border-[#6A1E55] text-white' : 'border-white/10 text-gray-400 cursor-not-allowed'"
                       class="w-full bg-transparent border-0 border-b focus:ring-0 px-0 py-2 transition">
                @error('first_name')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="last_name" class="block text-sm text-gray-400 mb-1">{{ __('Last Name') }}</label>
                <input id="last_name" name="last_name" type="text" value="{{ old('last_name', $user->last_name) }}"
                       :disabled="!editing"
                       :class="editing ? 'border-white/20 focus:border-[#6A1E55] text-white' : 'border-white/10 text-gray-400 cursor-not-allowed'"
                       class="w-full bg-transparent border-0 border-b focus:ring-0 px-0 py-2 transition">
                @error('last_name')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="date_of_birth" class="block text-sm text-gray-400 mb-1">{{ __('Date of Birth') }}</label>
                <input id="date_of_birth" name="date_of_birth" type="date" value="{{ old('date_of_birth', $user->date_of_birth?->format('Y-m-d')) }}"
                       :disabled="!editing"
                       :class="editing ? 'border-white/20 focus:border-[#6A1E55] text-white' : 'border-white/10 text-gray-400 cursor-not-allowed'"
                       class="w-full bg-transparent border-0 border-b focus:ring-0 px-0 py-2 transition [color-scheme:dark]">
                @error('date_of_birth')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm text-gray-400 mb-1">{{ __('Email') }}</label>
                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                       :disabled="!editing"
                       :class="editing ? 'border-white/20 focus:border-[#6A1E55] text-white' : 'border-white/10 text-gray-400 cursor-not-allowed'"
                       class="w-full bg-transparent border-0 border-b focus:ring-0 px-0 py-2 transition">
                @error('email')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-300">
                            {{ __('Your email address is unverified.') }}
                            <button form="send-verification" class="underline text-sm text-gray-300 hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#6A1E55]">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>
                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-400">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <div class="flex items-center gap-4" x-show="editing">
            <button type="submit" class="bg-[#6A1E55] hover:bg-[#8a2a70] text-white font-semibold px-6 py-2.5 rounded-xl transition">
                {{ __('Save') }}
            </button>

            <button type="button" @click="editing = false"
                class="text-sm text-gray-300 px-4 py-2 rounded-lg hover:bg-white/10 transition">
                {{ __('Cancel') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-300">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>