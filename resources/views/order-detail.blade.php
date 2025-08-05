<x-layout>
    <div class="flex flex-col min-h-screen">
        <div class="flex-grow flex items-center justify-center">
            <div class="bg-white rounded-xl border border-gray-300 p-10 w-full max-w-xl mt-10 mb-10">
                <a href="#" onclick="window.history.back(); return false;"
                    class="inline-block mb-4 text-blue-600 hover:underline">&larr; Kembali</a>
                <h1 class="text-3xl font-bold text-center mb-2">Detail Pesanan</h1>
                <div class="mb-4">
                    <div class="font-bold text-lg mb-2">{{ $order->nama_proyek ?? '-' }}</div>
                    <div class="mb-1">Status: <span class="font-semibold">{{ ucfirst($order->status) }}</span></div>
                    <div class="mb-1">Tanggal Pengajuan:
                        {{ $order->created_at ? $order->created_at->setTimezone('Asia/Jakarta')->format('d-m-Y H:i:s') . ' WIB' : '-' }}
                    </div>
                    <div class="mb-1">Jumlah: {{ $order->kuantitas ?? '-' }} pcs</div>
                    <div class="mb-1">Harga: Rp
                        {{ $order->budget !== null ? number_format((float) $order->budget, 0, ',', '.') : '-' }}</div>
                    <div class="mb-1">Tenggat:
                        {{ $order->tenggat ? \Carbon\Carbon::parse($order->tenggat)->format('d-m-Y') : '-' }}</div>
                    <div class="mb-1">Deskripsi: {{ $order->deskripsi ?? '-' }}</div>

                    @if ($order->desain)
                        <div class="mb-1">Desain:
                            @php
                                $desainPath = $order->desain;
                                $fileExists = \Illuminate\Support\Facades\Storage::disk('public')->exists($desainPath);
                                $isSvg = \Illuminate\Support\Str::endsWith(strtolower($desainPath), '.svg');
                                $isImage = \Illuminate\Support\Str::endsWith(strtolower($desainPath), [
                                    '.jpg',
                                    '.jpeg',
                                    '.png',
                                    '.svg',
                                ]);
                                $fileUrl = '/storage/' . $desainPath;
                            @endphp

                            @if ($fileExists)
                                @if ($isSvg)
                                    <br><object type="image/svg+xml" data="{{ $fileUrl }}"
                                        class="max-w-xs border rounded mt-2"></object>
                                @elseif($isImage)
                                    <br><img src="{{ $fileUrl }}" alt="Desain"
                                        class="max-w-xs border rounded mt-2">
                                @else
                                    <br><a href="{{ $fileUrl }}" target="_blank"
                                        class="text-blue-600 underline">Download Desain</a>
                                @endif
                            @else
                                <br><span class="text-red-500">File desain tidak ditemukan.</span>
                            @endif
                        </div>
                    @endif
                </div>

                {{-- Tombol Bayar jika status menunggu pembayaran --}}
                @if ($order->status == 'menunggu pembayaran')
                    <form method="POST" action="#">
                        @csrf
                        <button type="button" onclick="payNow()"
                            class="w-full bg-blue-900 text-white py-2 rounded-md font-semibold hover:bg-blue-800 transition">Bayar
                            Sekarang (Midtrans)</button>
                    </form>
                @endif
            </div>
        </div>

        <footer class="bg-gray-50 py-8 border-t border-gray-200">
            <div
                class="max-w-6xl mx-auto px-4 flex flex-col md:flex-row justify-between items-start md:items-center gap-8">
                <!-- Footer Content Omitted for Brevity (sama seperti sebelumnya) -->
            </div>
            <div class="text-center text-gray-400 text-xs mt-4">Copyright Estetika.Os</div>
        </footer>
    </div>

    {{-- Midtrans Snap JS --}}
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

    {{-- Script JS pembayaran --}}
    @if ($order->status == 'menunggu pembayaran')
        <script>
            function payNow() {
                fetch('/api/payment/token', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            order_id: '{{ $order->id }}',
                            amount: '{{ $order->budget }}'
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.token) {
                            snap.pay(data.token, {
                                onSuccess: function(result) {
                                    alert("Pembayaran berhasil!");
                                    location.reload();
                                },
                                onPending: function(result) {
                                    alert("Menunggu pembayaran.");
                                    location.reload();
                                },
                                onError: function(result) {
                                    alert("Pembayaran gagal.");
                                },
                                onClose: function() {
                                    alert("Pembayaran dibatalkan.");
                                }
                            });
                        } else {
                            alert("Gagal mengambil Snap Token.");
                        }
                    })
                    .catch(error => {
                        console.error(error);
                        alert("Terjadi kesalahan.");
                    });
            }
        </script>
    @endif
</x-layout>
