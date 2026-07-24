{{-- Tombol Notifikasi & Titik Tiga --}}
<div class="fixed top-6 right-6 z-50 flex items-center gap-3">

    <div class="relative">
        <button onclick="toggleNotif()" class="bg-gray-800/80 backdrop-blur-md border border-white/10 p-3 rounded-xl text-white hover:bg-gray-700/80 transition relative">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 10-12 0v3.2a2 2 0 01-.6 1.4L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            @if($pendingCount > 0)
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold w-5 h-5 flex items-center justify-center rounded-full">
                    {{ $pendingCount }}
                </span>
            @endif
        </button>

        <div id="notifDropdown" class="hidden absolute top-16 right-0 w-80 bg-gray-900/95 backdrop-blur-xl border border-white/10 rounded-2xl shadow-2xl overflow-hidden">
            <div class="p-4 border-b border-white/10">
                <p class="text-white font-semibold text-sm">Reservasi Menunggu Konfirmasi</p>
            </div>

            <div class="max-h-80 overflow-y-auto">
                @forelse($pendingBookings as $booking)
                    <a href="{{ route('admin.bookings.index') }}" class="block px-4 py-3 border-b border-white/5 hover:bg-white/5 transition">
                        <p class="text-white text-sm font-medium">
                            {{ $booking->user->name ?? 'User' }}
                            <span class="text-gray-400 font-normal">— {{ $booking->studio->nama_studio ?? 'Studio' }}</span>
                        </p>
                        <p class="text-gray-400 text-xs mt-0.5">
                            {{ \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('d M Y') }}
                            &middot;
                            {{ \Carbon\Carbon::parse($booking->jam_mulai)->format('H:i') }}
                        </p>
                    </a>
                @empty
                    <div class="px-4 py-8 text-center">
                        <p class="text-gray-400 text-sm">Tidak ada reservasi pending.</p>
                    </div>
                @endforelse
            </div>

            @if($pendingCount > 0)
                <a href="{{ route('admin.bookings.index') }}" class="block text-center py-3 text-violet-300 text-sm font-medium hover:bg-white/5 transition">
                    Lihat Semua
                </a>
            @endif
        </div>
    </div>

    <button onclick="toggleSidebar()" class="bg-gray-800/80 backdrop-blur-md border border-white/10 p-3 rounded-xl text-white hover:bg-gray-700/80 transition">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <circle cx="12" cy="5" r="1.8"/>
            <circle cx="12" cy="12" r="1.8"/>
            <circle cx="12" cy="19" r="1.8"/>
        </svg>
    </button>
</div>

<div id="sidebarOverlay" onclick="toggleSidebar()" class="hidden fixed inset-0 bg-black/60 z-40"></div>

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
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-violet-600 text-white' : 'text-gray-300 hover:bg-white/10' }} transition">
                <span class="text-lg">🏠</span>
                <span class="font-medium text-sm">Dashboard</span>
            </a>

            <a href="{{ route('admin.studios.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.studios.*') ? 'bg-violet-600 text-white' : 'text-gray-300 hover:bg-white/10' }} transition">
                <span class="text-lg">🏢</span>
                <span class="font-medium text-sm">Kelola Studio</span>
            </a>

            <a href="{{ route('admin.facilities.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.facilities.*') ? 'bg-violet-600 text-white' : 'text-gray-300 hover:bg-white/10' }} transition">
                <span class="text-lg">🎛️</span>
                <span class="font-medium text-sm">Kelola Fasilitas</span>
            </a>

            <a href="{{ route('admin.bookings.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.bookings.*') ? 'bg-violet-600 text-white' : 'text-gray-300 hover:bg-white/10' }} transition">
                <span class="text-lg">📋</span>
                <span class="font-medium text-sm">Semua Reservasi</span>
            </a>

            <a href="{{ route('admin.profile.edit') }}"
   class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.profile.edit') ? 'bg-violet-600 text-white' : 'text-gray-300 hover:bg-white/10' }} transition">
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

    function toggleNotif() {
        document.getElementById('notifDropdown').classList.toggle('hidden');
    }

    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('notifDropdown');
        const isClickInside = event.target.closest('#notifDropdown') || event.target.closest('button[onclick="toggleNotif()"]');
        if (!isClickInside && dropdown && !dropdown.classList.contains('hidden')) {
            dropdown.classList.add('hidden');
        }
    });
</script>