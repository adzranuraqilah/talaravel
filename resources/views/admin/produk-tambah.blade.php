<x-layout-admin>
<div class="px-6 pt-8 max-w-xl mx-auto">
    <div class="text-lg font-semibold text-gray-800 mb-4">Kelola Data</div>
    <div class="bg-white border border-gray-300 rounded-xl p-6">
        <form>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Kolom Kiri -->
                <div>
                    <label class="block text-gray-700 text-sm mb-1">Tambah Jenis Produk</label>
                    <input type="text" placeholder="Nama Produk" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] mb-4" />
                </div>
                <div>
                    <label class="block text-gray-700 text-sm mb-1">Tambah Warna Bahan</label>
                    <input type="text" placeholder="Nama Warna Bahan" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] mb-4" />
                </div>
                <div>
                    <label class="block text-gray-700 text-sm mb-1">Tambah Jenis Bahan</label>
                    <input type="text" placeholder="Nama Bahan" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] mb-4" />
                </div>
                <div>
                    <label class="block text-gray-700 text-sm mb-1">Tambah Model Jahitan</label>
                    <input type="text" placeholder="Nama Produk" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] mb-4" />
                </div>
                <div>
                    <label class="block text-gray-700 text-sm mb-1">Tambah Ukuran</label>
                    <input type="text" placeholder="Nama Ukuran" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] mb-4" />
                </div>
                <div>
                    <label class="block text-gray-700 text-sm mb-1">Tambah Estimasi Pengerjaan</label>
                    <input type="text" placeholder="Nama Estimasi Pengerjaan" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] mb-4" />
                </div>
                <div>
                    <label class="block text-gray-700 text-sm mb-1">Tambah Sablon</label>
                    <input type="text" placeholder="Nama Sablon" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] mb-4" />
                </div>
                <div>
                    <label class="block text-gray-700 text-sm mb-1">Tambah Tambahan Lain</label>
                    <input type="text" placeholder="Nama Tambahan Lain" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] mb-4" />
                </div>
            </div>
            <div class="flex justify-end gap-4 mt-4">
                <a href="/admin/produk" class="px-8 py-2 rounded-lg bg-red-600 text-white font-semibold hover:bg-red-700 transition">Batal</a>
                <button type="submit" class="px-8 py-2 rounded-lg bg-blue-900 text-white font-semibold hover:bg-blue-800 transition">Tambah</button>
            </div>
        </form>
    </div>
</div>
</x-layout-admin>