<x-layout-admin>
<div class="px-6 pt-6">
    <!-- Header & Search -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <div class="text-2xl font-bold text-gray-800">Jadwal Produksi</div>
            <div class="text-gray-500 text-sm">Selamat datang di Admin Panel Konveksi Estetika.os</div>
        </div>
        <div>
            <input type="text" placeholder="Cari pesanan, produk..." class="w-72 px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-sm">
        </div>
    </div>
    <!-- Filter Tanggal -->
    <div class="mb-4">
        <button class="flex items-center gap-2 px-4 py-2 border border-gray-200 rounded-lg text-gray-600 bg-gray-50 hover:bg-gray-100 text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            hh/bb/tttt
        </buttond>
    </div>
    <!-- Statistik Produksi -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white border border-gray-200 rounded-lg p-5 flex items-center gap-4">
            <div class="bg-blue-100 rounded-full p-2">
                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/>
                    <polygon points="10,8 16,12 10,16" fill="currentColor"/>
                </svg>
            </div>
            <div>
                <div class="text-xs text-gray-500 mb-1">Sedang Berlangsung</div>
                <div class="text-xl font-bold text-gray-700">0</div>
            </div>
        </div>
        <div class="bg-white border border-gray-200 rounded-lg p-5 flex items-center gap-4">
            <div class="bg-yellow-100 rounded-full p-2">
                <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/>
                    <path d="M12 6v6l4 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div>
                <div class="text-xs text-gray-500 mb-1">Terjadwal</div>
                <div class="text-xl font-bold text-gray-700">0</div>
            </div>
        </div>
        <div class="bg-white border border-gray-200 rounded-lg p-5 flex items-center gap-4">
            <div class="bg-gray-100 rounded-full p-2">
                <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/>
                    <path d="M12 8v4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <circle cx="12" cy="16" r="1" fill="currentColor"/>
                </svg>
            </div>
            <div>
                <div class="text-xs text-gray-500 mb-1">Pending</div>
                <div class="text-xl font-bold text-gray-700">0</div>
            </div>
        </div>
        <div class="bg-white border border-gray-200 rounded-lg p-5 flex items-center gap-4">
            <div class="bg-green-100 rounded-full p-2">
                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/>
                    <path d="M9 12l2 2 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div>
                <div class="text-xs text-gray-500 mb-1">Selesai Bulan Ini</div>
                <div class="text-xl font-bold text-gray-700">0</div>
            </div>
        </div>
    </div>
    <!-- Jadwal Produksi Aktif -->
    <div class="bg-white border border-gray-200 rounded-xl p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
            <div class="text-lg font-semibold text-gray-800 mb-2 md:mb-0">Jadwal Produksi Aktif</div>
            <a href="/admin/produksi-tambah" class="flex items-center gap-2 px-4 py-2 border border-gray-200 rounded-lg text-gray-600 bg-gray-50 hover:bg-gray-100 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Jadwalkan Produksi
            </a>
        </div>
        <div class="space-y-4">
            <!-- Jadwal 1 -->
            <a href="/admin/produksi-edit" class="block">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between bg-gray-50 border border-gray-100 rounded-lg p-4 hover:bg-gray-200 cursor-pointer transition">
                    <div>
                        <div class="font-semibold text-base">KODE PESANAN</div>
                        <div class="flex items-center gap-2 text-sm text-gray-500">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.847.607 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Nama Pelanggan
                            </span>
                            <span>• Pesanan</span>
                        </div>
                    </div>
                    <div class="flex flex-col md:items-end gap-2 mt-2 md:mt-0">
                        <div class="text-sm text-gray-700">hh-bb-tttt - hh-bb-tttt</div>
                        <div class="text-xs text-gray-400">Timeline produksi</div>
                    </div>
                    <span class="bg-gray-500 text-white text-xs font-semibold px-3 py-1 rounded">Diproses</span>
                </div>
            </a>
            <!-- Jadwal 2 -->
            <a href="/admin/produksi-edit" class="block">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between bg-gray-50 border border-gray-100 rounded-lg p-4 hover:bg-gray-200 cursor-pointer transition">
                    <div>
                        <div class="font-semibold text-base">KODE PESANAN</div>
                        <div class="flex items-center gap-2 text-sm text-gray-500">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.847.607 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Nama Pelanggan
                            </span>
                            <span>• Pesanan</span>
                        </div>
                    </div>
                    <div class="flex flex-col md:items-end gap-2 mt-2 md:mt-0">
                        <div class="text-sm text-gray-700">hh-bb-tttt - hh-bb-tttt</div>
                        <div class="text-xs text-gray-400">Timeline produksi</div>
                    </div>
                    <span class="bg-green-600 text-white text-xs font-semibold px-3 py-1 rounded">Selesai</span>
                </div>
            </a>
            <!-- Jadwal 3 -->
            <a href="/admin/produksi-edit" class="block">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between bg-gray-50 border border-gray-100 rounded-lg p-4 hover:bg-gray-200 cursor-pointer transition">
                    <div>
                        <div class="font-semibold text-base">KODE PESANAN</div>
                        <div class="flex items-center gap-2 text-sm text-gray-500">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.847.607 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Nama Pelanggan
                            </span>
                            <span>• Pesanan</span>
                        </div>
                    </div>
                    <div class="flex flex-col md:items-end gap-2 mt-2 md:mt-0">
                        <div class="text-sm text-gray-700">hh-bb-tttt - hh-bb-tttt</div>
                        <div class="text-xs text-gray-400">Timeline produksi</div>
                    </div>
                    <span class="bg-green-600 text-white text-xs font-semibold px-3 py-1 rounded">Selesai</span>
                </div>
            </a>
        </div>
    </div>
</div>
</x-layout-admin>