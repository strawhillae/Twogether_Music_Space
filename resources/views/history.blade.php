<x-app-layout>
    <div class="min-h-screen bg-gray-900 relative overflow-hidden">

        <div class="absolute inset-y-0 left-0 w-1/2 bg-black"></div>
        <div class="absolute inset-y-0 right-0 w-1/2 bg-cover bg-center"
             style="background-image: url('{{ asset('images/studio-bg.jpg') }}'); filter: blur(6px); transform: scale(1.1);">
        </div>
        <div class="absolute inset-0 bg-black/50"></div>

      

        <div class="relative z-10 max-w-6xl mx-auto px-4 py-10">

            <h2 class="text-3xl font-bold text-white mt-12 mb-6">Reservasi Kamu</h2>

            <div class="bg-gray-800/60 backdrop-blur-xl border border-white/10 shadow-2xl rounded-3xl p-8">
                @if($bookings->isEmpty())
                    <p class="text-gray-300 text-center">Yuk booking studio pertamamu sekarang!</p>
                @else
                    <div class="space-y-3">
                        @foreach($bookings as $booking)
                            <div class="bg-white/5 border border-white/10 rounded-xl px-5 py-4">
                                <div class="flex items-center justify-between flex-wrap gap-2">
                                    <div>
                                        <p class="text-white font-medium">{{ $booking->studio->nama_studio ?? 'Studio' }}</p>
                                        <p class="text-gray-400 text-sm">
                                            {{ \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('d M Y') }}
                                            &middot;
                                            {{ \Carbon\Carbon::parse($booking->jam_mulai)->format('H:i') }}
                                            - {{ \Carbon\Carbon::parse($booking->jam_selesai)->format('H:i') }}
                                        </p>
                                    </div>
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
                                </div>

                                @if($booking->status === 'Disetujui')
                                    <div class="mt-3 pt-3 border-t border-white/10">
                                        <p class="text-green-300 text-sm font-medium mb-2">✓ Reservasi disetujui, silakan lakukan pembayaran.</p>
                                        <a href="{{ route('payment.show', $booking) }}"
                                           class="inline-block bg-violet-600 hover:bg-violet-500 text-white text-sm font-semibold px-5 py-2.5 rounded-lg transition">
                                            Bayar Sekarang — Rp{{ number_format($booking->total_harga, 0, ',', '.') }}
                                        </a>
                                    </div>
                                    @elseif($booking->status === 'Menunggu Verifikasi')
    <div class="mt-3 pt-3 border-t border-white/10">
        <p class="text-orange-300 text-sm font-medium">
            💳 Pembayaran via <span class="font-bold">{{ $booking->metode_pembayaran }}</span> — menunggu verifikasi admin.
        </p>
    </div>
@elseif($booking->status === 'Selesai')
    <div class="mt-3 pt-3 border-t border-white/10">
        <p class="text-blue-300 text-sm font-medium mb-2">✓ Pembayaran terverifikasi. Terima kasih!</p>
        <a href="{{ route('receipt.download', $booking) }}"
           class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
            📄 Download Struk
        </a>
    </div>
@endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>