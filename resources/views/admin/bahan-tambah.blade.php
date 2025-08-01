<x-layout-admin>
<div class="px-6 pt-6 max-w-2xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <div class="text-2xl font-bold text-gray-800">Tambah Bahan</div>
        <div class="text-gray-500 text-sm">Tambah data bahan baru</div>
    </div>
    
    <!-- Form Card -->
    <div class="bg-white border border-gray-200 rounded-xl p-6">
        <form action="{{ route('admin.bahan.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <!-- Nama Bahan -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Nama Bahan</label>
                    <input type="text" name="nama_bahan" placeholder="Masukkan nama bahan" value="{{ old('nama_bahan') }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] @error('nama_bahan') border-red-500 @enderror" required />
                    @error('nama_bahan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Harga -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Harga</label>
                    <div class="relative">
                        <span class="absolute left-3 top-3 text-gray-500">Rp</span>
                        <input type="number" name="harga" placeholder="0" min="0" value="{{ old('harga') }}" class="w-full border border-gray-300 rounded-lg pl-12 pr-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] @error('harga') border-red-500 @enderror" required />
                    </div>
                    @error('harga')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Deskripsi (Opsional)</label>
                    <textarea name="deskripsi" placeholder="Tambahkan deskripsi bahan..." rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f]">{{ old('deskripsi') }}</textarea>
                </div>
            </div>
            
            <!-- Tombol -->
            <div class="flex gap-4 mt-6">
                <a href="{{ route('admin.bahan.index') }}" class="px-6 py-2 rounded-lg bg-gray-500 text-white font-semibold hover:bg-gray-600 transition">Batal</a>
                <button type="submit" class="px-6 py-2 rounded-lg bg-blue-900 text-white font-semibold hover:bg-blue-800 transition">Simpan</button>
            </div>
        </form>
    </div>
</div>
</x-layout-admin>