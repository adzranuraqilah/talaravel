<x-layout-admin>
<div class="px-6 pt-6 max-w-2xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <div class="text-2xl font-bold text-gray-800">Edit Sablon</div>
        <div class="text-gray-500 text-sm">Edit data sablon</div>
    </div>
    
    <!-- Form Card -->
    <div class="bg-white border border-gray-200 rounded-xl p-6">
        <form action="{{ route('admin.sablon.update', $sablon->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <!-- Nama Sablon -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Nama Sablon</label>
                    <input type="text" name="nama_sablon" placeholder="Masukkan nama sablon" value="{{ old('nama_sablon', $sablon->nama_sablon) }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] @error('nama_sablon') border-red-500 @enderror" required />
                    @error('nama_sablon')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Deskripsi</label>
                    <textarea name="deskripsi" placeholder="Masukkan deskripsi sablon (opsional)" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi', $sablon->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Tombol -->
            <div class="flex gap-4 mt-6">
                <a href="{{ route('admin.sablon.index') }}" class="px-6 py-2 rounded-lg bg-gray-500 text-white font-semibold hover:bg-gray-600 transition">Batal</a>
                <button type="submit" class="px-6 py-2 rounded-lg bg-blue-900 text-white font-semibold hover:bg-blue-800 transition">Update</button>
            </div>
        </form>
    </div>
</div>
</x-layout-admin>