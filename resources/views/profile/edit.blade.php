<x-app-layout>
    <div class="min-h-screen bg-gray-900 relative overflow-hidden">
        <div class="absolute inset-y-0 left-0 w-1/2 bg-black"></div>
        <div class="absolute inset-y-0 right-0 w-1/2 bg-cover bg-center"
             style="background-image: url('{{ asset('images/studio-bg.jpg') }}'); filter: blur(6px); transform: scale(1.1);">
        </div>
        <div class="absolute inset-0 bg-black/50"></div>

        <div class="relative z-10 max-w-4xl mx-auto px-4 py-10">
            <h2 class="text-3xl font-bold text-white mt-12 mb-6">Profile Kamu</h2>

            @if(session('status') === 'photo-deleted')
                <div class="bg-green-500/20 border border-green-400/30 text-green-300 text-sm rounded-lg px-4 py-3 mb-4">
                    Foto profil berhasil dihapus.
                </div>
            @endif

            <div class="bg-gray-800/60 backdrop-blur-xl border border-white/10 shadow-2xl rounded-3xl p-8">
                <div class="flex flex-col md:flex-row gap-8">

                    <div class="w-full md:w-56 shrink-0 flex flex-col items-center md:border-r md:border-white/10 md:pr-8">
                        <x-profile-photo
                            :current-photo="$user->foto_profil"
                            :update-route="route('profile.photo.update')"
                            :delete-route="route('profile.photo.destroy')" />

                        <form method="POST" action="{{ route('logout') }}" class="mt-6">
                            @csrf
                            <button type="submit" class="flex items-center gap-2 text-gray-400 hover:text-white text-sm transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Log out
                            </button>
                        </form>
                    </div>

                    <div class="flex-1 min-w-0">
                        @include('profile.partials.update-profile-information-form')
                    </div>

                </div>
            </div>

            <div class="flex justify-end mt-6">
                @include('profile.partials.delete-user-form')
            </div>

        </div>
    </div>
</x-app-layout>