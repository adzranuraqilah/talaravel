<x-layout>
<div class="max-w-5xl mx-auto py-10 px-4">
    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-2">Desain Pakaian Sesuai Keinginan</h1>
        <p class="text-gray-700 text-base">Buat pesanan pakaian dengan desain dan spesifikasi kebutuhan anda</p>
    </div>
    <!-- Main Content -->
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Sidebar Menu (2 kolom) -->
        <div class="flex flex-row h-[370px]">
            <!-- Sidebar Left (active) -->
            <div class="bg-[#d1d1d6] w-48 rounded-l-2xl flex flex-col justify-center py-8 pl-8 space-y-8">
                <div class="flex items-center gap-4">
                    <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 7l4-4h8l4 4v13a2 2 0 01-2 2H6a2 2 0 01-2-2V7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 21V9h6v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <span class="text-base text-gray-800">Jenis Produk</span>
                </div>
                <div class="flex items-center gap-4">
                    <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 16v-8m0 0l-4 4m4-4l4 4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><rect x="4" y="4" width="16" height="16" rx="2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <span class="text-base text-gray-800">Unggah</span>
                </div>
                <div class="flex items-center gap-4">
                    <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2"/><path d="M7 12h10" stroke-width="2" stroke-linecap="round"/><path d="M12 7v10" stroke-width="2" stroke-linecap="round"/></svg>
                    <span class="text-base text-gray-800">Warna</span>
                </div>
                <div class="flex items-center gap-4">
                    <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><text x="2" y="20" font-size="20" font-family="Arial" fill="black">Aa</text></svg>
                    <span class="text-base text-gray-800">Teks</span>
                </div>
            </div>
            <!-- Sidebar Right (step list) -->
            <div class="bg-white w-48 rounded-r-2xl flex flex-col justify-center py-8 pl-8 space-y-8 border-l border-gray-300">
                <div class="flex items-center gap-4">
                    <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 7l4-4h8l4 4v13a2 2 0 01-2 2H6a2 2 0 01-2-2V7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 21V9h6v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <span class="text-base text-gray-800">Jenis Produk</span>
                </div>
                <div class="flex items-center gap-4">
                    <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2"/><path d="M7 12h10" stroke-width="2" stroke-linecap="round"/><path d="M12 7v10" stroke-width="2" stroke-linecap="round"/></svg>
                    <span class="text-base text-gray-800">Warna</span>
                </div>
                <div class="flex items-center gap-4">
                    <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 16v-8m0 0l-4 4m4-4l4 4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><rect x="4" y="4" width="16" height="16" rx="2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <span class="text-base text-gray-800">Unggah</span>
                </div>
                <div class="flex items-center gap-4">
                    <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><text x="2" y="20" font-size="20" font-family="Arial" fill="black">Aa</text></svg>
                    <span class="text-base text-gray-800">Teks</span>
                </div>
            </div>
        </div>
        <!-- Preview Area -->
        <div class="flex-1 flex flex-col items-center">
            <div class="w-full h-[350px] bg-gray-100 rounded-lg flex items-center justify-center">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6 1a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="text-center text-gray-500 mt-2">Pratinjau</div>
        </div>
    </div>
    <!-- Footer Buttons -->
    <div class="flex justify-end gap-4 mt-10">
        <button class="px-8 py-2 rounded-md bg-red-600 text-white font-semibold hover:bg-red-700 transition">Batal</button>
        <button class="px-8 py-2 rounded-md bg-[#1e335f] text-white font-semibold hover:bg-[#162547] transition">Lanjut</button>
    </div>
</div>
</x-layout> 