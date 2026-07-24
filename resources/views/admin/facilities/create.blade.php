<x-app-layout>
    <div class="min-h-screen bg-gray-900 py-10 px-4">
        <div class="max-w-xl mx-auto bg-gray-800/60 backdrop-blur-xl border border-white/10 rounded-3xl p-8 shadow-2xl">

            <h1 class="text-2xl font-bold text-white mb-6">Tambah Fasilitas</h1>

            <form method="POST" action="{{ route('admin.facilities.store') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-white mb-2 text-sm font-medium">Studio</label>
                    <select name="studio_id" required
                            class="w-full rounded-xl bg-white/20 border border-white/30 text-white backdrop-blur-sm px-4 py-3 focus:ring-2 focus:ring-violet-500 focus:outline-none">
                        @foreach($studios as $studio)
                            <option value="{{ $studio->id }}" class="text-gray-800">
                                {{ $studio->nama_studio }}
                            </option>
                        @endforeach
                    </select>
                    @error('studio_id')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-white mb-2 text-sm font-medium">Nama Fasilitas</label>
                    <input type="text" name="nama_fasilitas" value="{{ old('nama_fasilitas') }}" required
                           class="w-full rounded-xl bg-white/20 border border-white/30 text-white placeholder-gray-300 backdrop-blur-sm px-4 py-3 focus:ring-2 focus:ring-violet-500 focus:outline-none">
                    @error('nama_fasilitas')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-white mb-2 text-sm font-medium">Kategori</label>
                    <select name="kategori" required
                            class="w-full rounded-xl bg-white/20 border border-white/30 text-white backdrop-blur-sm px-4 py-3 focus:ring-2 focus:ring-violet-500 focus:outline-none">
                        <option value="Alat Musik" class="text-gray-800">Alat Musik</option>
                        <option value="Furniture" class="text-gray-800">Furniture</option>
                        <option value="Elektronik" class="text-gray-800">Elektronik</option>
                        <option value="Ruangan" class="text-gray-800">Ruangan</option>
                        <option value="Internet" class="text-gray-800">Internet</option>
                        <option value="Lainnya" class="text-gray-800">Lainnya</option>
                    </select>
                    @error('kategori')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="flex items-center justify-between pt-2">
                    <a href="{{ route('admin.facilities.index') }}" class="text-gray-300 hover:text-white text-sm underline">
                        &larr; Kembali
                    </a>
                    <button type="submit" class="bg-violet-600 hover:bg-violet-500 text-white font-semibold px-6 py-3 rounded-xl transition">
                        Simpan
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>