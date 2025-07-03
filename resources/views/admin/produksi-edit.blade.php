<x-layout-admin>
<div class="max-w-xl mx-auto px-4 pt-10 pb-8">
    <!-- Judul -->
    <div class="mb-2">
        <div class="text-2xl font-bold text-gray-800">Konfirmasi Status Produksi</div>
        <div class="text-gray-400 text-base">Konfirmasi status untuk pesanan <span class="font-semibold text-gray-600">KODE PESANAN</span></div>
    </div>
    <!-- Card Info Pesanan -->
    <div class="bg-gray-100 rounded-lg p-4 mb-6">
        <div class="font-bold text-lg text-gray-800 mb-1">KODE PESANAN</div>
        <div class="text-gray-600 text-sm">Nama Pelanggan</div>
        <div class="text-gray-400 text-sm mb-2">Pesanan</div>
        <div class="text-gray-700 text-sm font-medium">Status Saat Ini : <span class="font-semibold">Berlangsung</span></div>
    </div>
    <!-- Form -->
    <form>
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Ubah Status Ke:</label>
            <select class="w-full border border-gray-400 rounded-lg px-4 py-2 text-gray-500 focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-base">
                <option selected disabled>Pilih status baru</option>
                <option>Berlangsung</option>
                <option>Selesai</option>
                <option>Pending</option>
            </select>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-1">Catatan (Opsional)</label>
            <textarea class="w-full border border-gray-400 rounded-lg px-4 py-2 text-base focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f]" rows="4" placeholder="Tambahkan catatan untuk perubahan status..."></textarea>
        </div>
        <div class="flex gap-4 justify-end">
            <a href="/admin/produksi" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-8 py-2 rounded-lg text-base transition">Batal</a>
            <button type="submit" class="bg-blue-900 hover:bg-blue-800 text-white font-semibold px-8 py-2 rounded-lg text-base transition">Konfirmasi</button>
        </div>
    </form>
</div>
</x-layout-admin>