<x-layout-admin>
<div class="max-w-3xl mx-auto p-8 mt-8 bg-white border border-blue-200 rounded-xl">
    <a href="/admin/pesanan" class="text-blue-600 text-sm font-semibold mb-4 inline-block">&larr; Kembali ke Daftar Pesanan</a>
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6 flex items-center justify-between">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <span class="inline-block bg-blue-100 p-2 rounded-full"><svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2z" /></svg></span>
                <span class="text-xl font-bold">{{ $order->nama_proyek ?? '-' }}</span>
            </div>
            <div class="text-xs text-gray-500">ID: ORD-{{ str_pad($order->id, 3, '0', STR_PAD_LEFT) }}</div>
            <div class="text-xs text-gray-500 mt-1">Pelanggan: <span class="font-semibold">{{ $order->user->name ?? '-' }}</span></div>
        </div>
        <div class="flex flex-col items-end gap-2">
            <div class="text-xs text-gray-500">Deadline</div>
            <div class="font-semibold">{{ $order->tenggat ? \Carbon\Carbon::parse($order->tenggat)->format('d-m-Y') : '-' }}</div>
            <div class="text-xs text-gray-500 mt-2">Total</div>
            <div class="text-green-600 font-bold text-lg">Rp {{ number_format((float) $order->budget,0,',','.') }}</div>
            @php
                $statusLabel = [
                    'menunggu' => ['label' => 'Menunggu Konfirmasi', 'color' => 'bg-yellow-400 text-white'],
                    'menunggu pembayaran' => ['label' => 'Menunggu Pembayaran', 'color' => 'bg-blue-500 text-white'],
                    'diproses' => ['label' => 'Diproses', 'color' => 'bg-gray-700 text-white'],
                    'selesai' => ['label' => 'Selesai', 'color' => 'bg-green-600 text-white'],
                    'ditolak' => ['label' => 'Ditolak', 'color' => 'bg-red-500 text-white'],
                    'antrian' => ['label' => 'Antrian', 'color' => 'bg-gray-400 text-white'],
                ];
                $statusKey = strtolower($order->status ?? '');
                $label = $statusLabel[$statusKey]['label'] ?? ucfirst($order->status ?? 'Menunggu Konfirmasi');
                $color = $statusLabel[$statusKey]['color'] ?? 'bg-yellow-400 text-white';
            @endphp
            <span class="inline-block px-3 py-1 rounded {{ $color }} text-xs font-semibold mt-2">{{ $label }}</span>
        </div>
    </div>
    <div class="mb-6">
        <h3 class="font-semibold text-lg mb-2">Detail Pesanan</h3>
        <div class="mb-1">Jumlah: <span class="font-bold">{{ $order->kuantitas ?? '-' }} pieces</span></div>
        <div class="mb-1">Deskripsi: <span class="text-gray-700">{{ $order->deskripsi ?? '-' }}</span></div>
    </div>
    <form method="POST" action="/admin/pesanan/{{ $order->id }}" class="bg-gray-50 border border-gray-200 rounded-lg p-6">
        @csrf
        @method('PUT')
        <h3 class="font-semibold text-lg mb-4">Konfirmasi Status Pesanan</h3>
        <div class="flex flex-col gap-2 mb-4">
            <label class="flex items-center gap-2">
                <input type="radio" name="status" value="diterima" {{ in_array($order->status, ['diterima', 'menunggu pembayaran']) ? 'checked' : '' }}> <span class="text-green-700">Terima Pesanan (Menunggu Pembayaran)</span>
            </label>
            <label class="flex items-center gap-2">
                <input type="radio" name="status" value="diproses" {{ $order->status == 'diproses' ? 'checked' : '' }}> <span class="text-blue-700">Proses Pesanan</span>
            </label>
            <label class="flex items-center gap-2">
                <input type="radio" name="status" value="selesai" {{ $order->status == 'selesai' ? 'checked' : '' }}> <span class="text-green-600">Pesanan Selesai</span>
            </label>
            <label class="flex items-center gap-2">
                <input type="radio" name="status" value="ditolak" {{ $order->status == 'ditolak' ? 'checked' : '' }}> <span class="text-red-600">Tolak Pesanan</span>
            </label>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Catatan (Opsional)</label>
            <textarea name="catatan" class="w-full border rounded px-3 py-2" rows="3" placeholder="Tambahkan catatan untuk keputusan ini...">{{ $order->catatan ?? '' }}</textarea>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="px-6 py-2 rounded bg-[#1e335f] text-white font-semibold hover:bg-[#162547] transition">Simpan Perubahan</button>
            <a href="/admin/pesanan" class="px-6 py-2 rounded bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300 transition">Batal</a>
        </div>
        @if(session('success'))
            <div class="mt-4 text-green-600 font-semibold">{{ session('success') }}</div>
        @endif
    </form>
</div>
</x-layout-admin> 