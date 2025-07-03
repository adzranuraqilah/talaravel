<x-layout-admin>
<div class="px-6 pt-6">
    <!-- Header & Search -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <div class="text-3xl font-bold text-gray-800">Jadwalkan Produksi</div>
            <div class="text-gray-500 text-base">Buat jadwal produksi untuk pesanan</div>
        </div>
    </div>
    <!-- Back Link -->
    <div class="mb-4">
        <a href="/admin/produksi" class="flex items-center text-blue-600 hover:underline text-sm">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Jadwal Produksi
        </a>
    </div>
    <!-- Form Card -->
    <div class="bg-white border border-gray-200 rounded-xl p-8 max-w-2xl mx-auto">
        <div class="flex items-center gap-2 mb-6">
            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <rect x="3" y="4" width="18" height="18" rx="2"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 2v4M8 2v4M3 10h18"/>
            </svg>
            <span class="text-lg font-semibold text-gray-700">Informasi Jadwal Produksi</span>
        </div>
        <form>
            <!-- Kode Pesanan -->
            <div class="mb-4">
                <label class="block text-gray-700 mb-1">Kode Pesanan</label>
                <input type="text" placeholder="Pilih pesanan" class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-sm" />
            </div>
            <!-- Tanggal Mulai & Target Selesai -->
            <div class="flex flex-col md:flex-row gap-4 mb-4">
                <div class="w-full">
                    <label class="block text-gray-700 mb-1">Tanggal Mulai</label>
                    <div class="relative">
                        <input type="text" placeholder="mm/dd/yyyy" class="w-full border border-gray-200 rounded-lg px-4 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-sm" />
                        <span class="absolute right-3 top-2.5 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="w-full">
                    <label class="block text-gray-700 mb-1">Target Selesai</label>
                    <div class="relative">
                        <input type="text" placeholder="mm/dd/yyyy" class="w-full border border-gray-200 rounded-lg px-4 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-sm" />
                        <span class="absolute right-3 top-2.5 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
            <!-- Pilih Produk -->
            <div class="mb-4">
                <label class="block text-gray-700 mb-1">Pesanan</label>
                <select class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-sm">
                    <option>Pilih produk</option>
                </select>
            </div>
            <!-- Kuantitas -->
            <div class="mb-4">
                <label class="block text-gray-700 mb-1">Kuantitas</label>
                <input type="number" min="0" value="0" class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-sm" />
            </div>
            <!-- Detail Pesanan -->
            <div class="mb-6">
                <label class="block text-gray-700 mb-1">Detail Pesanan</label>
                <textarea class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f]" rows="3" placeholder="Catatan khusus untuk tim produksi..."></textarea>
            </div>
            <!-- Tombol -->
            <div class="flex gap-2">
                <button type="submit" class="bg-blue-900 text-white px-5 py-2 rounded-lg font-semibold hover:bg-blue-800 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Jadwalkan Produksi
                </button>
                <a href="/admin/produksi" class="px-5 py-2 rounded-lg border border-gray-300 text-gray-700 font-semibold hover:bg-gray-100">Batal</a>
            </div>
        </form>
    </div>
</div>
</x-layout-admin>