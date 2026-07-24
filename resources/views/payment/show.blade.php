<x-app-layout>
    <div class="max-w-md mx-auto mt-10 mb-10" x-data="{ showModal: false }">

        {{-- Struk --}}
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">

            <div class="bg-blue-600 text-white text-center py-5">
                <h2 class="text-lg font-bold tracking-wide">STRUK PEMBAYARAN</h2>
                <p class="text-blue-100 text-xs mt-1">Booking #{{ $booking->id }}</p>
            </div>

            <div class="p-6">
                <div class="border-b border-dashed border-gray-300 pb-4 mb-4 space-y-1 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Studio</span>
                        <span class="font-medium text-gray-800">{{ $booking->studio->nama_studio }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Tanggal</span>
                        <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('d F Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Jam</span>
                        <span class="font-medium text-gray-800">{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Status</span>
                        <span class="font-medium text-yellow-600">{{ $booking->status }}</span>
                    </div>
                </div>

                <div class="border-b border-dashed border-gray-300 pb-4 mb-4 space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Subtotal</span>
                        <span class="text-gray-800">Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Pajak ({{ $taxRate * 100 }}%)</span>
                        <span class="text-gray-800">Rp{{ number_format($taxAmount, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="flex justify-between items-center mb-6">
                    <span class="font-bold text-gray-800">Total Bayar</span>
                    <span class="font-bold text-xl text-blue-600">Rp{{ number_format($totalHarga, 0, ',', '.') }}</span>
                </div>

                <button @click="showModal = true"
                    class="w-full bg-blue-600 hover:bg-blue-700 transition text-white font-semibold py-3 rounded-lg shadow">
                    Bayar Sekarang
                </button>
            </div>

            <div class="bg-gray-50 text-center py-3 text-xs text-gray-400 border-t border-dashed border-gray-300">
                Terima kasih telah menggunakan layanan kami
            </div>
        </div>

        {{-- Modal pilih metode pembayaran --}}
        <div x-show="showModal"
             x-cloak
             x-data="{
                metode: null,
                bankTerpilih: 'BCA',
                sisaDetik: 600,
                timerJalan: false,
                mulaiTimer() {
                    if (this.timerJalan) return;
                    this.timerJalan = true;
                    let interval = setInterval(() => {
                        if (this.sisaDetik <= 0) {
                            clearInterval(interval);
                            return;
                        }
                        this.sisaDetik--;
                    }, 1000);
                },
                get waktuFormat() {
                    let m = Math.floor(this.sisaDetik / 60);
                    let s = this.sisaDetik % 60;
                    return String(m).padStart(2,'0') + ':' + String(s).padStart(2,'0');
                }
             }"
             class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4"
             style="display: none;">

            <div @click.outside="showModal = false"
                 class="bg-white rounded-xl shadow-xl w-full max-w-sm overflow-hidden max-h-[85vh] flex flex-col">

                {{-- Header modal --}}
                <div class="flex justify-between items-center px-5 py-4 border-b shrink-0">
                    <h3 class="font-bold text-gray-800">Metode Pembayaran</h3>
                    <button @click="showModal = false" class="text-gray-400 hover:text-gray-600 text-xl leading-none">&times;</button>
                </div>

                {{-- Konten scrollable --}}
                <div class="overflow-y-auto p-4 space-y-3">

                    {{-- Accordion: Via Bank --}}
                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        <button type="button"
                            @click="metode = (metode === 'bank' ? null : 'bank')"
                            class="w-full flex justify-between items-center px-4 py-3 text-sm font-semibold text-gray-800 hover:bg-gray-50">
                            Via Bank
                            <span x-text="metode === 'bank' ? '▲' : '▼'" class="text-xs text-gray-400"></span>
                        </button>

                        <div x-show="metode === 'bank'" x-cloak class="px-4 pb-4 space-y-3 text-sm">
                            <div class="grid grid-cols-3 gap-2">
                                <button type="button" @click="bankTerpilih = 'BCA'"
                                    :class="bankTerpilih === 'BCA' ? 'border-blue-600 bg-blue-50 text-blue-700' : 'border-gray-200 text-gray-500'"
                                    class="border rounded-lg py-2 text-xs font-semibold transition">
                                    BCA
                                </button>
                                <button type="button" @click="bankTerpilih = 'BSI'"
                                    :class="bankTerpilih === 'BSI' ? 'border-blue-600 bg-blue-50 text-blue-700' : 'border-gray-200 text-gray-500'"
                                    class="border rounded-lg py-2 text-xs font-semibold transition">
                                    BSI
                                </button>
                                <button type="button" @click="bankTerpilih = 'MANDIRI'"
                                    :class="bankTerpilih === 'MANDIRI' ? 'border-blue-600 bg-blue-50 text-blue-700' : 'border-gray-200 text-gray-500'"
                                    class="border rounded-lg py-2 text-xs font-semibold transition">
                                    Mandiri
                                </button>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-3 space-y-1">
                                <template x-if="bankTerpilih === 'BCA'">
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">No. Rekening</span>
                                        <span class="font-semibold text-gray-800">1234567890</span>
                                    </div>
                                </template>
                                <template x-if="bankTerpilih === 'BSI'">
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">No. Rekening</span>
                                        <span class="font-semibold text-gray-800">7264019097</span>
                                    </div>
                                </template>
                                <template x-if="bankTerpilih === 'MANDIRI'">
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">No. Rekening</span>
                                        <span class="font-semibold text-gray-800">1122334455</span>
                                    </div>
                                </template>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Atas Nama</span>
                                    <span class="font-semibold text-gray-800">Twogether Music Space Studio</span>
                                </div>
                            </div>

                            <p class="text-gray-500 text-xs">Transfer sesuai nominal total, lalu klik konfirmasi di bawah.</p>
                        </div>
                    </div>

                    {{-- Accordion: QRIS --}}
                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        <button type="button"
                            @click="metode = (metode === 'qris' ? null : 'qris'); if (metode === 'qris') mulaiTimer()"
                            class="w-full flex justify-between items-center px-4 py-3 text-sm font-semibold text-gray-800 hover:bg-gray-50">
                            QRIS
                            <span x-text="metode === 'qris' ? '▲' : '▼'" class="text-xs text-gray-400"></span>
                        </button>

                        <div x-show="metode === 'qris'" x-cloak class="px-4 pb-4 text-center space-y-3">
                            <img src="{{ asset('images/qris.jpeg') }}"
                                 alt="QRIS Twogether Music Space"
                                 class="mx-auto rounded-lg border w-40 h-40 object-contain bg-white">

                            <div>
                                <p class="text-xs text-gray-500">Selesaikan dalam</p>
                                <p class="font-bold text-lg"
                                   :class="sisaDetik <= 60 ? 'text-red-600' : 'text-gray-800'"
                                   x-text="sisaDetik > 0 ? waktuFormat : 'Waktu habis'"></p>
                            </div>

                            <a href="{{ asset('images/qris.jpeg') }}" download="QRIS-TwogetherMusicSpace.jpeg"
                               class="inline-block text-xs border border-blue-600 text-blue-600 font-semibold px-4 py-2 rounded-lg hover:bg-blue-50 transition">
                                Download QR
                            </a>

                            <p class="text-gray-500 text-xs">Scan QR di atas menggunakan aplikasi e-wallet atau m-banking kamu.</p>
                        </div>
                    </div>
                </div>

                {{-- Total & Konfirmasi --}}
                <div class="px-5 pb-5 pt-3 border-t shrink-0">
                    <div class="flex justify-between items-center mb-3 text-sm">
                        <span class="text-gray-500">Total Bayar</span>
                        <span class="font-bold text-blue-600">Rp{{ number_format($totalHarga, 0, ',', '.') }}</span>
                    </div>

                    <form action="{{ route('payment.process', $booking) }}" method="POST">
                        @csrf
                        <input type="hidden" name="metode_pembayaran" x-bind:value="metode">
                        <input type="hidden" name="bank" x-bind:value="bankTerpilih">
                        <button type="submit"
                            :disabled="metode === null"
                            :class="metode === null ? 'opacity-50 cursor-not-allowed' : 'hover:bg-blue-700'"
                            class="w-full bg-blue-600 transition text-white font-semibold py-3 rounded-lg">
                            Konfirmasi Pembayaran
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>