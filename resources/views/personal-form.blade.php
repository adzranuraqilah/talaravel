<x-layout>
    <div class="max-w-xl mx-auto p-8 bg-white border border-gray-300 rounded-2xl mt-6" style="box-shadow:none;">
        <div class="text-center mb-6">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Ajukan Pesanan Personal</h2>
            <p class="text-gray-700 text-base">Isi Form Berikut Untuk Mengajukan Pesanan Anda</p>
        </div>
        <div class="flex justify-center gap-10 mb-8">
            <label class="flex items-center cursor-pointer text-lg font-medium text-gray-700">
                <input type="radio" name="tipe" value="personal" class="appearance-none w-6 h-6 border-2 border-gray-400 rounded-full checked:bg-white checked:border-[#444] focus:outline-none transition-all mr-2 relative checked:after:content-[''] checked:after:block checked:after:w-3 checked:after:h-3 checked:after:rounded-full checked:after:bg-[#444] checked:after:absolute checked:after:top-1/2 checked:after:left-1/2 checked:after:-translate-x-1/2 checked:after:-translate-y-1/2" checked>
                Personal
            </label>
            <label class="flex items-center cursor-pointer text-lg font-medium text-gray-700">
                <input type="radio" name="tipe" value="tender" class="appearance-none w-6 h-6 border-2 border-gray-400 rounded-full checked:bg-white checked:border-[#444] focus:outline-none transition-all mr-2 relative checked:after:content-[''] checked:after:block checked:after:w-3 checked:after:h-3 checked:after:rounded-full checked:after:bg-[#444] checked:after:absolute checked:after:top-1/2 checked:after:left-1/2 checked:after:-translate-x-1/2 checked:after:-translate-y-1/2" onchange="if(this.checked){window.location.href='/tender'}">
                Instansi
            </label>
        </div>
        <form class="space-y-5" method="POST" action="/personal" enctype="multipart/form-data">
            @csrf
            <!-- Nama Proyek -->
            <div>
                <label class="block text-base font-medium text-gray-800 mb-1">Nama Proyek</label>
                <input type="text" name="nama_proyek" placeholder="Masukkan Proyek Anda" class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-base" value="{{ old('nama_proyek', session('pending_form.nama_proyek')) }}">
            </div>
            <!-- Deskripsi Produk -->
            <div>
                <label class="block text-base font-medium text-gray-800 mb-1">Deskripsi Produk</label>
                <textarea name="deskripsi" rows="3" placeholder="Masukkan Deskripsi Produk Anda" class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-base">{{ old('deskripsi', session('pending_form.deskripsi')) }}</textarea>
            </div>
            <!-- Kuantitas -->
            <div>
                <label class="block text-base font-medium text-gray-800 mb-1">Kuantitas</label>
                <input type="number" name="kuantitas" placeholder="Masukkan Kuantitas" class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-base" value="{{ old('kuantitas', session('pending_form.kuantitas')) }}">
                <p class="text-xs text-gray-500 mt-1">Pembelian Min. 24 Pcs</p>
            </div>
            <!-- Tenggat Waktu -->
            <div>
                <label class="block text-base font-medium text-gray-800 mb-1">Tenggat Waktu</label>
                <div class="relative">
                    <input type="date" name="tenggat" placeholder="dd/mm/yyyy" class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-base pr-10" value="{{ old('tenggat', session('pending_form.tenggat')) }}">
                </div>
            </div>
            <!-- Budget -->
            <div class="mb-4">
                <label class="block text-gray-700 mb-1">Budget (Harga)</label>
                <input type="number" name="budget" placeholder="Masukkan Budget" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-200">
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
                        <input type="file" name="desain" class="hidden">
                    </div>
                </label>
            </div>
            <!-- Tombol Preview -->
            <button type="button" onclick="showPreview()" class="w-full flex items-center justify-center px-4 py-2.5 text-[#1e335f] bg-white border border-[#1e335f] rounded-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-300 text-base font-semibold mb-2">
                Preview Pesanan
            </button>
            <!-- Submit Button -->
            @auth
            <button type="submit" class="w-full flex items-center justify-center px-4 py-2.5 text-white bg-[#1e335f] rounded-md hover:bg-[#162547] focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-300 text-base font-semibold">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                </svg>
                Ajukan Pesanan Personal
            </button>
            @else
            <a href="/login" class="w-full flex items-center justify-center px-4 py-2.5 text-white bg-[#1e335f] rounded-md hover:bg-[#162547] focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-300 text-base font-semibold">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                </svg>
                Login untuk Ajukan Personal
            </a>
            @endauth
        </form>
        <!-- Preview Hasil Input -->
        <div id="preview" class="mt-8 p-6 bg-gray-50 border border-gray-200 rounded-lg hidden">
            <h3 class="text-lg font-bold mb-4">Preview Pesanan</h3>
            <div class="space-y-2">
                <div><span class="font-semibold">Nama Proyek:</span> <span id="preview-nama_proyek"></span></div>
                <div><span class="font-semibold">Deskripsi Produk:</span> <span id="preview-deskripsi"></span></div>
                <div><span class="font-semibold">Kuantitas:</span> <span id="preview-kuantitas"></span></div>
                <div><span class="font-semibold">Tenggat Waktu:</span> <span id="preview-tenggat"></span></div>
                <div><span class="font-semibold">Desain:</span> <span id="preview-desain"></span></div>
                <div id="preview-desain-img"></div>
            </div>
        </div>
        <script>
        function showPreview() {
            document.getElementById('preview').style.display = 'block';
            document.getElementById('preview-nama_proyek').innerText = document.querySelector('input[name="nama_proyek"]').value;
            document.getElementById('preview-deskripsi').innerText = document.querySelector('textarea[name="deskripsi"]').value;
            document.getElementById('preview-kuantitas').innerText = document.querySelector('input[name="kuantitas"]').value;
            document.getElementById('preview-tenggat').innerText = document.querySelector('input[name="tenggat"]').value;
            const desain = document.querySelector('input[name="desain"]').files[0];
            document.getElementById('preview-desain').innerText = desain ? desain.name : '-';
            // Tampilkan gambar preview jika ada file gambar
            const imgPreview = document.getElementById('preview-desain-img');
            imgPreview.innerHTML = '';
            if (desain && desain.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imgPreview.innerHTML = `<img src="${e.target.result}" class="mt-2 max-h-40 rounded border">`;
                };
                reader.readAsDataURL(desain);
            }
        }
        </script>
    </div>
</x-layout> 