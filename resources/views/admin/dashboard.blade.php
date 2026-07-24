<x-admin-layout>
    <div class="min-h-screen bg-gray-900 relative overflow-hidden">

        <div class="absolute inset-y-0 left-0 w-1/2 bg-black"></div>
        <div class="absolute inset-y-0 right-0 w-1/2 bg-cover bg-center"
             style="background-image: url('{{ asset('images/studio-bg.jpg') }}'); filter: blur(6px); transform: scale(1.1);">
        </div>
        <div class="absolute inset-0 bg-black/50"></div>

        @include('components.admin-topbar')

        <div class="relative z-10 max-w-6xl mx-auto px-4 py-10">

            {{-- Welcome card --}}
            <div class="bg-gray-800/60 backdrop-blur-xl border border-white/10 shadow-2xl rounded-3xl p-8 mb-8 mt-12">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div>
                        <h1 class="text-3xl font-bold text-white">
                            Dashboard Admin
                        </h1>
                        <p class="text-gray-300 mt-1">
                            Halo, {{ auth()->user()->name }} — kelola reservasi studio di sini.
                        </p>
                    </div>
                    <span class="px-4 py-1.5 rounded-full bg-indigo-500/20 text-indigo-300 border border-indigo-400/30 text-sm font-medium">
                        Role: {{ auth()->user()->role }}
                    </span>
                </div>

                <a href="{{ route('admin.laporan.export') }}" class="btn btn-primary">
    Export Laporan PDF
</a>

                {{-- Ringkasan angka --}}
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mt-6">
                    <div class="bg-white/5 border border-white/10 rounded-xl px-5 py-4">
                        <p class="text-gray-400 text-sm">Total Reservasi</p>
                        <p class="text-2xl font-bold text-white">{{ $totalBookings }}</p>
                    </div>
                    <div class="bg-white/5 border border-white/10 rounded-xl px-5 py-4">
                        <p class="text-gray-400 text-sm">Menunggu Konfirmasi</p>
                        <p class="text-2xl font-bold text-yellow-300">{{ $pendingCount }}</p>
                    </div>
                </div>
            </div>

            {{-- Grafik booking per studio --}}
            <div class="bg-gray-800/60 backdrop-blur-xl border border-white/10 shadow-2xl rounded-3xl p-8 mb-8">
                <h2 class="text-xl font-semibold text-white mb-4">Studio Paling Diminati</h2>

                @if($chartData->isEmpty())
                    <p class="text-gray-300 text-center py-6">Belum ada data booking untuk ditampilkan.</p>
                @else
                    <canvas id="studioChart" height="100"></canvas>
                @endif
            </div>

            {{-- Footer: Twogether Music Space --}}
            <div class="bg-gray-800/60 backdrop-blur-xl border border-white/10 shadow-2xl rounded-3xl p-6 text-center">
                <h2 class="text-2xl font-bold text-white">Twogether Music Space</h2>
                <p class="text-gray-400 text-sm mt-2">Where rhythm finds its home.</p>

                <div class="flex flex-wrap items-center justify-center mt-5 text-sm text-gray-300">
                    <a href="#" class="hover:text-white transition mx-3 my-1">About</a>
                    <a href="#" class="hover:text-white transition mx-3 my-1">Contact</a>
                    <a href="#" class="hover:text-white transition mx-3 my-1">Privacy</a>
                    <a href="#" class="hover:text-white transition mx-3 my-1">Terms</a>
                    <a href="#" class="hover:text-white transition mx-3 my-1">FAQ</a>
                </div>

                <div class="flex items-center justify-center gap-3 mt-5">
                    {{-- Facebook --}}
                    <a href="#" target="_blank"
                       class="shrink-0 w-9 h-9 flex items-center justify-center rounded-full border border-white/20 text-white hover:bg-white/10 transition">
                        <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.891h-2.33v6.987C18.343 21.128 22 16.991 22 12z"/>
                        </svg>
                    </a>

                    {{-- Instagram --}}
                    <a href="https://instagram.com/twogethermusicspace" target="_blank"
                       class="shrink-0 w-9 h-9 flex items-center justify-center rounded-full border border-white/20 text-white hover:bg-white/10 transition">
                        <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.332.014 7.052.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.667.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                        </svg>
                    </a>

                    {{-- X (Twitter) --}}
                    <a href="#" target="_blank"
                       class="shrink-0 w-9 h-9 flex items-center justify-center rounded-full border border-white/20 text-white hover:bg-white/10 transition">
                        <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </a>

                    {{-- YouTube --}}
                    <a href="#" target="_blank"
                       class="shrink-0 w-9 h-9 flex items-center justify-center rounded-full border border-white/20 text-white hover:bg-white/10 transition">
                        <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.376.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.376-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </a>
                </div>
            </div>

        </div>
    </div>

    @if($chartData->isNotEmpty())
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
        <script>
            const ctx = document.getElementById('studioChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($chartData->pluck('nama')) !!},
                    datasets: [{
                        label: 'Jumlah Booking',
                        data: {!! json_encode($chartData->pluck('jumlah')) !!},
                        backgroundColor: 'rgba(139, 92, 246, 0.6)',
                        borderColor: 'rgba(139, 92, 246, 1)',
                        borderWidth: 1,
                        borderRadius: 8,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { labels: { color: '#d1d5db' } }
                    },
                    scales: {
                        x: {
                            ticks: { color: '#d1d5db' },
                            grid: { color: 'rgba(255,255,255,0.1)' }
                        },
                        y: {
                            ticks: { color: '#d1d5db', stepSize: 1 },
                            grid: { color: 'rgba(255,255,255,0.1)' },
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    @endif
</x-admin-layout>