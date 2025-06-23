<aside :class="{'-translate-x-full': !open, 'translate-x-0': open}" class="fixed z-30 inset-y-0 left-0 w-64 bg-white border-r border-gray-200 transform md:translate-x-0 transition-transform duration-200 ease-in-out flex flex-col min-h-screen md:static md:inset-auto md:translate-x-0">
    <div class="px-6 py-6 border-b border-gray-100">
        <div class="text-xl font-bold text-gray-800">Estetika.os</div>
        <div class="text-xs text-gray-400">Admin Dashboard</div>
    </div>
    <nav class="flex-1 px-2 py-4 overflow-y-auto">
        <div class="text-xs text-gray-400 mb-2 mt-2 tracking-widest">MENU UTAMA</div>
        <ul class="space-y-1">
            <li><a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg bg-blue-100 text-blue-700 font-medium"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5v6h6"/></svg>Dashboard</a></li>
            <li><a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"/></svg>Pesanan</a></li>
            <li><a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.8 7.6l-8.8 8.8-4.8-4.8"/></svg>Produk</a></li>
            <li><a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M16 3.13a4 4 0 010 7.75M8 3.13a4 4 0 010 7.75"/></svg>Pelanggan</a></li>
            <li><a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18v18H3V3zm3 3v12h12V6H6z"/></svg>Laporan</a></li>
            <li><a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 2v4M8 2v4M3 10h18"/></svg>Jadwal Produksi</a></li>
        </ul>
        <div class="text-xs text-gray-400 mb-2 mt-6 tracking-widest">LAINNYA</div>
        <ul class="space-y-1">
            <li><a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 01-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09a1.65 1.65 0 00-1-1.51 1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09a1.65 1.65 0 001.51-1 1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06a1.65 1.65 0 001.82.33h.09a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51h.09a1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06a1.65 1.65 0 00-.33 1.82v.09a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/></svg>Pengaturan</a></li>
        </ul>
    </nav>
    <div class="mt-auto px-6 py-4 border-t border-gray-100 flex items-center gap-3">
        <span class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-400"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 10a4 4 0 100-8 4 4 0 000 8zm0 2c-4 0-6 2-6 4v1a1 1 0 001 1h10a1 1 0 001-1v-1c0-2-2-4-6-4z"/></svg></span>
        <div>
            <div class="text-sm font-semibold text-gray-700">Admin</div>
            <div class="text-xs text-gray-400">admin@estetika.os</div>
        </div>
    </div>
</aside> 