<nav class="bg-transparent border-b border-[#030637] relative z-20">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('dashboard') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-white" />
                </a>
            </div>

            <!-- Semua menu + logout digabung di kanan -->
            <div class="hidden sm:flex items-center gap-3">
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center px-3 py-2 border text-sm font-medium rounded-md transition {{ request()->routeIs('dashboard') ? 'border-[#5A1E75] bg-[#5A1E75] text-white' : 'border-white/10 bg-white/5 text-gray-200 hover:text-white hover:bg-[#5A1E75]/60' }}">
                    {{ __('Home') }}
                </a>

                <a href="{{ route('history') }}"
                   class="inline-flex items-center px-3 py-2 border text-sm font-medium rounded-md transition {{ request()->routeIs('history') ? 'border-[#5A1E75] bg-[#5A1E75] text-white' : 'border-white/10 bg-white/5 text-gray-200 hover:text-white hover:bg-[#5A1E75]/60' }}">
                    {{ __('History') }}
                </a>

                <a href="{{ route('profile.edit') }}"
                   class="inline-flex items-center px-3 py-2 border text-sm font-medium rounded-md transition {{ request()->routeIs('profile.*') ? 'border-[#5A1E75] bg-[#5A1E75] text-white' : 'border-white/10 bg-white/5 text-gray-200 hover:text-white hover:bg-[#5A1E75]/60' }}">
                    {{ __('Profil') }}
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center px-3 py-2 border border-white/10 text-sm leading-4 font-medium rounded-md text-gray-200 bg-white/5 hover:text-white hover:bg-[#5A1E75]/60 focus:outline-none transition ease-in-out duration-150">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>