<x-layout-admin>
    <div class="p-6">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('admin.waktu-pengerjaan.index') }}" class="text-gray-600 hover:text-gray-900">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Tambah Waktu Pengerjaan</h1>
        </div>

        <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
            <form action="{{ route('admin.waktu-pengerjaan.store') }}" method="POST">
                @csrf
                
                <div class="space-y-6">
                    <!-- Pilih Produk -->
                    <div>
                        <label for="produk_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Pilih Produk <span class="text-red-500">*</span>
                        </label>
                        <select name="produk_id" id="produk_id" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('produk_id') border-red-500 @enderror">
                            <option value="">Pilih Produk</option>
                            @foreach($produks as $produk)
                                <option value="{{ $produk->id }}" {{ old('produk_id') == $produk->id ? 'selected' : '' }}>
                                    {{ $produk->nama_produk }}
                                </option>
                            @endforeach
                        </select>
                        @error('produk_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama Waktu -->
                    <div>
                        <label for="nama_waktu" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Waktu <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama_waktu" id="nama_waktu" 
                               value="{{ old('nama_waktu') }}"
                               placeholder="Contoh: 2 Minggu"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('nama_waktu') border-red-500 @enderror">
                        @error('nama_waktu')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Durasi Hari -->
                    <div>
                        <label for="durasi_hari" class="block text-sm font-medium text-gray-700 mb-2">
                            Durasi (Hari) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="durasi_hari" id="durasi_hari" 
                               value="{{ old('durasi_hari') }}"
                               min="1" max="365"
                               placeholder="Contoh: 7"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('durasi_hari') border-red-500 @enderror">
                        @error('durasi_hari')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi
                        </label>
                        <textarea name="deskripsi" id="deskripsi" rows="4"
                                  placeholder="Deskripsi waktu pengerjaan (opsional)"
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
                        <a href="{{ route('admin.waktu-pengerjaan.index') }}" 
                           class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition-colors">
                            Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layout-admin>