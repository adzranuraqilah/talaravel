<x-layout-admin>
<div class="px-6 pt-6">
    <!-- Header & Search -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <div class="text-2xl font-bold text-gray-800">Laporan</div>
            <div class="text-gray-500 text-sm">Selamat datang di Admin Panel Konveksi Estetika.os</div>
        </div>
    </div>
    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white border border-gray-200 rounded-lg p-5 flex items-center gap-4">
            <div>
                <div class="text-xs text-gray-500 mb-1 flex items-center gap-1">
                    Penjualan Bulan Ini
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm0 0V4m0 8v8"/>
                    </svg>
                </div>
                <div class="text-xl font-bold text-gray-700">Rp {{ number_format($penjualanBulanIni ?? 0, 0, ',', '.') }}</div>
            </div>
        </div>
        <div class="bg-white border border-gray-200 rounded-lg p-5 flex items-center gap-4">
            <div>
                <div class="text-xs text-gray-500 mb-1 flex items-center gap-1">
                    Pesanan Bulan Ini
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.35 2.7A2 2 0 007.52 19h8.96a2 2 0 001.87-2.3L17 13M9 21h6"/>
                    </svg>
                </div>
                <div class="text-xl font-bold text-gray-700">{{ $pesananBulanIni ?? 0 }}</div>
            </div>
        </div>
        <div class="bg-white border border-gray-200 rounded-lg p-5 flex items-center gap-4">
            <div>
                <div class="text-xs text-gray-500 mb-1 flex items-center gap-1">
                    Pelanggan Baru
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.847.607 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div class="text-xl font-bold text-gray-700">{{ $pelangganBaru ?? 0 }}</div>
            </div>
        </div>
        <div class="bg-white border border-gray-200 rounded-lg p-5 flex items-center gap-4">
            <div>
                <div class="text-xs text-gray-500 mb-1 flex items-center gap-1">
                    Produk Terjual
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 21V7a2 2 0 00-2-2H6a2 2 0 00-2 2v14M9 17h6"/>
                    </svg>
                </div>
                <div class="text-xl font-bold text-gray-700">{{ $produkTerjual ?? 0 }}</div>
            </div>
        </div>
    </div>
    <!-- Tabel Laporan Penjualan -->
    <div class="bg-white border border-gray-200 rounded-xl p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
            <div class="text-lg font-semibold text-gray-800 mb-2 md:mb-0">Tabel Laporan Penjualan</div>
            <div class="flex gap-2">
                <!-- Hapus button tanggal mulai/akhir -->
            </div>
        </div>
        <form method="GET" class="flex gap-2 mb-4">
            <input type="date" name="tanggal_mulai" value="{{ request('tanggal_mulai', isset($start) ? $start->format('Y-m-d') : '') }}" class="border rounded px-3 py-2">
            <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir', isset($end) ? $end->format('Y-m-d') : '') }}" class="border rounded px-3 py-2">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Filter</button>
        </form>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b">
                        <th class="py-2 px-4 text-left text-gray-600 font-semibold">Tanggal</th>
                        <th class="py-2 px-4 text-left text-gray-600 font-semibold">Total Pelanggan</th>
                        <th class="py-2 px-4 text-left text-gray-600 font-semibold">Total Pesanan</th>
                        <th class="py-2 px-4 text-left text-gray-600 font-semibold">Total Penjualan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($laporan as $row)
                    <tr class="border-b last:border-0">
                        <td class="py-2 px-4">{{ $row['tanggal'] }}</td>
                        <td class="py-2 px-4">{{ $row['total_pelanggan'] }}</td>
                        <td class="py-2 px-4">{{ $row['total_pesanan'] }}</td>
                        <td class="py-2 px-4 text-green-600 font-semibold">Rp {{ number_format($row['total_penjualan'], 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="flex justify-end mt-6">
            <form method="GET" action="/admin/laporan/pdf" target="_blank">
                <input type="hidden" name="tanggal_mulai" value="{{ request('tanggal_mulai', isset($start) ? $start->format('Y-m-d') : '') }}">
                <input type="hidden" name="tanggal_akhir" value="{{ request('tanggal_akhir', isset($end) ? $end->format('Y-m-d') : '') }}">
                <button type="submit" class="flex items-center gap-2 bg-blue-900 text-white px-5 py-2 rounded-lg font-semibold hover:bg-blue-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Unduh PDF
                </button>
            </form>
        </div>
    </div>
</div>
</x-layout-admin>