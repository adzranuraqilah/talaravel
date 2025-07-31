<div class="w-64 min-h-screen bg-white border-r flex flex-col py-8 px-4">
    <div class="mb-8">
        <div class="text-xl font-bold text-gray-800 mb-2">Estetika.os</div>
        <div class="text-xs text-gray-400">Admin Dashboard</div>
    </div>
    <div class="flex-1">
        <div class="text-xs font-semibold text-gray-400 mb-2">MENU UTAMA</div>
        <ul class="space-y-1 mb-6">
            <li><a href="/admin/dashboard" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-100 {{ Request::is('admin/dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6m-6 0H7m6 0v6m0 0H7m6 0h6"/></svg>Dashboard</a></li>
            <li><a href="/admin/pesanan" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-100 {{ Request::is('admin/pesanan') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18v18H3V3z"/></svg>Pesanan</a></li>
            <li><a href="/admin/produk" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-100 {{ Request::is('admin/produk') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V7a2 2 0 00-2-2H6a2 2 0 00-2 2v6m16 0v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6m16 0H4"/></svg>Produk</a></li>
            <li><a href="/admin/pelanggan" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-100 {{ Request::is('admin/pelanggan') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1112 21a9 9 0 01-6.879-3.196z"/></svg>Pelanggan</a></li>
            <li><a href="/admin/laporan" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-100 {{ Request::is('admin/laporan') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a2 2 0 012-2h2a2 2 0 012 2v2m-6 0h6"/></svg>Laporan</a></li>
            <li><a href="/admin/produksi" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-100 {{ Request::is('admin/produksi') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17l4-4 4 4m0 0V3m0 14H4"/></svg>Jadwal Produksi</a></li>
            <li><a href="/admin/galeri" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-100 {{ Request::is('admin/galeri') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect width="20" height="14" x="2" y="5" rx="2"/><circle cx="8.5" cy="10.5" r="1.5"/><path d="M21 19l-5.5-5.5a2 2 0 00-2.8 0L7 19"/></svg>Galeri</a></li>
            <li><a href="/admin/preview-history" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-100 {{ Request::is('admin/preview-history') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>Foto Pratinjau</a></li>
        </ul>
        <div class="text-xs font-semibold text-gray-400 mb-2">LAINNYA</div>
        <ul class="space-y-1">
            <li><a href="/admin/pengaturan" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-100 {{ Request::is('admin/pengaturan') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"/></svg>Pengaturan</a></li>
            <li><a href="/admin/pricing-settings" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-100 {{ Request::is('admin/pricing-settings') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/></svg>Pengaturan Harga</a></li>
        </ul>
    </div>
    <div class="mt-auto flex flex-col gap-3 pt-8">
        <div class="flex items-center gap-3 text-xs text-gray-500">
            <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center"><svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="3"/></svg></div>
            <div>
                <div class="font-semibold text-gray-700">Admin</div>
                <div>admin@estetika.os</div>
            </div>
        </div>
        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="w-full mt-4 py-2 px-4 rounded bg-red-500 text-white font-semibold hover:bg-red-600 transition flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1"/></svg>
                Logout
            </button>
        </form>
    </div>
</div> 