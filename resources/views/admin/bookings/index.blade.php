<x-admin-layout>
    <div class="min-h-screen bg-gray-900 relative overflow-hidden">

        <div class="absolute inset-y-0 left-0 w-1/2 bg-black"></div>
        <div class="absolute inset-y-0 right-0 w-1/2 bg-cover bg-center"
             style="background-image: url('{{ asset('images/studio-bg.jpg') }}'); filter: blur(6px); transform: scale(1.1);">
        </div>
        <div class="absolute inset-0 bg-black/50"></div>

        <div class="relative z-10 max-w-6xl mx-auto px-4 py-10">

            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-white">Semua Reservasi</h1>
                <a href="{{ route('admin.dashboard') }}" class="text-gray-300 hover:text-white text-sm underline">
                    &larr; Kembali ke Dashboard
                </a>
            </div>

            @if(session('success'))
                <div class="mb-4 px-4 py-3 rounded-xl bg-green-500/20 border border-green-400/30 text-green-300 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-gray-800/60 backdrop-blur-xl border border-white/10 shadow-2xl rounded-3xl p-8">
                @if($bookings->isEmpty())
                    <div class="text-center py-10">
                        <p class="text-gray-300">Belum ada reservasi masuk.</p>
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach($bookings as $booking)
                            <div class="flex items-center justify-between bg-white/5 border border-white/10 rounded-xl px-5 py-4 flex-wrap gap-3">
                                <div>
                                    <p class="text-white font-medium">
                                        {{ $booking->user->name ?? 'User' }}
                                        <span class="text-gray-400 font-normal">
                                            — {{ $booking->studio->nama_studio ?? 'Studio' }}
                                        </span>
                                    </p>
                                    <p class="text-gray-400 text-sm">
                                        {{ \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('d M Y') }}
                                        &middot;
                                        {{ \Carbon\Carbon::parse($booking->jam_mulai)->format('H:i') }}
                                        - {{ \Carbon\Carbon::parse($booking->jam_selesai)->format('H:i') }}
                                    </p>
                                </div>

                                <div class="flex items-center gap-3">
                                @php
    $statusColor = match($booking->status) {
        'Pending' => 'bg-yellow-500/20 text-yellow-300 border-yellow-400/30',
        'Disetujui' => 'bg-green-500/20 text-green-300 border-green-400/30',
        'Ditolak' => 'bg-red-500/20 text-red-300 border-red-400/30',
        'Menunggu Verifikasi' => 'bg-orange-500/20 text-orange-300 border-orange-400/30',
        'Selesai' => 'bg-blue-500/20 text-blue-300 border-blue-400/30',
        default => 'bg-gray-500/20 text-gray-300 border-gray-400/30',
    };
@endphp
<span class="px-3 py-1 rounded-full text-xs font-medium border {{ $statusColor }}">
    {{ $booking->status }}
</span>

@if($booking->status === 'Pending')
    <form action="{{ route('admin.bookings.approve', $booking) }}" method="POST">
        @csrf
        @method('PATCH')
        <button type="submit"
                class="bg-green-600 hover:bg-green-500 text-white text-xs font-medium px-3 py-1.5 rounded-lg transition">
            Setujui
        </button>
    </form>
    <form action="{{ route('admin.bookings.reject', $booking) }}" method="POST">
        @csrf
        @method('PATCH')
        <button type="submit"
                class="bg-red-600 hover:bg-red-500 text-white text-xs font-medium px-3 py-1.5 rounded-lg transition">
            Tolak
        </button>
    </form>
@elseif($booking->status === 'Menunggu Verifikasi')
    <form action="{{ route('admin.bookings.verify', $booking) }}" method="POST">
        @csrf
        @method('PATCH')
        <button type="submit"
                class="bg-blue-600 hover:bg-blue-500 text-white text-xs font-medium px-3 py-1.5 rounded-lg transition">
            Verifikasi Pembayaran
        </button>
    </form>
@endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
    </x-admin-layout>