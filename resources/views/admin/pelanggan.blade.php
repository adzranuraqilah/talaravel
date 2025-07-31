<x-layout-admin>
<div class="px-6 pt-6">
    <!-- Header & Search -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <div class="text-2xl font-bold text-gray-800">Pelanggan</div>
            <div class="text-gray-500 text-sm">Selamat datang di Admin Panel Konveksi Estetika.os</div>
        </div>
        <form method="GET">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari pelanggan..." class="w-72 px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-sm">
        </form>
    </div>
    <!-- Grid Pelanggan -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($pelanggan as $user)
        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
            <div class="flex items-center gap-4 mb-2">
                <div class="bg-blue-100 rounded-full p-3">
                    <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.847.607 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div>
                    <div class="font-semibold text-lg text-gray-800">{{ $user->name ?? 'Nama Pelanggan' }}</div>
                    <div class="text-gray-500 text-sm">CUST{{ str_pad($user->id, 3, '0', STR_PAD_LEFT) }}</div>
                </div>
            </div>
            <div class="mb-2">
                <div class="flex items-center text-gray-600 text-sm mb-1">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 01-8 0 4 4 0 018 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v7m0 0H9m3 0h3"/>
                    </svg>
                    {{ $user->email ?? '-' }}
                </div>
                <div class="flex items-center text-gray-600 text-sm mb-1">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.35 2.7A2 2 0 007.52 19h8.96a2 2 0 001.87-2.3L17 13M9 21h6"/>
                    </svg>
                    {{ $user->phone ?? '-' }}
                </div>
                <div class="flex items-center text-gray-600 text-sm">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 12.414a4 4 0 10-5.657 5.657l4.243 4.243a8 8 0 0011.314-11.314l-4.243-4.243a4 4 0 00-5.657 5.657l4.243 4.243z"/>
                    </svg>
                    {{ $user->alamat ?? '-' }}
                </div>
            </div>
            <hr class="my-3">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-lg font-semibold text-gray-700">{{ $user->total_pesanan ?? 0 }}</div>
                    <div class="text-xs text-gray-400">Total Pesanan</div>
                </div>
                <div class="text-right">
                    <div class="text-lg font-semibold text-blue-600">Rp {{ number_format($user->total_pembelian ?? 0, 0, ',', '.') }}</div>
                    <div class="text-xs text-gray-400">Total Pembelian</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</x-layout-admin>