<x-layout-admin>
<div class="container mx-auto p-0 m-0">
    <!-- Header & Search -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <div class="text-2xl font-bold text-gray-800">Dashboard</div>
            <div class="text-gray-500 text-sm">Selamat datang di Admin Panel Konveksi Estetika.os</div>
        </div>
        <div>
            <input type="text" placeholder="Cari pesanan, produk..." class="w-72 px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-sm">
        </div>
    </div>
    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white border border-gray-300 rounded-lg p-6 text-center">
            <div class="text-sm text-gray-500 mb-1">Total Pesanan</div>
            <div class="text-3xl font-bold">0</div>
        </div>
        <div class="bg-white border border-gray-300 rounded-lg p-6 text-center">
            <div class="text-sm text-gray-500 mb-1">Pelanggan</div>
            <div class="text-3xl font-bold">0</div>
        </div>
        <div class="bg-white border border-gray-300 rounded-lg p-6 text-center">
            <div class="text-sm text-gray-500 mb-1">Pendapatan</div>
            <div class="text-3xl font-bold">Rp. 0</div>
        </div>
    </div>
    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Pesanan Terbaru -->
        <div class="lg:col-span-2">
            <div class="bg-white border border-gray-300 rounded-lg p-6">
                <div class="font-semibold text-lg mb-4">Pesanan Terbaru</div>
                <div class="space-y-3">
                    <div class="bg-gray-100 rounded-lg p-4 flex items-center justify-between">
                        <div>
                            <div class="font-semibold text-sm">Kode Pesanan</div>
                            <div class="text-xs text-gray-600">Nama Pelanggan</div>
                            <div class="text-xs text-gray-400">Kategori Produk . Kuantitas</div>
                        </div>
                        <div class="flex flex-col items-end gap-2">
                            <span class="bg-gray-600 text-white text-xs font-semibold px-3 py-1 rounded">Produksi</span>
                            <span class="flex items-center gap-1 text-xs text-gray-400"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>dd/mm/yyyy</span>
                        </div>
                    </div>
                    <div class="bg-gray-100 rounded-lg p-4 flex items-center justify-between">
                        <div>
                            <div class="font-semibold text-sm">Kode Pesanan</div>
                            <div class="text-xs text-gray-600">Nama Pelanggan</div>
                            <div class="text-xs text-gray-400">Kategori Produk . Kuantitas</div>
                        </div>
                        <div class="flex flex-col items-end gap-2">
                            <span class="bg-green-500 text-white text-xs font-semibold px-3 py-1 rounded">Selesai</span>
                            <span class="flex items-center gap-1 text-xs text-gray-400"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>dd/mm/yyyy</span>
                        </div>
                    </div>
                    <div class="bg-gray-100 rounded-lg p-4 flex items-center justify-between">
                        <div>
                            <div class="font-semibold text-sm">Kode Pesanan</div>
                            <div class="text-xs text-gray-600">Nama Pelanggan</div>
                            <div class="text-xs text-gray-400">Kategori Produk . Kuantitas</div>
                        </div>
                        <div class="flex flex-col items-end gap-2">
                            <span class="bg-yellow-400 text-white text-xs font-semibold px-3 py-1 rounded">Menunggu</span>
                            <span class="flex items-center gap-1 text-xs text-gray-400"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>dd/mm/yyyy</span>
                        </div>
                    </div>
                    <div class="bg-gray-100 rounded-lg p-4 flex items-center justify-between">
                        <div>
                            <div class="font-semibold text-sm">Kode Pesanan</div>
                            <div class="text-xs text-gray-600">Nama Pelanggan</div>
                            <div class="text-xs text-gray-400">Kategori Produk . Kuantitas</div>
                        </div>
                        <div class="flex flex-col items-end gap-2">
                            <span class="bg-red-500 text-white text-xs font-semibold px-3 py-1 rounded">Ditolak</span>
                            <span class="flex items-center gap-1 text-xs text-gray-400"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>dd/mm/yyyy</span>
                        </div>
                    </div>
                    <div class="bg-gray-100 rounded-lg p-4 flex items-center justify-between">
                        <div>
                            <div class="font-semibold text-sm">Kode Pesanan</div>
                            <div class="text-xs text-gray-600">Nama Pelanggan</div>
                            <div class="text-xs text-gray-400">Kategori Produk . Kuantitas</div>
                        </div>
                        <div class="flex flex-col items-end gap-2">
                            <span class="bg-gray-600 text-white text-xs font-semibold px-3 py-1 rounded">Produksi</span>
                            <span class="flex items-center gap-1 text-xs text-gray-400"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>dd/mm/yyyy</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Status Pesanan -->
        <div>
            <div class="bg-white border border-gray-300 rounded-lg p-6">
                <div class="font-semibold text-lg mb-4">Status Pesanan</div>
                <div class="flex flex-col gap-3">
                    <div class="flex items-center justify-between text-sm text-gray-700">
                        <span>Dalam Antrian</span>
                        <span class="font-bold">0</span>
                    </div>
                    <div class="flex items-center justify-between text-sm text-gray-700">
                        <span>Sedang Produksi</span>
                        <span class="font-bold">0</span>
                    </div>
                    <div class="flex items-center justify-between text-sm text-gray-700">
                        <span>Siap Kirim</span>
                        <span class="font-bold">0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-layout-admin> 