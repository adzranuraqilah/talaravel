<x-layout-admin>
<div class="px-6 pt-6">
    <!-- Header & Search -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
        <div>
            <div class="text-2xl font-bold text-gray-800">Edit Pesanan</div>
            <div class="text-gray-500 text-sm">Konfirmasi status penerimaan pesanan</div>
        </div>
    </div>
    <!-- Back Link -->
    <div class="mb-4">
        <a href="/admin/pesanan" class="flex items-center text-blue-600 hover:underline text-sm">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Daftar Pesanan
        </a>
    </div>
    <!-- Card Pesanan -->
    <div class="bg-white border border-gray-200 rounded-xl p-6 flex items-center justify-between mb-4">
        <div class="flex items-center gap-4">
            <div class="bg-blue-50 rounded-lg p-3">
                <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.35 2.7A2 2 0 007.52 19h8.96a2 2 0 001.87-2.3L17 13M9 21h6"/>
                </svg>
            </div>
            <div>
                <div class="font-semibold text-base">Pesanan</div>
                <div class="text-gray-500 text-sm">KODE PESANAN</div>
                <div class="flex items-center gap-6 mt-2 text-sm text-gray-500">
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.847.607 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Pelanggan <span class="ml-1 text-gray-700">Lorem Ipsum</span>
                    </span>
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Deadline <span class="ml-1 text-gray-700">hh-bb-tttt</span>
                    </span>
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm0 0V4m0 8v8"/>
                        </svg>
                        Total <span class="ml-1 text-green-600 font-semibold">Rp 0</span>
                    </span>
                </div>
            </div>
        </div>
        <div>
            <span class="bg-yellow-400 text-white text-xs font-semibold px-4 py-1 rounded">Pending</span>
        </div>
    </div>
    <!-- Detail Pesanan -->
    <div class="bg-white border border-gray-200 rounded-xl p-6 mb-4">
        <div class="font-semibold text-lg mb-2 flex items-center gap-2">
            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 014-4h3m4 0a4 4 0 00-4-4H7a4 4 0 00-4 4v4a4 4 0 004 4h1"/>
            </svg>
            Detail Pesanan
        </div>
        <div class="text-sm text-gray-500 mb-1">Jumlah</div>
        <div class="mb-2 text-gray-700">0 pieces</div>
        <div class="text-sm text-gray-500 mb-1">Deskripsi</div>
        <div class="text-gray-700">Lorem Ipsum</div>
    </div>
    <!-- Konfirmasi Status Pesanan -->
    <div class="bg-white border border-gray-200 rounded-xl p-6 mb-8">
        <div class="font-semibold text-lg mb-4">Konfirmasi Status Pesanan</div>
        <form>
            <div class="mb-4">
                <div class="text-sm font-medium mb-2">Pilih Status Pesanan:</div>
                <div class="flex flex-col gap-2">
                    <label class="flex items-center gap-2">
                        <input type="radio" name="status" class="form-radio text-green-600" value="terima">
                        <span class="text-gray-700">Terima Pesanan</span>
                    </label>
                    <label class="flex items-center gap-2">
                        <input type="radio" name="status" class="form-radio text-red-600" value="tolak">
                        <span class="text-red-600">Tolak Pesanan</span>
                    </label>
                    <label class="flex items-center gap-2">
                        <input type="radio" name="status" class="form-radio text-yellow-500" value="selesai">
                        <span class="text-yellow-600">Pesanan Selesai</span>
                    </label>
                </div>
            </div>
            <div class="mb-4">
                <div class="text-sm font-medium mb-2">Catatan (Opsional)</div>
                <textarea class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f]" rows="3" placeholder="Tambahkan catatan untuk keputusan ini..."></textarea>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="bg-blue-900 text-white px-5 py-2 rounded-lg font-semibold hover:bg-blue-800">Simpan Perubahan</button>
                <a href="/admin/pesanan" class="px-5 py-2 rounded-lg border border-gray-300 text-gray-700 font-semibold hover:bg-gray-100">Batal</a>
            </div>
        </form>
    </div>
</div>
</x-layout-admin>