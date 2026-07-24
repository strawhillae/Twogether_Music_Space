<x-app-layout>
    <div class="min-h-screen bg-gray-900 py-10 px-4">
        <div class="max-w-xl mx-auto bg-gray-800/60 backdrop-blur-xl border border-white/10 rounded-3xl p-8 shadow-2xl">

            <h1 class="text-2xl font-bold text-white mb-6">Tambah Studio</h1>

            <form method="POST" action="{{ route('admin.studios.store') }}" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-white mb-2 text-sm font-medium">Nama Studio</label>
                    <input type="text" name="nama_studio" value="{{ old('nama_studio') }}" required
                           class="w-full rounded-xl bg-white/20 border border-white/30 text-white placeholder-gray-300 backdrop-blur-sm px-4 py-3 focus:ring-2 focus:ring-violet-500 focus:outline-none">
                    @error('nama_studio')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-white mb-2 text-sm font-medium">Jenis</label>
                    <select name="jenis" required class="w-full rounded-xl bg-white/20 border border-white/30 text-white backdrop-blur-sm px-4 py-3 focus:ring-2 focus:ring-violet-500 focus:outline-none">
                        <option value="" class="text-gray-800">-- Pilih Jenis --</option>
                        <option value="Recording" class="text-gray-800" {{ old('jenis') === 'Recording' ? 'selected' : '' }}>Recording</option>
                        <option value="Residence" class="text-gray-800" {{ old('jenis') === 'Residence' ? 'selected' : '' }}>Residence</option>
                    </select>
                    @error('jenis')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-white mb-2 text-sm font-medium">Harga</label>
                        <input type="number" name="harga" value="{{ old('harga') }}" required
                               class="w-full rounded-xl bg-white/20 border border-white/30 text-white placeholder-gray-300 backdrop-blur-sm px-4 py-3 focus:ring-2 focus:ring-violet-500 focus:outline-none">
                        @error('harga')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-white mb-2 text-sm font-medium">Kapasitas</label>
                        <input type="number" name="kapasitas" value="{{ old('kapasitas') }}" required
                               class="w-full rounded-xl bg-white/20 border border-white/30 text-white placeholder-gray-300 backdrop-blur-sm px-4 py-3 focus:ring-2 focus:ring-violet-500 focus:outline-none">
                        @error('kapasitas')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div>
                    <label class="block text-white mb-2 text-sm font-medium">Deskripsi</label>
                    <textarea name="deskripsi" rows="3"
                              class="w-full rounded-xl bg-white/20 border border-white/30 text-white placeholder-gray-300 backdrop-blur-sm px-4 py-3 focus:ring-2 focus:ring-violet-500 focus:outline-none">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-white mb-2 text-sm font-medium">Foto Studio</label>
                    <input type="file" name="foto" accept="image/*"
                           class="w-full text-white text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-violet-600 file:text-white file:text-sm hover:file:bg-violet-500">
                    @error('foto')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-white mb-2 text-sm font-medium">Status</label>
                    <select name="status" required class="w-full rounded-xl bg-white/20 border border-white/30 text-white backdrop-blur-sm px-4 py-3 focus:ring-2 focus:ring-violet-500 focus:outline-none">
                        <option value="Tersedia" class="text-gray-800" {{ old('status') === 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="Maintenance" class="text-gray-800" {{ old('status') === 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                    </select>
                    @error('status')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="flex items-center justify-between pt-2">
                    <a href="{{ route('admin.studios.index') }}" class="text-gray-300 hover:text-white text-sm underline">&larr; Kembali</a>
                    <button type="submit" class="bg-violet-600 hover:bg-violet-500 text-white font-semibold px-6 py-3 rounded-xl transition">
                        Simpan Studio
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>