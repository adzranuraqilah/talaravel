<x-layout>
<div class="max-w-4xl mx-auto p-6 bg-white border border-gray-300 rounded-2xl mt-6">
    <!-- Profile Header -->
    <div class="flex items-center gap-6 mb-8">
        <div>
            <span class="w-20 h-20 rounded-full bg-blue-200 flex items-center justify-center text-4xl text-blue-400">
                <svg class="w-16 h-16 text-blue-300" fill="currentColor" viewBox="0 0 20 20"><path d="M10 10a4 4 0 100-8 4 4 0 000 8zm0 2c-4 0-6 2-6 4v1a1 1 0 001 1h10a1 1 0 001-1v-1c0-2-2-4-6-4z"/></svg>
            </span>
        </div>
        <div class="flex-1">
            <div class="text-2xl font-bold text-gray-900">NAMA PELANGGAN</div>
            <div class="text-gray-700">Email Pelanggan</div>
            <div class="text-gray-700">No. Telpon Pelanggan</div>
        </div>
        <div>
            <button class="px-5 py-2 rounded-md bg-[#1e335f] text-white font-semibold hover:bg-[#162547] transition">Edit Akun</button>
        </div>
    </div>
    <!-- Aktivitas -->
    <div class="flex gap-4 mb-8">
        <div class="flex-1 bg-gray-50 border border-gray-300 rounded-lg p-4 text-center">
            <div class="text-2xl font-bold">0</div>
            <div class="text-gray-700 text-sm">Tender Diajukan</div>
        </div>
        <div class="flex-1 bg-gray-50 border border-gray-300 rounded-lg p-4 text-center">
            <div class="text-2xl font-bold">0</div>
            <div class="text-gray-700 text-sm">Tender Diterima</div>
        </div>
        <div class="flex-1 bg-gray-50 border border-gray-300 rounded-lg p-4 text-center">
            <div class="text-2xl font-bold">0</div>
            <div class="text-gray-700 text-sm">Tender Selesai</div>
        </div>
        <div class="flex-1 bg-gray-50 border border-gray-300 rounded-lg p-4 text-center">
            <div class="text-2xl font-bold">0</div>
            <div class="text-gray-700 text-sm">Tender Selesai</div>
        </div>
    </div>
    <!-- Riwayat Pesanan -->
    <div class="mb-2 text-lg font-semibold text-gray-800">Riwayat Pesanan</div>
    <div class="space-y-4">
        <!-- Card 1: Menunggu Konfirmasi -->
        <div class="bg-gray-100 border border-gray-300 rounded-lg p-4 relative">
            <div class="font-bold text-base mb-1">Nama Proyek
                <span class="absolute top-4 right-4 bg-yellow-400 text-white text-xs font-semibold px-3 py-1 rounded">Menunggu Konfirmasi</span>
            </div>
            <div class="text-sm text-gray-700">Tanggal Pengajuan :<br>Jumlah :<br>Harga :<br>Detail Pesanan :</div>
            <div class="flex justify-end mt-4">
                <a href="#" class="px-4 py-1 rounded bg-[#1e335f] text-white text-sm font-semibold hover:bg-[#162547] transition">Lihat Detail</a>
            </div>
        </div>
        <!-- Card 2: Pesanan Diproses -->
        <div class="bg-gray-100 border border-gray-300 rounded-lg p-4 relative">
            <div class="font-bold text-base mb-1">Nama Proyek
                <span class="absolute top-4 right-4 bg-gray-600 text-white text-xs font-semibold px-3 py-1 rounded">Pesanan Diproses</span>
            </div>
            <div class="text-sm text-gray-700">Tanggal Pengajuan :<br>Jumlah :<br>Harga :<br>Detail Pesanan :</div>
            <div class="flex justify-end mt-4">
                <a href="#" class="px-4 py-1 rounded bg-[#1e335f] text-white text-sm font-semibold hover:bg-[#162547] transition">Lihat Detail</a>
            </div>
        </div>
        <!-- Card 3: Ditolak -->
        <div class="bg-gray-100 border border-gray-300 rounded-lg p-4 relative">
            <div class="font-bold text-base mb-1">Nama Proyek
                <span class="absolute top-4 right-4 bg-red-500 text-white text-xs font-semibold px-3 py-1 rounded">Ditolak</span>
            </div>
            <div class="text-sm text-gray-700">Tanggal Pengajuan :<br>Jumlah :<br>Harga :<br>Detail Pesanan :</div>
            <div class="flex justify-end mt-4">
                <a href="#" class="px-4 py-1 rounded bg-[#1e335f] text-white text-sm font-semibold hover:bg-[#162547] transition">Lihat Detail</a>
            </div>
        </div>
        <!-- Card 4: Selesai -->
        <div class="bg-gray-100 border border-gray-300 rounded-lg p-4 relative">
            <div class="font-bold text-base mb-1">Nama Proyek
                <span class="absolute top-4 right-4 bg-green-600 text-white text-xs font-semibold px-3 py-1 rounded">Selesai</span>
            </div>
            <div class="text-sm text-gray-700">Tanggal Pengajuan :<br>Jumlah :<br>Harga :<br>Detail Pesanan :</div>
            <div class="flex justify-end mt-4">
                <a href="#" class="px-4 py-1 rounded bg-[#1e335f] text-white text-sm font-semibold hover:bg-[#162547] transition">Lihat Detail</a>
            </div>
        </div>
    </div>
</div>
</x-layout> 