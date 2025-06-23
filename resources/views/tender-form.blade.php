<x-layout>
    <div class="max-w-xl mx-auto p-8 bg-white border border-gray-300 rounded-2xl mt-6" style="box-shadow:none;">
        <div class="text-center mb-6">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Ajukan Tender</h2>
            <p class="text-gray-700 text-base">Isi Form Berikut Untuk Mengajukan Tender Anda</p>
        </div>
        <form class="space-y-5">
            <!-- Nama Proyek -->
            <div>
                <label class="block text-base font-medium text-gray-800 mb-1">Nama Proyek</label>
                <input type="text" placeholder="Masukkan Proyek Anda" class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-base">
            </div>
            <!-- Deskripsi Produk -->
            <div>
                <label class="block text-base font-medium text-gray-800 mb-1">Deskripsi Produk</label>
                <textarea rows="3" placeholder="Masukkan Deskripsi Produk Anda" class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-base"></textarea>
            </div>
            <!-- Kuantitas -->
            <div>
                <label class="block text-base font-medium text-gray-800 mb-1">Kuantitas</label>
                <input type="number" placeholder="Masukkan Kuantitas" class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-base">
                <p class="text-xs text-gray-500 mt-1">Pembelian Min. 24 Pcs</p>
            </div>
            <!-- Tenggat Waktu -->
            <div>
                <label class="block text-base font-medium text-gray-800 mb-1">Tenggat Waktu</label>
                <div class="relative">
                    <input type="date" placeholder="dd/mm/yyyy" class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-base pr-10">
                    
                </div>
            </div>
            <!-- Budget -->
            <div>
                <label class="block text-base font-medium text-gray-800 mb-1">Budget</label>
                <input type="text" placeholder="Masukkan Budget Anda" class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-base">
            </div>
            <!-- Upload Desain -->
            <div>
                <label class="block text-base font-medium text-gray-800 mb-1 flex items-center gap-1">
                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                    </svg>
                    Desain
                </label>
                <label class="block cursor-pointer border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:bg-gray-50 transition">
                    <div class="flex flex-col items-center justify-center">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
                        <span class="text-gray-400 mt-2">Klik untuk unggah desain</span>
                        <input type="file" class="hidden">
                    </div>
                </label>
            </div>
            <!-- Submit Button -->
            <button type="submit" class="w-full flex items-center justify-center px-4 py-2.5 text-white bg-[#1e335f] rounded-md hover:bg-[#162547] focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-300 text-base font-semibold">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                </svg>
                Ajukan Tender
            </button>
        </form>
    </div>
</x-layout>

