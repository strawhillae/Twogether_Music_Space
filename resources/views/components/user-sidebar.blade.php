{{-- Tombol Titik Tiga --}}
<div class="fixed top-6 right-6 z-50">
    <button onclick="toggleSidebar()" class="bg-gray-800/80 backdrop-blur-md border border-white/10 p-3 rounded-xl text-white hover:bg-gray-700/80 transition">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <circle cx="12" cy="5" r="1.8"/>
            <circle cx="12" cy="12" r="1.8"/>
            <circle cx="12" cy="19" r="1.8"/>
        </svg>
    </button>
</div>

{{-- Overlay --}}
<div id="sidebarOverlay" onclick="toggleSidebar()" class="hidden fixed inset-0 bg-black/60 z-40"></div>

{{-- Sidebar --}}
<div id="sidebar" class="fixed top-0 right-0 h-full w-72 bg-gray-900/95 backdrop-blur-xl border-l border-white/10 z-50 translate-x-full transition-transform duration-300 ease-in-out">
    <div class="p-6">
        <div class="flex items-center justify-between mb-8">
            <span class="text-white font-bold text-lg">🎵 Twogether</span>
            <button onclick="toggleSidebar()" class="text-gray-400 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <nav class="space-y-2">
            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('dashboard') ? 'bg-violet-600 text-white' : 'text-gray-300 hover:bg-white/10' }} transition">
                <span class="text-lg">🏠</span>
                <span class="font-medium text-sm">Home</span>
            </a>

            <a href="{{ route('history') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('history') ? 'bg-violet-600 text-white' : 'text-gray-300 hover:bg-white/10' }} transition">
                <span class="text-lg">🕓</span>
                <span class="font-medium text-sm">History</span>
            </a>

            <a href="{{ route('profile.edit') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('profile.edit') ? 'bg-violet-600 text-white' : 'text-gray-300 hover:bg-white/10' }} transition">
                <span class="text-lg">👤</span>
                <span class="font-medium text-sm">Profile</span>
            </a>

            <div class="pt-4 mt-4 border-t border-white/10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-red-300 hover:bg-red-500/10 transition">
                        <span class="text-lg">🚪</span>
                        <span class="font-medium text-sm">Logout</span>
                    </button>
                </form>
            </div>
        </nav>
    </div>
</div>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('translate-x-full');
        document.getElementById('sidebarOverlay').classList.toggle('hidden');
    }
</script>