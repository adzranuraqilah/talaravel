<x-layout>
<div class="max-w-3xl mx-auto py-6 px-2">
    <!-- Header -->
    <div class="flex items-center mb-2">
        <button class="mr-2 p-2 rounded hover:bg-gray-100 transition">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <div>
            <div class="text-lg font-semibold text-gray-800 leading-tight">Detail Pesanan #1</div>
            <div class="text-gray-400 text-xs">Informasi lengkap pesanan Anda</div>
        </div>
        <div class="flex-1"></div>
        <span class="px-3 py-0.5 rounded-full bg-blue-100 text-blue-600 text-xs font-semibold ml-2">Menunggu Pembayaran</span>
    </div>
    <!-- Informasi Pesanan -->
    <div class="bg-white border border-gray-200 rounded-xl p-6 mt-3 mb-6">
        <div class="flex items-center mb-4">
            <svg class="w-5 h-5 text-gray-700 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span class="text-base font-semibold text-gray-800">Informasi Pesanan</span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <div class="text-gray-500 text-sm mb-0.5">Nama Customer:</div>
                <div class="text-gray-800 text-sm mb-2">Nama</div>
                <div class="text-gray-500 text-sm mb-0.5">Email:</div>
                <div class="text-gray-800 text-sm">email</div>
            </div>
            <div class="flex flex-col gap-2 mt-2 md:mt-0">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span class="text-gray-500 text-sm">Tanggal Pengajuan:</span>
                    <span class="text-gray-800 text-sm">hh/bb/tttt</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V7a2 2 0 00-2-2H6a2 2 0 00-2 2v6"/><circle cx="12" cy="17" r="2"/></svg>
                    <span class="text-gray-500 text-sm">Jumlah:</span>
                    <span class="text-gray-800 text-sm">0 Pcs</span>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <div class="text-gray-500 text-sm mb-1">Detail Pesanan</div>
            <div class="text-blue-400 text-sm">Lorem ipsum</div>
        </div>
    </div>
    <!-- Informasi Pembayaran -->
    <div class="bg-white border border-gray-200 rounded-xl p-6 mb-6">
        <div class="flex items-center mb-4">
            <svg class="w-5 h-5 text-gray-700 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-4.418 0-8 1.79-8 4v4a2 2 0 002 2h12a2 2 0 002-2v-4c0-2.21-3.582-4-8-4z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8V4m0 0a4 4 0 014 4"/></svg>
            <span class="text-base font-semibold text-gray-800">Informasi Pembayaran</span>
        </div>
        <div class="bg-gray-50 rounded-lg p-4 mb-4">
            <div class="text-gray-500 text-sm mb-1">Total Pembayaran:</div>
            <div class="text-xl font-bold text-gray-800">Rp 0</div>
        </div>
        <button class="w-full py-3 rounded-lg bg-green-600 text-white font-semibold text-base hover:bg-green-700 transition">Bayar Rp 0</button>
    </div>
</div>
</x-layout> 