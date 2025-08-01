<x-layout-admin>
    <div class="p-6">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('admin.tambahan-lain.index') }}" class="text-gray-600 hover:text-gray-900">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Tambah Tambahan Lain</h1>
        </div>

        <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
            <form action="{{ route('admin.tambahan-lain.store') }}" method="POST">
                @csrf
                
                <div class="space-y-6">
                    <!-- Nama Tambahan -->
                    <div>
                        <label for="nama_tambahan" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Tambahan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama_tambahan" id="nama_tambahan" 
                               value="{{ old('nama_tambahan') }}"
                               placeholder="Contoh: Hangtag"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('nama_tambahan') border-red-500 @enderror">
                        @error('nama_tambahan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Harga -->
                    <div>
                        <label for="harga" class="block text-sm font-medium text-gray-700 mb-2">
                            Harga <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="harga" id="harga" 
                               value="{{ old('harga') }}"
                               min="0" step="1000"
                               placeholder="Contoh: 5000"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('harga') border-red-500 @enderror">
                        @error('harga')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi
                        </label>
                        <textarea name="deskripsi" id="deskripsi" rows="4"
                                  placeholder="Deskripsi tambahan lain (opsional)"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol Submit -->
                    <div class="flex gap-3 pt-4">
                        <button type="submit" 
                                class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                            Simpan
                        </button>
                        <a href="{{ route('admin.tambahan-lain.index') }}" 
                           class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition-colors">
                            Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layout-admin>