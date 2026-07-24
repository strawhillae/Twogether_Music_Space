@props(['currentPhoto' => null, 'updateRoute', 'deleteRoute'])

<div x-data="{
        showCropModal: false,
        imageSrc: null,
        cropper: null,
        openFile() { this.$refs.fileInput.click(); },
        handleFile(e) {
            const file = e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = (ev) => {
                this.imageSrc = ev.target.result;
                this.showCropModal = true;
                this.$nextTick(() => this.initCropper());
            };
            reader.readAsDataURL(file);
        },
        initCropper() {
            if (this.cropper) this.cropper.destroy();
            this.cropper = new Cropper(this.$refs.cropImage, {
                aspectRatio: 1,
                viewMode: 1,
                background: false,
            });
        },
        submitCrop() {
            this.cropper.getCroppedCanvas({ width: 400, height: 400 }).toBlob((blob) => {
                const formData = new FormData();
                formData.append('foto_profil', blob, 'profile.jpg');
                formData.append('_token', document.querySelector('meta[name=csrf-token]').content);

                fetch('{{ $updateRoute }}', { method: 'POST', body: formData })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            window.location.reload();
                        } else {
                            alert('Gagal upload: ' + JSON.stringify(data));
                        }
                    })
                    .catch(err => {
                        console.error('Upload error:', err);
                        alert('Terjadi error saat upload foto.');
                    });
            }, 'image/jpeg', 0.9);
        }
     }" class="flex flex-col items-center text-center">

    <div class="relative w-32 h-32">
        <img :src="'{{ $currentPhoto ? asset('storage/'.$currentPhoto) : 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=6A1E55&color=fff' }}'"
             class="w-32 h-32 rounded-full object-cover border-2 border-white/10">

        <button type="button" @click="openFile()"
            class="absolute bottom-1 right-1 w-8 h-8 rounded-full bg-[#6A1E55] hover:bg-[#8a2a70] border-2 border-gray-900 flex items-center justify-center transition">
            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
        </button>
    </div>

    @if($currentPhoto)
    <form action="{{ $deleteRoute }}" method="POST" onsubmit="return confirm('Hapus foto profil?')" class="mt-3">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-xs text-red-300 hover:text-red-200 underline">
            Hapus foto
        </button>
    </form>
    @endif

    <input type="file" x-ref="fileInput" @change="handleFile" accept="image/*" class="hidden">

    {{-- Modal Crop --}}
    <template x-teleport="body">
        <div x-show="showCropModal" x-cloak class="fixed inset-0 bg-black/70 z-50 flex items-center justify-center p-4">
            <div class="bg-gray-900 border border-white/10 rounded-2xl p-5 max-w-md w-full">
                <h3 class="text-white font-semibold mb-3">Sesuaikan Foto</h3>

                <div class="max-h-80 overflow-hidden rounded-lg">
                    <img :src="imageSrc" x-ref="cropImage" class="max-w-full">
                </div>

                <div class="flex justify-end gap-2 mt-4">
                    <button type="button" @click="showCropModal = false"
                        class="text-sm text-gray-300 px-4 py-2 rounded-lg hover:bg-white/10 transition">
                        Batal
                    </button>
                    <button type="button" @click="submitCrop()"
                        class="text-sm bg-[#6A1E55] hover:bg-[#8a2a70] text-white font-medium px-4 py-2 rounded-lg transition">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </template>

@once
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>
@endonce
</div>