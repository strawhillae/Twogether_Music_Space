<x-app-layout>
    <div class="min-h-screen bg-gray-900 relative overflow-hidden">

        <div class="absolute inset-y-0 left-0 w-1/2 bg-black"></div>
        <div class="absolute inset-y-0 right-0 w-1/2 bg-cover bg-center"
             style="background-image: url('{{ asset('images/studio-bg.jpg') }}'); filter: blur(6px); transform: scale(1.1);">
        </div>
        <div class="absolute inset-0 bg-black/50"></div>


        <div class="relative z-10 max-w-6xl mx-auto px-4 py-10">

            <div class="mb-14 mt-12">
                <h1 class="text-3xl font-bold text-white">
                    Welcome, {{ auth()->user()->name }} — a melody awaits your arrival.
                </h1>
                <p class="text-gray-300 mt-1 mb-8">Discover your sonic sanctuary today.</p>

                <h2 class="text-xl font-semibold text-white mb-4">Signature Spaces</h2>

                @if($studios->isEmpty())
                    <p class="text-gray-300">Belum ada studio tersedia saat ini.</p>
                @else
                    <div class="grid grid-cols-2 gap-10 max-w-xl mx-auto justify-items-center">
                        @foreach($studios as $studio)
                            <div class="bg-gray-800/60 backdrop-blur-xl border border-white/10 rounded-3xl overflow-hidden hover:border-violet-400/50 transition w-full max-w-xs">

                                <img src="{{ $studio->foto ? asset('storage/'.$studio->foto) : 'https://placehold.co/300x225/1f2937/9ca3af?text=Studio' }}"
                                     alt="{{ $studio->nama_studio }}"
                                     class="w-full h-40 object-cover">

                                <div class="p-4">
                                    <p class="text-white font-semibold text-sm truncate">{{ $studio->nama_studio }}</p>
                                    <p class="text-gray-400 text-xs mt-0.5">{{ $studio->jenis }}</p>
                                    <p class="text-violet-300 font-medium mt-1 text-xs">
                                        Rp{{ number_format($studio->harga, 0, ',', '.') }}
                                        <span class="text-gray-400">/ {{ $studio->jenis === 'Recording' ? 'jam' : 'bulan' }}</span>
                                    </p>

                                    <div class="flex items-center justify-between mt-4">
                                        <button onclick="openModal({{ $studio->id }})"
                                                class="border border-white/20 text-white text-sm font-medium px-4 py-2.5 rounded-lg hover:bg-white/10 transition">
                                            Detail
                                        </button>
                                        <a href="{{ route('bookings.create', ['studio_id' => $studio->id]) }}"
   class="bg-[#5A1E75] hover:bg-[#5A1E75]/80 text-white text-sm font-semibold px-5 py-2.5 rounded-lg transition">
    Book
</a>
                                    </div>
                                </div>
                            </div>

                            <div id="modal-{{ $studio->id }}" class="hidden fixed inset-0 z-50 flex items-center justify-center px-4">
                                <div class="absolute inset-0 bg-black/70" onclick="closeModal({{ $studio->id }})"></div>

                                <div class="relative bg-gray-800 border border-white/10 rounded-3xl max-w-md w-full p-6 shadow-2xl max-h-[85vh] overflow-y-auto">
                                    <button onclick="closeModal({{ $studio->id }})"
                                            class="absolute top-4 right-4 text-gray-400 hover:text-white">✕</button>

                                    <img src="{{ $studio->foto ? asset('storage/'.$studio->foto) : 'https://placehold.co/400x300/1f2937/9ca3af?text=Studio' }}"
                                         class="w-full h-48 object-cover rounded-xl mb-4">

                                    <h3 class="text-white text-xl font-bold">{{ $studio->nama_studio }}</h3>
                                    <p class="text-gray-400 text-sm mb-3">{{ $studio->jenis }} &middot; Kapasitas {{ $studio->kapasitas }} orang</p>
                                    <p class="text-gray-300 text-sm mb-4">
                                        {{ $studio->deskripsi ?? 'Belum ada deskripsi untuk studio ini.' }}
                                    </p>

                                    @if($studio->facilities->isNotEmpty())
                                        <div class="mb-4">
                                            <p class="text-white text-sm font-semibold mb-2">Fasilitas Tersedia</p>
                                            <div class="space-y-3">
                                                @foreach($studio->facilities->groupBy('kategori') as $kategori => $items)
                                                    <div>
                                                        <p class="text-violet-300 text-xs font-medium mb-1">{{ $kategori }}</p>
                                                        <div class="flex flex-wrap gap-2">
                                                            @foreach($items as $item)
                                                                <span class="bg-white/10 border border-white/10 text-gray-200 text-xs px-3 py-1 rounded-full">
                                                                    {{ $item->nama_fasilitas }}
                                                                </span>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    <p class="text-violet-300 font-semibold text-lg mb-5">
                                        Rp{{ number_format($studio->harga, 0, ',', '.') }}
                                        <span class="text-gray-400 text-sm font-normal">/ {{ $studio->jenis === 'Recording' ? 'jam' : 'bulan' }}</span>
                                    </p>
                                    <a href="{{ route('bookings.create', ['studio_id' => $studio->id]) }}"
   class="block text-center bg-[#5A1E75] hover:bg-[#5A1E75]/80 text-white font-semibold py-3 rounded-xl transition">
    Book Now
</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById('modal-' + id).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        function closeModal(id) {
            document.getElementById('modal-' + id).classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    </script>
</x-app-layout>