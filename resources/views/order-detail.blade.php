<x-layout>
<div class="flex flex-col min-h-screen">
    <div class="flex-grow flex items-center justify-center">
        <div class="bg-white rounded-xl border border-gray-300 p-10 w-full max-w-xl mt-10 mb-10">
            <a href="#" onclick="window.history.back(); return false;" class="inline-block mb-4 text-blue-600 hover:underline">&larr; Kembali</a>
            <h1 class="text-3xl font-bold text-center mb-2">Detail Pesanan</h1>
            <div class="mb-4">
                <div class="font-bold text-lg mb-2">{{ $order->nama_proyek ?? '-' }}</div>
                <div class="mb-1">Status: <span class="font-semibold">{{ ucfirst($order->status) }}</span></div>
                <div class="mb-1">Tanggal Pengajuan: {{ $order->created_at ? $order->created_at->setTimezone('Asia/Jakarta')->format('d-m-Y H:i:s') . ' WIB' : '-' }}</div>
                <div class="mb-1">Jumlah: {{ $order->kuantitas ?? '-' }} pcs</div>
                <div class="mb-1">Harga: Rp {{ $order->budget !== null ? number_format((float) $order->budget, 0, ',', '.') : '-' }}</div>
                <div class="mb-1">Tenggat: {{ $order->tenggat ? \Carbon\Carbon::parse($order->tenggat)->format('d-m-Y') : '-' }}</div>
                <div class="mb-1">Deskripsi: {{ $order->deskripsi ?? '-' }}</div>
@if($order->desain)
    <div class="mb-1">Desain:
        @php
            $desainPath = $order->desain;
            $fileExists = \Illuminate\Support\Facades\Storage::disk('public')->exists($desainPath);
            $isSvg = \Illuminate\Support\Str::endsWith(strtolower($desainPath), '.svg');
            $isImage = \Illuminate\Support\Str::endsWith(strtolower($desainPath), ['.jpg', '.jpeg', '.png', '.svg']);
            $fileUrl = '/storage/' . $desainPath;
        @endphp

        @if($fileExists)
            @if($isSvg)
                <br><object type="image/svg+xml" data="{{ $fileUrl }}" class="max-w-xs border rounded mt-2" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                    <div style="display:none; color: red;">Gagal memuat file SVG</div>
                </object>
            @elseif($isImage)
                <br><img src="{{ $fileUrl }}" alt="Desain" class="max-w-xs border rounded mt-2" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                <div style="display:none; color: red;">Gagal memuat gambar</div>
            @else
                <br><a href="{{ $fileUrl }}" target="_blank" class="text-blue-600 underline">Download Desain</a>
            @endif
        @else
            <br><span class="text-red-500">File desain tidak ditemukan.</span>
        @endif
    </div>
@endif
            </div>
            @if($order->status == 'menunggu pembayaran')
                <form method="POST" action="#">
                    @csrf
                    <button type="button" class="w-full bg-blue-900 text-white py-2 rounded-md font-semibold hover:bg-blue-800 transition">Bayar Sekarang (Midtrans)</button>
                </form>
            @endif
        </div>
    </div>
    <footer class="bg-gray-50 py-8 border-t border-gray-200">
        <div class="max-w-6xl mx-auto px-4 flex flex-col md:flex-row justify-between items-start md:items-center gap-8">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <img src="/img/logo.png" alt="Logo" class="w-10 h-10 rounded-full">
                    <span class="font-semibold">Others :</span>
                </div>
                <div class="text-gray-600 text-sm">Tentang Estetika.Os</div>
            </div>
            <div>
                <div class="font-semibold mb-2">Head Office :</div>
                <div class="flex items-center text-gray-600 text-sm mb-1">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M17.657 16.657L13.414 12.414a2 2 0 0 0-2.828 0l-4.243 4.243"></path>
                        <path d="M15 11a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"></path>
                    </svg>
                    Tangerang Selatan, Indonesia
                </div>
                <div class="flex items-center text-gray-600 text-sm mb-1">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M3 8l7.89 5.26a2 2 0 0 0 2.22 0L21 8"></path>
                        <path d="M21 8v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8"></path>
                    </svg>
                    +62 857 5619 8835
                </div>
                <div class="flex items-center text-gray-600 text-sm">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M16 12a4 4 0 1 1-8 0 4 4 0 0 1 8 0z"></path>
                        <path d="M12 2v2m0 16v2m8-10h2M2 12H0m16.24-7.76l1.42 1.42M4.34 19.66l-1.42 1.42M19.66 19.66l-1.42-1.42M4.34 4.34L2.92 2.92"></path>
                    </svg>
                    estetika.os@gmail.com
                </div>
            </div>
            <div>
                <div class="font-semibold mb-2">Follow Us On :</div>
                <div class="flex items-center gap-2 text-gray-600 text-sm">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><!-- Instagram icon --></svg>
                    Estetika.os
                </div>
            </div>
            <div>
                <div class="font-semibold mb-2">Contact Us On :</div>
                <div class="flex items-center gap-2 text-gray-600 text-sm">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><!-- WhatsApp icon --></svg>
                    WhatsApp
                </div>
            </div>
        </div>
        <div class="text-center text-gray-400 text-xs mt-4">Copyright Estetika.Os</div>
    </footer>
</div>
</x-layout> 