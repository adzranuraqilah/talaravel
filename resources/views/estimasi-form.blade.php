<x-layout>
<div class="max-w-3xl mx-auto p-8 bg-white border border-gray-300 rounded-2xl mt-6">
    <div class="flex items-center gap-4 mb-2">
        <div class="p-0">
            <svg class="w-14 h-14 text-black" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                <rect x="6" y="6" width="36" height="36" rx="4" fill="#fff" stroke="#000" stroke-width="2"/>
                <rect x="14" y="14" width="20" height="4" rx="2" fill="#000"/>
                <rect x="14" y="22" width="4" height="4" rx="2" fill="#000"/>
                <rect x="22" y="22" width="4" height="4" rx="2" fill="#000"/>
                <rect x="30" y="22" width="4" height="4" rx="2" fill="#000"/>
                <rect x="14" y="30" width="4" height="4" rx="2" fill="#000"/>
                <rect x="22" y="30" width="4" height="4" rx="2" fill="#000"/>
                <rect x="30" y="30" width="4" height="4" rx="2" fill="#000"/>
            </svg>
        </div>
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900 mb-1">Form Estimasi Harga</h2>
            <p class="text-gray-700 text-base">Isi Form Berikut Untuk Mengetahui Estimasi Harga</p>
        </div>
    </div>
    <form class="mt-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
            <div>
                <label class="block text-base font-medium text-gray-800 mb-1">Jenis Produk</label>
                <div class="relative">
                    <select class="block w-full px-4 py-2 border border-gray-300 rounded-md appearance-none focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-base text-gray-500">
                        <option value="" disabled selected>Pilih Jenis Produk</option>
                        <option value="kaos">Kaos</option>
                        <option value="kemeja">Kemeja</option>
                        <option value="jaket">Jaket</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div>
                <label class="block text-base font-medium text-gray-800 mb-1">Kuantitas</label>
                <input type="number" placeholder="Masukkan Kuantitas" class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-base">
                <p class="text-xs text-gray-500 mt-1">Pembelian Min. 24 Pcs</p>
            </div>
            <div>
                <label class="block text-base font-medium text-gray-800 mb-1">Jenis Bahan</label>
                <div class="relative">
                    <select class="block w-full px-4 py-2 border border-gray-300 rounded-md appearance-none focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-base text-gray-500">
                        <option value="" disabled selected>Pilih Jenis Bahan</option>
                        <option value="katun">Katun</option>
                        <option value="polyester">Polyester</option>
                        <option value="cotton_combed">Cotton Combed</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div>
                <label class="block text-base font-medium text-gray-800 mb-1">Warna Bahan</label>
                <div class="relative">
                    <select class="block w-full px-4 py-2 border border-gray-300 rounded-md appearance-none focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-base text-gray-500">
                        <option value="" disabled selected>Pilih Warna Bahan</option>
                        <option value="putih">Putih</option>
                        <option value="hitam">Hitam</option>
                        <option value="abu">Abu</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div>
                <label class="block text-base font-medium text-gray-800 mb-1">Ukuran</label>
                <div class="flex gap-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600">
                        <span class="ml-2 text-base text-gray-700">S</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600">
                        <span class="ml-2 text-base text-gray-700">M</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600">
                        <span class="ml-2 text-base text-gray-700">L</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600">
                        <span class="ml-2 text-base text-gray-700">XL</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600">
                        <span class="ml-2 text-base text-gray-700">XXL</span>
                    </label>
                </div>
            </div>
            <div>
                <label class="block text-base font-medium text-gray-800 mb-1">Model Jahitan</label>
                <div class="relative">
                    <select class="block w-full px-4 py-2 border border-gray-300 rounded-md appearance-none focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-base text-gray-500">
                        <option value="" disabled selected>Pilih Model Jahitan</option>
                        <option value="standar">Standar</option>
                        <option value="rantai">Rantai</option>
                        <option value="overdeck">Overdeck</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div>
                <label class="block text-base font-medium text-gray-800 mb-1">Sablon</label>
                <div class="relative">
                    <select class="block w-full px-4 py-2 border border-gray-300 rounded-md appearance-none focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-base text-gray-500">
                        <option value="" disabled selected>Pilih Sablon</option>
                        <option value="plastisol">Plastisol</option>
                        <option value="rubber">Rubber</option>
                        <option value="dtg">DTG</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div>
                <label class="block text-base font-medium text-gray-800 mb-1">Jumlah Warna Sablon</label>
                <input type="number" placeholder="Masukkan Jumlah Warna Sablon" class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-base">
            </div>
            <div>
                <label class="block text-base font-medium text-gray-800 mb-1">Tambahan Lain</label>
                <div class="flex gap-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600">
                        <span class="ml-2 text-base text-gray-700">Brand Label</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600">
                        <span class="ml-2 text-base text-gray-700">Hangtag</span>
                    </label>
                </div>
            </div>
            <div>
                <label class="block text-base font-medium text-gray-800 mb-1">Waktu Pengerjaan</label>
                <div class="flex gap-4">
                    <label class="inline-flex items-center">
                        <input type="radio" name="waktu" class="form-radio h-5 w-5 text-blue-600">
                        <span class="ml-2 text-base text-gray-700">Standard</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="waktu" class="form-radio h-5 w-5 text-blue-600">
                        <span class="ml-2 text-base text-gray-700">Express</span>
                    </label>
                </div>
            </div>
        </div>
        <button type="button" class="w-full mt-6 px-4 py-2.5 text-white bg-[#1e335f] rounded-md hover:bg-[#162547] focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-300 font-bold text-base">
            Hitung
        </button>
        <div class="bg-gray-100 rounded-lg p-6 mt-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <p class="font-bold text-gray-800 mb-1">Hasil Estimasi</p>
                    <p class="text-sm text-gray-600">Harga Per Item</p>
                    <p class="font-bold">Rp. 0</p>
                </div>
                <div>
                    <p class="font-bold text-gray-800 mb-1 invisible">Hasil Estimasi</p>
                    <p class="text-sm text-gray-600">Total Estimasi</p>
                    <p class="font-bold">Rp. 0</p>
                </div>
                <div>
                    <p class="font-bold text-gray-800 mb-1 invisible">Hasil Estimasi</p>
                    <p class="text-sm text-gray-600">Estimasi Pengerjaan</p>
                    <p class="font-bold">0 hari kerja</p>
                </div>
            </div>
        </div>
    </form>
</div>
</x-layout>
