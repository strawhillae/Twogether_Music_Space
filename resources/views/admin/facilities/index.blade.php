<x-admin-layout>
    <div class="min-h-screen bg-gray-900 relative overflow-hidden">

        <div class="absolute inset-y-0 left-0 w-1/2 bg-black"></div>
        <div class="absolute inset-y-0 right-0 w-1/2 bg-cover bg-center"
             style="background-image: url('{{ asset('images/studio-bg.jpg') }}'); filter: blur(6px); transform: scale(1.1);">
        </div>
        <div class="absolute inset-0 bg-black/50"></div>

        <div class="relative z-10 max-w-5xl mx-auto px-4 py-10">

            <div class="mb-4">
                <a href="{{ route('admin.dashboard') }}" class="text-gray-300 hover:text-white text-sm underline">
                    &larr; Kembali ke Dashboard
                </a>
            </div>

            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-white">Kelola Fasilitas</h1>
                <a href="{{ route('admin.facilities.create') }}"
                   class="bg-[#5A1E75] hover:bg-[#5A1E75]/80 text-white text-sm font-semibold px-5 py-2.5 rounded-lg transition">
                    + Tambah Fasilitas
                </a>
            </div>

            @if(session('success'))
                <div class="mb-4 px-4 py-3 rounded-xl bg-green-500/20 border border-green-400/30 text-green-300 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-gray-800/60 backdrop-blur-xl border border-white/10 shadow-2xl rounded-2xl overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-white/5 text-gray-300 text-sm">
                        <tr>
                            <th class="px-4 py-3">No</th>
                            <th class="px-4 py-3">Studio</th>
                            <th class="px-4 py-3">Fasilitas</th>
                            <th class="px-4 py-3">Kategori</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10">
                        @forelse($facilities as $facility)
                            <tr class="text-gray-200 text-sm">
                                <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3">{{ $facility->studio->nama_studio }}</td>
                                <td class="px-4 py-3">{{ $facility->nama_fasilitas }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 rounded-full text-xs bg-violet-500/20 text-violet-300">
                                        {{ $facility->kategori }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.facilities.edit', $facility) }}"
                                           class="text-indigo-300 hover:underline text-xs">Edit</a>
                                        <form action="{{ route('admin.facilities.destroy', $facility) }}" method="POST"
                                              onsubmit="return confirm('Hapus fasilitas ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:underline text-xs">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-gray-400">Belum ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-admin-layout>