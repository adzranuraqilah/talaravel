<x-layout-admin>
<div class="px-6 pt-8 max-w-4xl mx-auto">
    <div class="text-lg font-semibold text-gray-800 mb-4">Edit Produk</div>
    <div class="bg-white border border-gray-300 rounded-xl p-6">
        <form action="/admin/produk/{{ $produk->id }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-base font-medium text-gray-800 mb-1">Jenis Produk</label>
                    <input type="text" name="nama_produk" class="block w-full px-4 py-2 border border-gray-300 rounded-md" value="{{ $produk->nama_produk }}" placeholder="Contoh: kaos, hoodie, almamater, kemeja, jaket">
                </div>
                <div>
                    <label class="block text-base font-medium text-gray-800 mb-1">Jenis Bahan</label>
                    <input type="text" name="jenis_bahan" class="block w-full px-4 py-2 border border-gray-300 rounded-md" value="{{ $produk->jenis_bahan }}" placeholder="Contoh: drill, fleece, cotton_combed">
                </div>
                <div>
                    <label class="block text-base font-medium text-gray-800 mb-1">Warna Bahan</label>
                    <input type="text" name="warna_bahan" class="block w-full px-4 py-2 border border-gray-300 rounded-md" value="{{ $produk->warna_bahan }}" placeholder="Contoh: maroon, navy, putih netral">
                </div>
                <div>
                    <label class="block text-base font-medium text-gray-800 mb-1">Ukuran</label>
                    <div class="flex gap-4 flex-wrap">
                        @php $ukuranArr = is_string($produk->ukuran) ? json_decode($produk->ukuran, true) : ($produk->ukuran ?? []); @endphp
                        <label class="inline-flex items-center"><input name="ukuran[]" value="S" type="checkbox" class="form-checkbox" {{ in_array('S', $ukuranArr ?? []) ? 'checked' : '' }}> <span class="ml-2">S</span></label>
                        <label class="inline-flex items-center"><input name="ukuran[]" value="M" type="checkbox" class="form-checkbox" {{ in_array('M', $ukuranArr ?? []) ? 'checked' : '' }}> <span class="ml-2">M</span></label>
                        <label class="inline-flex items-center"><input name="ukuran[]" value="L" type="checkbox" class="form-checkbox" {{ in_array('L', $ukuranArr ?? []) ? 'checked' : '' }}> <span class="ml-2">L</span></label>
                        <label class="inline-flex items-center"><input name="ukuran[]" value="XL" type="checkbox" class="form-checkbox" {{ in_array('XL', $ukuranArr ?? []) ? 'checked' : '' }}> <span class="ml-2">XL</span></label>
                        <label class="inline-flex items-center"><input name="ukuran[]" value="XXL" type="checkbox" class="form-checkbox" {{ in_array('XXL', $ukuranArr ?? []) ? 'checked' : '' }}> <span class="ml-2">XXL</span></label>
                    </div>
                </div>
                <div>
                    <label class="block text-base font-medium text-gray-800 mb-1">Model Jahitan</label>
                    <input type="text" name="model_jahitan" class="block w-full px-4 py-2 border border-gray-300 rounded-md" value="{{ $produk->model_jahitan }}" placeholder="Contoh: standar, rantai, overdeck">
                </div>
                <div>
                    <label class="block text-base font-medium text-gray-800 mb-1">Sablon</label>
                    <input type="text" name="sablon" class="block w-full px-4 py-2 border border-gray-300 rounded-md" value="{{ $produk->sablon }}" placeholder="Contoh: plastisol, rubber, dtg, bordir">
                </div>
                <div>
                    <label class="block text-base font-medium text-gray-800 mb-1">Jumlah Warna Sablon</label>
                    <input type="number" name="jumlah_warna_sablon" min="1" max="10" class="block w-full px-4 py-2 border border-gray-300 rounded-md" value="{{ $produk->jumlah_warna_sablon }}" placeholder="Masukkan jumlah warna sablon">
                </div>
                <div>
                    <label class="block text-base font-medium text-gray-800 mb-1">Tambahan Lain</label>
                    <div class="flex gap-4 flex-wrap">
                        @php $tambahanArr = is_string($produk->tambahan_lain) ? json_decode($produk->tambahan_lain, true) : ($produk->tambahan_lain ?? []); @endphp
                        <label class="inline-flex items-center"><input name="tambahan_lain[]" value="hangtag" type="checkbox" class="form-checkbox" {{ in_array('hangtag', $tambahanArr ?? []) ? 'checked' : '' }}> <span class="ml-2">Hangtag</span></label>
                        <label class="inline-flex items-center"><input name="tambahan_lain[]" value="woven" type="checkbox" class="form-checkbox" {{ in_array('woven', $tambahanArr ?? []) ? 'checked' : '' }}> <span class="ml-2">Woven</span></label>
                        <label class="inline-flex items-center"><input name="tambahan_lain[]" value="label_brand_sablon" type="checkbox" class="form-checkbox" {{ in_array('label_brand_sablon', $tambahanArr ?? []) ? 'checked' : '' }}> <span class="ml-2">Label Brand Sablon</span></label>
                    </div>
                </div>
                <div>
                    <label class="block text-base font-medium text-gray-800 mb-1">Waktu Pengerjaan</label>
                    <input type="text" name="waktu_pengerjaan" class="block w-full px-4 py-2 border border-gray-300 rounded-md" value="{{ $produk->waktu_pengerjaan }}" placeholder="Contoh: Standard, Express">
                </div>
                <div>
                    <label class="block text-base font-medium text-gray-800 mb-1">Harga (Rp)</label>
                    <input type="number" name="harga" class="block w-full px-4 py-2 border border-gray-300 rounded-md" value="{{ $produk->harga }}" placeholder="Masukkan harga produk">
                </div>
            </div>
            <div class="flex gap-4 pt-4">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Update Produk</button>
                <a href="/admin/produk" class="px-6 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Batal</a>
            </div>
        </form>
    </div>
</div>
</x-layout-admin> 