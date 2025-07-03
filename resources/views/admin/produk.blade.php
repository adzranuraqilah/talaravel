<x-layout-admin>
<div class="px-6 pt-6">
    <!-- Header & Tombol Tambah Produk -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <div class="text-2xl font-bold text-gray-800">Produk</div>
            <div class="text-gray-500 text-sm">Selamat datang di Admin Panel Konveksi Estetika.os</div>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="/admin/produk-tambah" class="inline-flex items-center gap-2 px-4 py-2 border border-gray-200 rounded-lg text-gray-700 bg-white hover:bg-gray-100 font-medium shadow-sm transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 2v4M8 2v4M3 10h18"/>
                </svg>
                Tambah Produk
            </a>
        </div>
    </div>
    <!-- Daftar Produk -->
    <div class="bg-white border border-gray-200 rounded-xl p-6">
        <div class="flex items-center gap-2 mb-4">
            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <rect x="3" y="4" width="18" height="18" rx="2"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 2v4M8 2v4M3 10h18"/>
            </svg>
            <span class="text-lg font-semibold text-gray-700">Daftar Produk</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[900px] text-xs md:text-sm">
                <thead>
                    <tr class="border-b">
                        <th class="py-2 px-4 text-left text-gray-600 font-semibold">ID</th>
                        <th class="py-2 px-4 text-left text-gray-600 font-semibold">Jenis Produk</th>
                        <th class="py-2 px-4 text-left text-gray-600 font-semibold">Jenis Bahan</th>
                        <th class="py-2 px-4 text-left text-gray-600 font-semibold">Ukuran</th>
                        <th class="py-2 px-4 text-left text-gray-600 font-semibold">Sablon</th>
                        <th class="py-2 px-4 text-left text-gray-600 font-semibold">Warna Bahan</th>
                        <th class="py-2 px-4 text-left text-gray-600 font-semibold">Model Jahitan</th>
                        <th class="py-2 px-4 text-left text-gray-600 font-semibold">Waktu Pengerjaan</th>
                        <th class="py-2 px-4 text-left text-gray-600 font-semibold">Tambahan Lain</th>
                        <th class="py-2 px-4 text-left text-gray-600 font-semibold">Harga</th>
                        <th class="py-2 px-4 text-left text-gray-600 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Produk 1 -->
                    <tr class="border-b">
                        <td class="py-2 px-4">PRD-001</td>
                        <td class="py-2 px-4">Kaos</td>
                        <td class="py-2 px-4">Katun Combed</td>
                        <td class="py-2 px-4">S</td>
                        <td class="py-2 px-4">Bordir</td>
                        <td class="py-2 px-4">Burgundy</td>
                        <td class="py-2 px-4">Standard</td>
                        <td class="py-2 px-4 text-blue-600 font-semibold"><a href="#" class="hover:underline">14 hari</a></td>
                        <td class="py-2 px-4">Hangtag</td>
                        <td class="py-2 px-4 text-green-600 font-semibold">Rp 250.000</td>
                        <td class="py-2 px-4">
                            <div class="flex gap-2">
                                <button class="p-2 rounded hover:bg-gray-100" title="Lihat">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                                <button class="p-2 rounded hover:bg-gray-100" title="Hapus">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Produk 2 -->
                    <tr class="border-b">
                        <td class="py-2 px-4">PRD-002</td>
                        <td class="py-2 px-4">Hoodie</td>
                        <td class="py-2 px-4">Polyester</td>
                        <td class="py-2 px-4">M</td>
                        <td class="py-2 px-4">Sablon Plastisol</td>
                        <td class="py-2 px-4">Maroon</td>
                        <td class="py-2 px-4">Overdeck</td>
                        <td class="py-2 px-4 text-blue-600 font-semibold"><a href="#" class="hover:underline">21 hari</a></td>
                        <td class="py-2 px-4">Brand Label</td>
                        <td class="py-2 px-4 text-green-600 font-semibold">Rp 200.000</td>
                        <td class="py-2 px-4">
                            <div class="flex gap-2">
                                <button class="p-2 rounded hover:bg-gray-100" title="Lihat">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                                <button class="p-2 rounded hover:bg-gray-100" title="Hapus">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Produk 3 -->
                    <tr class="border-b">
                        <td class="py-2 px-4">PRD-003</td>
                        <td class="py-2 px-4">Almamater</td>
                        <td class="py-2 px-4">Katun Bamboo</td>
                        <td class="py-2 px-4">L</td>
                        <td class="py-2 px-4">Sablon Rubber</td>
                        <td class="py-2 px-4">Fuschia</td>
                        <td class="py-2 px-4">-</td>
                        <td class="py-2 px-4 text-blue-600 font-semibold"><a href="#" class="hover:underline">28 hari</a></td>
                        <td class="py-2 px-4">-</td>
                        <td class="py-2 px-4 text-green-600 font-semibold">Rp 350.000</td>
                        <td class="py-2 px-4">
                            <div class="flex gap-2">
                                <button class="p-2 rounded hover:bg-gray-100" title="Lihat">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                                <button class="p-2 rounded hover:bg-gray-100" title="Hapus">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Produk 4 -->
                    <tr class="border-b">
                        <td class="py-2 px-4">PRD-004</td>
                        <td class="py-2 px-4">Kemeja</td>
                        <td class="py-2 px-4">Supima</td>
                        <td class="py-2 px-4">XL</td>
                        <td class="py-2 px-4">Sablon DTG</td>
                        <td class="py-2 px-4">Pink</td>
                        <td class="py-2 px-4">-</td>
                        <td class="py-2 px-4 text-blue-600 font-semibold"><a href="#" class="hover:underline">34 hari</a></td>
                        <td class="py-2 px-4">-</td>
                        <td class="py-2 px-4 text-green-600 font-semibold">Rp 275.000</td>
                        <td class="py-2 px-4">
                            <div class="flex gap-2">
                                <button class="p-2 rounded hover:bg-gray-100" title="Lihat">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                                <button class="p-2 rounded hover:bg-gray-100" title="Hapus">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Produk 5 -->
                    <tr class="border-b">
                        <td class="py-2 px-4">PRD-005</td>
                        <td class="py-2 px-4">Jaket</td>
                        <td class="py-2 px-4">Fleece</td>
                        <td class="py-2 px-4">XXL</td>
                        <td class="py-2 px-4">-</td>
                        <td class="py-2 px-4">Dusty Rose</td>
                        <td class="py-2 px-4">-</td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4 text-green-600 font-semibold">Rp 180.000</td>
                        <td class="py-2 px-4">
                            <div class="flex gap-2">
                                <button class="p-2 rounded hover:bg-gray-100" title="Lihat">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                                <button class="p-2 rounded hover:bg-gray-100" title="Hapus">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Produk 6 -->
                    <tr class="border-b">
                        <td class="py-2 px-4">PRD-001</td>
                        <td class="py-2 px-4">Babyterry</td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4">Terracotta</td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4 text-green-600 font-semibold">Rp 250.000</td>
                        <td class="py-2 px-4">
                            <div class="flex gap-2">
                                <button class="p-2 rounded hover:bg-gray-100" title="Lihat">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                                <button class="p-2 rounded hover:bg-gray-100" title="Hapus">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Produk 7 -->
                    <tr class="border-b">
                        <td class="py-2 px-4">PRD-002</td>
                        <td class="py-2 px-4">Wol</td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4">Orange</td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4 text-green-600 font-semibold">Rp 200.000</td>
                        <td class="py-2 px-4">
                            <div class="flex gap-2">
                                <button class="p-2 rounded hover:bg-gray-100" title="Lihat">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                                <button class="p-2 rounded hover:bg-gray-100" title="Hapus">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Produk 8 -->
                    <tr class="border-b">
                        <td class="py-2 px-4">PRD-003</td>
                        <td class="py-2 px-4">Drill</td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4">Gold</td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4 text-green-600 font-semibold">Rp 350.000</td>
                        <td class="py-2 px-4">
                            <div class="flex gap-2">
                                <button class="p-2 rounded hover:bg-gray-100" title="Lihat">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                                <button class="p-2 rounded hover:bg-gray-100" title="Hapus">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Produk 9 -->
                    <tr class="border-b">
                        <td class="py-2 px-4">PRD-004</td>
                        <td class="py-2 px-4">Nagata Drill</td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4">Beige</td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4 text-green-600 font-semibold">Rp 275.000</td>
                        <td class="py-2 px-4">
                            <div class="flex gap-2">
                                <button class="p-2 rounded hover:bg-gray-100" title="Lihat">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                                <button class="p-2 rounded hover:bg-gray-100" title="Hapus">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Produk 10 -->
                    <tr>
                        <td class="py-2 px-4">PRD-005</td>
                        <td class="py-2 px-4">Linen</td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4">Creme</td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4 text-green-600 font-semibold">Rp 180.000</td>
                        <td class="py-2 px-4">
                            <div class="flex gap-2">
                                <button class="p-2 rounded hover:bg-gray-100" title="Lihat">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                                <button class="p-2 rounded hover:bg-gray-100" title="Hapus">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</x-layout-admin>