<x-layout-admin>
<div class="px-6 pt-6">
    <!-- Header & Search -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <div class="text-2xl font-bold text-gray-800">Pesanan</div>
            <div class="text-gray-500 text-sm">Selamat datang di Admin Panel Konveksi Estetika.os</div>
        </div>
        <div>
            <input type="text" placeholder="Cari pesanan, produk..." class="w-72 px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-sm">
        </div>
    </div>
    <!-- Daftar Pesanan -->
    <div class="bg-white border border-gray-200 rounded-xl p-6">
        <div class="text-xl font-semibold mb-4">Daftar Pesanan</div>
        <div class="space-y-4">
            <!-- Pesanan 1 -->
            <div class="flex items-center justify-between  border rounded-lg p-4">
                <div class="flex items-center gap-4">
                    <div class="bg-white rounded-lg p-2 shadow">
                        <!-- Ikon keranjang -->
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.35 2.7A2 2 0 007.52 19h8.96a2 2 0 001.87-2.3L17 13M9 21h6"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-semibold text-base">KODE PESANAN</div>
                        <div class="flex items-center gap-2 text-sm text-gray-500">
                            <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.847.607 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>Nama Pelanggan</span>
                            <span>• Pesanan</span>
                            <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>dd-mm-yyyy</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="text-right">
                        <div class="font-semibold text-gray-700">Rp 0</div>
                        <div class="text-xs text-gray-400">0 pcs</div>
                    </div>
                    <span class="bg-yellow-400 text-white text-xs font-semibold px-3 py-1 rounded">Menunggu</span>
                    <a href="/admin/pesanan-edit" class="text-gray-500 hover:text-blue-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg></a>
                </div>
            </div>
            <!-- Pesanan 2 -->
            <div class="flex items-center justify-between  border rounded-lg p-4">
                <div class="flex items-center gap-4">
                    <div class="bg-white rounded-lg p-2 shadow">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.35 2.7A2 2 0 007.52 19h8.96a2 2 0 001.87-2.3L17 13M9 21h6"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-semibold text-base">KODE PESANAN</div>
                        <div class="flex items-center gap-2 text-sm text-gray-500">
                            <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.847.607 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>Nama Pelanggan</span>
                            <span>• Pesanan</span>
                            <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>dd-mm-yyyy</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="text-right">
                        <div class="font-semibold text-gray-700">Rp 0</div>
                        <div class="text-xs text-gray-400">0 pcs</div>
                    </div>
                    <span class="bg-green-700 text-white text-xs font-semibold px-3 py-1 rounded">Selesai</span>
                    <a href="/admin/pesanan-edit" class="text-gray-500 hover:text-blue-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg></a>
                </div>
            </div>
            <!-- Tambahkan pesanan lain sesuai kebutuhan, ganti badge status dan warna -->
        </div>
    </div>
</div>
</x-layout-admin>