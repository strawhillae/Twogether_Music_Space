<x-app-layout>
    <div class="min-h-screen bg-gray-900 relative overflow-hidden">

        <div class="absolute inset-y-0 left-0 w-1/2 bg-black"></div>
        <div class="absolute inset-y-0 right-0 w-1/2 bg-cover bg-center"
             style="background-image: url('{{ asset('image/studio-bg.jpg') }}'); filter: blur(6px); transform: scale(1.1);">
        </div>
        <div class="absolute inset-0 bg-black/50"></div>

        <div class="relative z-10 max-w-2xl mx-auto px-4 py-14">

            <div class="bg-gray-800/60 backdrop-blur-xl border border-white/10 shadow-2xl rounded-3xl p-8">
                <h1 class="text-2xl font-bold text-white mb-1">Reservasi Studio</h1>
                <p class="text-gray-300 mb-6">Isi detail booking studio kamu di bawah ini.</p>

                @if(session('success'))
                    <div class="mb-4 px-4 py-3 rounded-xl bg-green-500/20 border border-green-400/30 text-green-300 text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 px-4 py-3 rounded-xl bg-red-500/20 border border-red-400/30 text-red-300 text-sm">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('bookings.store') }}">
                    @csrf

                    {{-- Pilih Studio --}}
                    <div class="mb-5">
                        <label class="block text-white mb-2 text-sm font-medium">Studio</label>
                        <select name="studio_id" id="studio_id" required
                                class="w-full rounded-xl bg-white/20 border border-white/30 text-white px-4 py-3 backdrop-blur-sm focus:ring-2 focus:ring-violet-500 focus:outline-none">
                            <option value="" class="text-gray-800">-- Pilih Studio --</option>
                            @foreach($studios as $studio)
                                <option value="{{ $studio->id }}"
                                    data-jenis="{{ $studio->jenis }}"
                                    class="text-gray-800"
                                    {{ request('studio_id') == $studio->id ? 'selected' : '' }}>
                                    {{ $studio->nama_studio }} — Rp{{ number_format($studio->harga, 0, ',', '.') }}
                                    / {{ $studio->jenis === 'Recording' ? 'jam' : 'bulan' }}
                                </option>
                            @endforeach
                        </select>
                        @error('studio_id')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tanggal --}}
                    <div class="mb-5">
                        <label class="block text-white mb-2 text-sm font-medium">Tanggal Mulai</label>
                        <input type="date" name="tanggal" required value="{{ old('tanggal') }}"
                               class="w-full rounded-xl bg-white/20 border border-white/30 text-white px-4 py-3 backdrop-blur-sm focus:ring-2 focus:ring-violet-500 focus:outline-none">
                        @error('tanggal')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Field khusus Recording (per jam) --}}
                    <div id="field-recording" class="grid grid-cols-2 gap-4 mb-6" style="display:none;">
                        <div>
                            <label class="block text-white mb-2 text-sm font-medium">Jam Mulai</label>
                            <input type="time" name="jam_mulai" value="{{ old('jam_mulai') }}"
                                   class="w-full rounded-xl bg-white/20 border border-white/30 text-white px-4 py-3 backdrop-blur-sm focus:ring-2 focus:ring-violet-500 focus:outline-none">
                            @error('jam_mulai')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-white mb-2 text-sm font-medium">Jam Selesai</label>
                            <input type="time" name="jam_selesai" value="{{ old('jam_selesai') }}"
                                   class="w-full rounded-xl bg-white/20 border border-white/30 text-white px-4 py-3 backdrop-blur-sm focus:ring-2 focus:ring-violet-500 focus:outline-none">
                            @error('jam_selesai')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Field khusus sewa bulanan --}}
                    <div id="field-bulanan" class="mb-6" style="display:none;">
                        <label class="block text-white mb-2 text-sm font-medium">Durasi Sewa</label>
                        <select name="durasi_bulan"
                                class="w-full rounded-xl bg-white/20 border border-white/30 text-white px-4 py-3 backdrop-blur-sm focus:ring-2 focus:ring-violet-500 focus:outline-none">
                            <option value="" class="text-gray-800">-- Pilih Durasi --</option>
                            @foreach([1, 2, 3, 6, 12] as $bulan)
                                <option value="{{ $bulan }}" class="text-gray-800" {{ old('durasi_bulan') == $bulan ? 'selected' : '' }}>
                                    {{ $bulan }} Bulan
                                </option>
                            @endforeach
                        </select>
                        @error('durasi_bulan')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white text-sm underline">
                            &larr; Kembali ke Dashboard
                        </a>
                        <button type="submit"
        class="bg-[#5A1E75] hover:bg-[#5A1E75]/80 text-white font-semibold px-6 py-3 rounded-xl transition">
    Ajukan Reservasi
</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script>
        function toggleFields() {
            const select = document.getElementById('studio_id');
            const selected = select.options[select.selectedIndex];
            const jenis = selected ? selected.getAttribute('data-jenis') : null;

            const recordingFields = document.getElementById('field-recording');
            const bulananFields = document.getElementById('field-bulanan');

            if (jenis === 'Recording') {
                recordingFields.style.display = 'grid';
                bulananFields.style.display = 'none';
            } else if (jenis) {
                recordingFields.style.display = 'none';
                bulananFields.style.display = 'block';
            } else {
                recordingFields.style.display = 'none';
                bulananFields.style.display = 'none';
            }
        }

        document.getElementById('studio_id').addEventListener('change', toggleFields);
        document.addEventListener('DOMContentLoaded', toggleFields);
    </script>
</x-app-layout>