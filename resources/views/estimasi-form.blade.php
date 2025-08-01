<x-layout>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
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
    
    <form class="mt-6" id="form-estimasi">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
            <div>
                <label class="block text-base font-medium text-gray-800 mb-1">Jenis Produk</label>
                <div class="relative">
                    <select name="jenis_produk" id="jenis_produk" class="block w-full px-4 py-2 border border-gray-300 rounded-md appearance-none focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-base text-gray-500">
                        <option value="" disabled selected>Pilih Jenis Produk</option>
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
                <input name="kuantitas" type="number" placeholder="Masukkan Kuantitas" class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-base">
                <p class="text-xs text-gray-500 mt-1">Pembelian Min. 24 Pcs</p>
            </div>
            <div>
                <label class="block text-base font-medium text-gray-800 mb-1">Jenis Bahan</label>
                <div class="relative">
                    <select name="jenis_bahan" id="jenis_bahan" class="block w-full px-4 py-2 border border-gray-300 rounded-md appearance-none focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-base text-gray-500">
                        <option value="" disabled selected>Pilih Jenis Bahan</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>
                <div id="deskripsi_bahan" class="mt-2 p-3 bg-gray-50 rounded-md text-sm text-gray-600 hidden">
                    <p id="deskripsi_text"></p>
                </div>
            </div>
            <div>
                <label class="block text-base font-medium text-gray-800 mb-1">Warna Bahan</label>
                <div class="relative">
                    <select name="warna_bahan" id="warna_bahan" class="block w-full px-4 py-2 border border-gray-300 rounded-md appearance-none focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-base text-gray-500">
                        <option value="" disabled selected>Pilih Warna Bahan</option>
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
                        <input name="ukuran[]" value="S" type="checkbox" class="form-checkbox h-5 w-5 text-blue-600">
                        <span class="ml-2 text-base text-gray-700">S</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input name="ukuran[]" value="M" type="checkbox" class="form-checkbox h-5 w-5 text-blue-600">
                        <span class="ml-2 text-base text-gray-700">M</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input name="ukuran[]" value="L" type="checkbox" class="form-checkbox h-5 w-5 text-blue-600">
                        <span class="ml-2 text-base text-gray-700">L</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input name="ukuran[]" value="XL" type="checkbox" class="form-checkbox h-5 w-5 text-blue-600">
                        <span class="ml-2 text-base text-gray-700">XL</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input name="ukuran[]" value="XXL" type="checkbox" class="form-checkbox h-5 w-5 text-blue-600">
                        <span class="ml-2 text-base text-gray-700">XXL</span>
                    </label>
                </div>
            </div>
            <div>
                <label class="block text-base font-medium text-gray-800 mb-1">Model Jahitan</label>
                <div class="relative">
                    <select name="model_jahitan" id="model_jahitan" class="block w-full px-4 py-2 border border-gray-300 rounded-md appearance-none focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-base text-gray-500">
                        <option value="" disabled selected>Pilih Model Jahitan</option>
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
                    <select name="sablon" id="sablon" class="block w-full px-4 py-2 border border-gray-300 rounded-md appearance-none focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-base text-gray-500">
                        <option value="" disabled selected>Pilih Sablon</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>
                <div id="deskripsi_sablon" class="mt-2 p-3 bg-gray-50 rounded-md text-sm text-gray-600 hidden">
                    <p id="deskripsi_sablon_text"></p>
                </div>
            </div>
            <div>
                <label class="block text-base font-medium text-gray-800 mb-1">Jumlah Warna Sablon</label>
                <input name="jumlah_warna_sablon" type="number" placeholder="Masukkan Jumlah Warna Sablon" class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-base">
                <p class="text-xs text-gray-500 mt-1">1-4 warna: Rp. 20.000 | Lebih dari 4 warna: Rp. 25.000-30.000</p>
            </div>
            <div>
                <label class="block text-base font-medium text-gray-800 mb-1">Tambahan Lain</label>
                <div id="tambahan_lain_container" class="flex gap-4 flex-wrap">
                    <!-- Akan diisi oleh JavaScript -->
                </div>
            </div>
            <div>
                <label class="block text-base font-medium text-gray-800 mb-1">Waktu Pengerjaan</label>
                <div id="waktu_pengerjaan_container" class="flex gap-4">
                    <!-- Akan diisi oleh JavaScript -->
                </div>
            </div>
        </div>
        <button type="submit" class="w-full mt-6 px-4 py-2.5 text-white bg-[#1e335f] rounded-md hover:bg-[#162547] focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-300 font-bold text-base">
            Hitung
        </button>
        <div class="bg-gray-100 rounded-lg p-6 mt-6 hasil-estimasi hidden">
            <h3 class="font-bold text-gray-800 mb-4 text-lg">Hasil Estimasi</h3>
            
            <!-- Rincian Harga Per Item -->
            <div class="mb-6">
                <h4 class="font-semibold text-gray-700 mb-3">Rincian Harga Per Item:</h4>
                <div class="space-y-2 text-sm">
                    <div class="grid grid-cols-3 gap-4 items-center">
                        <span class="font-medium">Produk:</span>
                        <span class="detail-produk-nama text-center">-</span>
                        <span class="detail-produk-harga text-right">Rp. 0</span>
                    </div>
                    <div class="grid grid-cols-3 gap-4 items-center">
                        <span class="font-medium">Bahan:</span>
                        <span class="detail-bahan-nama text-center">-</span>
                        <span class="detail-bahan-harga text-right">Rp. 0</span>
                    </div>
                    <div class="grid grid-cols-3 gap-4 items-center">
                        <span class="font-medium">Warna Bahan:</span>
                        <span class="detail-warna-nama text-center">-</span>
                        <span class="text-gray-500 text-right">(Tidak ada biaya)</span>
                    </div>
                    <div class="grid grid-cols-3 gap-4 items-center">
                        <span class="font-medium">Sablon:</span>
                        <span class="detail-sablon-nama text-center">-</span>
                        <span class="detail-sablon-harga text-right">Rp. 0</span>
                    </div>
                    <div class="grid grid-cols-3 gap-4 items-center">
                        <span class="font-medium">Jahitan:</span>
                        <span class="detail-jahitan-nama text-center">-</span>
                        <span class="text-gray-500 text-right">(Tidak ada biaya)</span>
                    </div>
                    <div class="grid grid-cols-3 gap-4 items-center">
                        <span class="font-medium">Tambahan Lain:</span>
                        <span class="detail-tambahan-nama text-center">-</span>
                        <span class="detail-tambahan-harga text-right">Rp. 0</span>
                    </div>
                    <div class="border-t border-gray-300 pt-2 mt-2">
                        <div class="grid grid-cols-3 gap-4 items-center font-semibold">
                            <span>Total Harga Per Item:</span>
                            <span></span>
                            <span class="hasil-harga-per-item text-right">Rp. 0</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Kuantitas dan Total -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-600">Kuantitas</p>
                    <p class="font-bold detail-kuantitas">0 pcs</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Total Estimasi</p>
                    <p class="font-bold hasil-total-estimasi">Rp. 0</p>
                </div>
            </div>
            
            <!-- Estimasi Pengerjaan -->
            <div class="mt-4 pt-4 border-t border-gray-200">
                <p class="font-bold text-gray-800 mb-1">Estimasi Pengerjaan</p>
                <p class="font-bold hasil-estimasi-pengerjaan">0 hari kerja</p>
            </div>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(function() {
        console.log('Script loaded');
        console.log('jQuery version:', $.fn.jquery);
        
        // Debug: cek apakah element ada
        console.log('jenis_produk element exists:', $('#jenis_produk').length);
        console.log('jenis_bahan element exists:', $('#jenis_bahan').length);
        
        // Fallback data bahan jika API tidak berfungsi
        const bahanData = {
            'kaos': {
                'cotton_combed': { nama: 'Katun Combed', deskripsi: 'Katun halus, adem, nyaman untuk sehari-hari.' },
                'polyester': { nama: 'Polyester', deskripsi: 'Bahan ringan, cepat kering, tapi kurang menyerap keringat.' },
                'bamboo': { nama: 'Katun Bamboo', deskripsi: 'Super lembut, adem, anti-bakteri alami.' },
                'supima': { nama: 'Supima', deskripsi: 'Katun premium, kuat, halus, dan tahan warna.' }
            },
            'hoodie': {
                'fleece': { nama: 'Fleece', deskripsi: 'Tebal, lembut, dan sangat hangat.' },
                'babyterry': { nama: 'Babyterry', deskripsi: 'Lebih tipis, bagian dalam halus, tetap nyaman.' },
                'wol': { nama: 'Wol', deskripsi: 'Sangat hangat, cocok untuk cuaca dingin berat.' }
            },
            'almamater': {
                'drill': { nama: 'Drill', deskripsi: 'Kain kuat, sedikit tebal, tekstur diagonal.' },
                'nagata_drill': { nama: 'Nagata Drill', deskripsi: 'Lebih tebal dan adem dibanding drill biasa.' }
            },
            'kemeja': {
                'katun': { nama: 'Katun', deskripsi: 'Adem, lembut, nyaman untuk dipakai sehari-hari.' },
                'linen': { nama: 'Linen', deskripsi: 'Adem, mewah, agak kaku alami.' },
                'silk': { nama: 'Silk', deskripsi: 'Halus, berkilau, mewah di badan.' },
                'oxford': { nama: 'Oxford', deskripsi: 'Katun tebal bertekstur, formal dan nyaman.' },
                'rayon': { nama: 'Rayon', deskripsi: 'Lembut, jatuh di badan, adem.' },
                'drill': { nama: 'Drill', deskripsi: 'Kuat dan kokoh, cocok untuk kerja.' },
                'polyester': { nama: 'Polyester', deskripsi: 'Tahan lama, cepat kering, kurang adem.' }
            },
            'jaket': {
                'kanvas': { nama: 'Kanvas', deskripsi: 'Kuat, agak kasar, cocok untuk outdoor.' },
                'nilon': { nama: 'Nilon', deskripsi: 'Ringan, tahan air, pas untuk jaket hujan.' },
                'fleece': { nama: 'Fleece', deskripsi: 'Lembut dan sangat hangat.' },
                'lotto': { nama: 'Lotto', deskripsi: 'Elastis, halus, cocok untuk jaket olahraga.' },
                'windbraker': { nama: 'Windbraker', deskripsi: 'Ringan, tahan angin, pas untuk aktivitas luar ruangan.' }
            }
        };
        
        // Load jenis produk berdasarkan API
        $.ajax({
            url: "/jenis-produk",
            method: "GET",
            dataType: "json",
            success: function(data) {
                console.log('Jenis Produk data received from API:', data);
                loadJenisProdukOptions(data);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching jenis produk from API:', error);
                console.log('Status:', status);
                console.log('Response:', xhr.responseText);
                console.log('Status Code:', xhr.status);
                
                // Fallback ke data lokal
                console.log('Using fallback jenis produk data');
                const fallbackData = ['kaos', 'hoodie', 'almamater', 'kemeja', 'jaket'];
                loadJenisProdukOptions(fallbackData);
            }
        });

        // Load data jahitan, sablon, tambahan lain, dan waktu pengerjaan
        loadJahitanOptions();
        loadSablonOptions();
        loadTambahanLainOptions();

        // Load bahan berdasarkan jenis produk
        $('#jenis_produk').on('change', function() {
            const jenisProduk = $(this).val();
            console.log('Jenis produk changed to:', jenisProduk);
            
            if (jenisProduk) {
                $.ajax({
                    url: `/bahan/${jenisProduk}`,
                    method: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log('Bahan data received:', data);
                        loadBahanOptions(data);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching bahan:', error);
                        console.log('Status:', status);
                        console.log('Response:', xhr.responseText);
                        
                        // Fallback data
                        const fallbackData = {
                            'cotton_combed': {
                                'nama': 'Katun Combed',
                                'deskripsi': 'Katun halus, adem, nyaman untuk sehari-hari.',
                                'warna': ['burgundy', 'maroon', 'chili red', 'fuchsia', 'pink', 'dusty rose', 'terracotta', 'orange', 'bright orange', 'gold', 'kuning lemon', 'mustard', 'coklat kopi', 'beige', 'cream', 'army green', 'olive green', 'seafoam green', 'electric lime', 'mint green', 'denim blue', 'steel blue', 'pastel blue', 'sky blue', 'turkis', 'navy', 'ungu tua', 'royal purple', 'lavender', 'lilac', 'magenta', 'jet black', 'light grey', 'broken white', 'putih netral']
                            }
                        };
                        loadBahanOptions(fallbackData);
                    }
                });
            } else {
                $('#jenis_bahan').html('<option value="" disabled selected>Pilih Jenis Bahan</option>');
                $('#warna_bahan').html('<option value="" disabled selected>Pilih Warna Bahan</option>');
                $('#deskripsi_bahan').addClass('hidden');
            }
        });

        // Load warna berdasarkan jenis bahan
        $('#jenis_bahan').on('change', function() {
            const jenisProduk = $('#jenis_produk').val();
            const jenisBahan = $(this).val();
            console.log('Jenis bahan changed to:', jenisBahan);
            
            if (jenisBahan) {
                $.ajax({
                    url: `/warna/${jenisProduk}/${jenisBahan}`,
                    method: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log('Warna data received:', data);
                        loadWarnaOptions(data);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching warna:', error);
                        console.log('Status:', status);
                        console.log('Response:', xhr.responseText);
                        
                        // Fallback data
                        const fallbackData = ['burgundy', 'maroon', 'chili red', 'fuchsia', 'pink', 'dusty rose', 'terracotta', 'orange', 'bright orange', 'gold', 'kuning lemon', 'mustard', 'coklat kopi', 'beige', 'cream', 'army green', 'olive green', 'seafoam green', 'electric lime', 'mint green', 'denim blue', 'steel blue', 'pastel blue', 'sky blue', 'turkis', 'navy', 'ungu tua', 'royal purple', 'lavender', 'lilac', 'magenta', 'jet black', 'light grey', 'broken white', 'putih netral'];
                        loadWarnaOptions(fallbackData);
                    }
                });
            } else {
                $('#warna_bahan').html('<option value="" disabled selected>Pilih Warna Bahan</option>');
            }
        });

        // Load waktu pengerjaan berdasarkan produk
        $('#jenis_produk').on('change', function() {
            const jenisProduk = $(this).val();
            if (jenisProduk) {
                loadWaktuPengerjaanOptions(jenisProduk);
            } else {
                // Clear waktu pengerjaan jika tidak ada produk yang dipilih
                $('#waktu_pengerjaan_container').empty();
            }
        });

        // Handle form submission
        $('#form-estimasi').on('submit', function(e) {
            e.preventDefault();
            console.log('Form submitted');
            
            // Collect form data properly
            const formData = new FormData(this);
            const data = {};
            
            // Handle regular fields
            formData.forEach((value, key) => {
                if (data[key]) {
                    if (Array.isArray(data[key])) {
                        data[key].push(value);
                    } else {
                        data[key] = [data[key], value];
                    }
                } else {
                    data[key] = value;
                }
            });
            
            // Handle ukuran checkboxes specifically
            const ukuranChecked = [];
            $('input[name="ukuran[]"]:checked').each(function() {
                ukuranChecked.push($(this).val());
            });
            data.ukuran = ukuranChecked;
            
            // Handle tambahan_lain checkboxes specifically
            const tambahanChecked = [];
            $('input[name="tambahan_lain[]"]:checked').each(function() {
                tambahanChecked.push($(this).val());
            });
            data.tambahan_lain = tambahanChecked;
            
            console.log('Form data:', data);
            
            $.ajax({
                url: '/estimasi-harga',
                method: 'POST',
                data: JSON.stringify(data),
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(res) {
                    console.log('Success response:', res);
                    console.log('harga_per_item:', res.harga_per_item);
                    console.log('total_estimasi:', res.total_estimasi);
                    console.log('estimasi_pengerjaan:', res.estimasi_pengerjaan);
                    
                    // Isi rincian detail
                    if (res.detail) {
                        // Produk
                        if (res.detail.produk) {
                            $('.detail-produk-nama').text(res.detail.produk.nama);
                            $('.detail-produk-harga').text('Rp. ' + res.detail.produk.harga.toLocaleString());
                        }
                        
                        // Bahan
                        if (res.detail.bahan) {
                            $('.detail-bahan-nama').text(res.detail.bahan.nama);
                            $('.detail-bahan-harga').text('Rp. ' + res.detail.bahan.harga.toLocaleString());
                        }
                        
                        // Warna Bahan
                        if (res.detail.warna_bahan) {
                            $('.detail-warna-nama').text(res.detail.warna_bahan.nama);
                        }
                        
                        // Sablon
                        if (res.detail.sablon) {
                            $('.detail-sablon-nama').text(res.detail.sablon.nama);
                            $('.detail-sablon-harga').text('Rp. ' + res.detail.sablon.harga.toLocaleString());
                        }
                        
                        // Jahitan
                        if (res.detail.jahitan) {
                            $('.detail-jahitan-nama').text(res.detail.jahitan.nama);
                        }
                        
                        // Tambahan Lain
                        if (res.detail.tambahan_lain) {
                            if (res.detail.tambahan_lain.items && res.detail.tambahan_lain.items.length > 0) {
                                $('.detail-tambahan-nama').text(res.detail.tambahan_lain.items.join(', '));
                                $('.detail-tambahan-harga').text('Rp. ' + res.detail.tambahan_lain.harga.toLocaleString());
                            } else {
                                $('.detail-tambahan-nama').text('-');
                                $('.detail-tambahan-harga').text('Rp. 0');
                            }
                        }
                        
                        // Kuantitas
                        if (res.detail.kuantitas) {
                            $('.detail-kuantitas').text(res.detail.kuantitas + ' pcs');
                        }
                    }
                    
                    // Pastikan semua field ada sebelum mengakses propertinya
                    if (res.harga_per_item !== undefined) {
                        console.log('Setting harga_per_item to:', res.harga_per_item);
                        $('.hasil-harga-per-item').text('Rp. ' + res.harga_per_item.toLocaleString());
                    }
                    
                    if (res.total_estimasi !== undefined) {
                        console.log('Setting total_estimasi to:', res.total_estimasi);
                        $('.hasil-total-estimasi').text('Rp. ' + res.total_estimasi.toLocaleString());
                    }
                    
                    if (res.estimasi_pengerjaan !== undefined) {
                        console.log('Setting estimasi_pengerjaan to:', res.estimasi_pengerjaan);
                        $('.hasil-estimasi-pengerjaan').text(res.estimasi_pengerjaan);
                    }
                    
                    // Tampilkan hasil estimasi
                    $('.hasil-estimasi').removeClass('hidden');
                    $('html, body').animate({
                        scrollTop: $('.hasil-estimasi').offset().top - 100
                    }, 500);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    console.log('Status:', status);
                    console.log('Response:', xhr.responseText);
                    alert('Terjadi kesalahan saat menghitung estimasi harga.');
                }
            });
        });

        // Show deskripsi bahan
        $('#jenis_bahan').on('change', function() {
            const jenisBahan = $(this).val();
            const jenisProduk = $('#jenis_produk').val();
            
            if (jenisBahan && jenisProduk) {
                $.ajax({
                    url: `/bahan/${jenisProduk}`,
                    method: "GET",
                    dataType: "json",
                    success: function(data) {
                        if (data[jenisBahan] && data[jenisBahan].deskripsi) {
                            $('#deskripsi_text').text(data[jenisBahan].deskripsi);
                            $('#deskripsi_bahan').removeClass('hidden');
                        } else {
                            $('#deskripsi_bahan').addClass('hidden');
                        }
                    },
                    error: function() {
                        $('#deskripsi_bahan').addClass('hidden');
                    }
                });
            } else {
                $('#deskripsi_bahan').addClass('hidden');
            }
        });

        // Show deskripsi sablon
        $('#sablon').on('change', function() {
            const sablonNama = $(this).val();
            
            if (sablonNama) {
                $.ajax({
                    url: "/api/sablon",
                    method: "GET",
                    dataType: "json",
                    success: function(data) {
                        const selectedSablon = data.find(sablon => sablon.nama_sablon === sablonNama);
                        if (selectedSablon && selectedSablon.deskripsi) {
                            $('#deskripsi_sablon_text').text(selectedSablon.deskripsi);
                            $('#deskripsi_sablon').removeClass('hidden');
                        } else {
                            $('#deskripsi_sablon').addClass('hidden');
                        }
                    },
                    error: function() {
                        $('#deskripsi_sablon').addClass('hidden');
                    }
                });
            } else {
                $('#deskripsi_sablon').addClass('hidden');
            }
        });

        // Debug: Log when jenis produk is clicked
        $('#jenis_produk').on('click', function() {
            console.log('Jenis produk clicked');
        });
        
        function loadJenisProdukOptions(data) {
            console.log('loadJenisProdukOptions called with:', data);
            const jenisProdukSelect = $('#jenis_produk');
            jenisProdukSelect.html('<option value="" disabled selected>Pilih Jenis Produk</option>');
            
            // Handle array of strings
            if (Array.isArray(data)) {
                data.forEach(function(jenisProduk) {
                    const displayName = jenisProduk.charAt(0).toUpperCase() + jenisProduk.slice(1);
                    jenisProdukSelect.append(`<option value="${jenisProduk}">${displayName}</option>`);
                });
            } else {
                // Handle object
                Object.keys(data).forEach(function(key) {
                    const jenisProduk = data[key];
                    jenisProdukSelect.append(`<option value="${key}">${jenisProduk}</option>`);
                });
            }
            console.log('Jenis Produk options loaded');
        }

        function loadBahanOptions(data) {
            console.log('loadBahanOptions called with:', data);
            const bahanSelect = $('#jenis_bahan');
            bahanSelect.html('<option value="" disabled selected>Pilih Jenis Bahan</option>');
            
            Object.keys(data).forEach(function(key) {
                const bahan = data[key];
                bahanSelect.append(`<option value="${key}" data-deskripsi="${bahan.deskripsi}">${bahan.nama}</option>`);
            });
            console.log('Bahan options loaded');
        }
        
        function loadWarnaOptions(data) {
            console.log('loadWarnaOptions called with:', data);
            const warnaSelect = $('#warna_bahan');
            warnaSelect.html('<option value="" disabled selected>Pilih Warna Bahan</option>');
            
            // Handle array of strings
            if (Array.isArray(data)) {
                data.forEach(function(warna) {
                    warnaSelect.append(`<option value="${warna}">${warna}</option>`);
                });
            } else {
                // Handle object (if data is a single object with a 'warna' property)
                if (data.warna) {
                    data.warna.forEach(function(warna) {
                        warnaSelect.append(`<option value="${warna}">${warna}</option>`);
                    });
                }
            }
            console.log('Warna options loaded');
        }
        
        function getFallbackWarna(jenisProduk, jenisBahan) {
            const warnaData = {
                'kaos': {
                    'cotton_combed': ['burgundy', 'maroon', 'chili red', 'fuchsia', 'pink', 'dusty rose', 'terracotta', 'orange', 'bright orange', 'gold', 'kuning lemon', 'mustard', 'coklat kopi', 'beige', 'cream', 'army green', 'olive green', 'seafoam green', 'electric lime', 'mint green', 'denim blue', 'steel blue', 'pastel blue', 'sky blue', 'turkis', 'navy', 'ungu tua', 'royal purple', 'lavender', 'lilac', 'magenta', 'jet black', 'light grey', 'broken white', 'putih netral'],
                    'polyester': ['putih', 'hitam', 'navy'],
                    'cotton_bamboo': ['merah cabe', 'putih netral', 'hitam reaktif special', 'maroon', 'abu sedang', 'mustard', 'hijau botol special 2', 'beige', 'dusty pink', 'steel blue', 'kuning kenari', 'abu muda', 'tosca muda', 'mineral green', 'olive green', 'dark mustard', 'almond brown', 'coklat susu', 'deep blue', 'abu tua', 'dark navy'],
                    'supima': ['putih bersih', 'hitam pekat', 'abu muda', 'abu charcoal', 'navy', 'cream', 'beige', 'coklat susu', 'sage green', 'terracotta', 'dusty pink', 'biru steel', 'maroon', 'olive', 'mustard gold']
                },
                'hoodie': {
                    'fleece': ['hitam', 'putih', 'maroon', 'navy', 'merah cabe', 'mustard', 'beige', 'steel blue', 'army green', 'lilac', 'dusty rose', 'cream', 'maroon'],
                    'babyterry': ['hitam', 'navy', 'maroon', 'putih', 'mustard', 'steel blue', 'beige', 'army green', 'burgundy', 'merah cabe', 'olive green', 'dusty rose', 'seafoam', 'cinnamon', 'toffee', 'cream'],
                    'wol': ['hitam', 'abu-abu tua', 'abu muda', 'coklat kopi', 'maroon', 'navy', 'olive', 'beige', 'putih tulang', 'dusty pink', 'mustard', 'burgundy', 'charcoal grey']
                },
                'almamater': {
                    'drill': ['navy', 'abu-abu muda', 'maroon', 'hitam', 'coklat kopi', 'hijau botol'],
                    'nagata_drill': ['biru elektrik', 'merah maroon', 'hitam', 'abu-abu', 'coklat susu', 'hijau army']
                },
                'kemeja': {
                    'katun': ['putih', 'hitam', 'biru langit', 'abu muda', 'krem', 'merah bata'],
                    'linen': ['putih gading', 'coklat muda', 'abu-abu', 'olive', 'biru pastel'],
                    'silk': ['champagne', 'hitam pekat', 'navy deep', 'burgundy', 'emerald'],
                    'oxford': ['putih', 'abu silver', 'biru muda', 'cream', 'coklat susu'],
                    'rayon': ['hitam', 'mustard', 'hijau sage', 'lavender', 'dusty pink'],
                    'drill': ['biru dongker', 'coklat tanah', 'hitam', 'abu-abu tua', 'hijau lumut'],
                    'polyester': ['hitam', 'merah', 'biru', 'orange', 'kuning cerah']
                },
                'jaket': {
                    'kanvas': ['army', 'hitam', 'abu tua', 'coklat tanah', 'navy'],
                    'nilon': ['hitam', 'abu gelap', 'merah maroon', 'olive', 'kuning stabilo'],
                    'fleece': ['hitam', 'abu', 'merah bata', 'biru navy', 'coklat mocca'],
                    'lotto': ['hitam', 'merah tua', 'abu metalik', 'biru tua', 'hijau botol'],
                    'windbraker': ['hitam', 'tosca', 'silver', 'kuning cerah', 'merah cabai']
                }
            };
            
            return warnaData[jenisProduk]?.[jenisBahan] || [];
        }

        function loadJahitanOptions() {
            $.ajax({
                url: "/api/jahitan",
                method: "GET",
                dataType: "json",
                success: function(data) {
                    const jahitanSelect = $('#model_jahitan');
                    jahitanSelect.html('<option value="" disabled selected>Pilih Model Jahitan</option>');
                    
                    data.forEach(function(jahitan) {
                        jahitanSelect.append(`<option value="${jahitan.nama_jahitan}">${jahitan.nama_jahitan}</option>`);
                    });
                },
                error: function() {
                    // Fallback data
                    const fallbackData = ['Standar', 'Rantai', 'Overdeck'];
                    const jahitanSelect = $('#model_jahitan');
                    jahitanSelect.html('<option value="" disabled selected>Pilih Model Jahitan</option>');
                    
                    fallbackData.forEach(function(jahitan) {
                        jahitanSelect.append(`<option value="${jahitan}">${jahitan}</option>`);
                    });
                }
            });
        }

        function loadSablonOptions() {
            $.ajax({
                url: "/api/sablon",
                method: "GET",
                dataType: "json",
                success: function(data) {
                    const sablonSelect = $('#sablon');
                    sablonSelect.html('<option value="" disabled selected>Pilih Sablon</option>');
                    
                    data.forEach(function(sablon) {
                        sablonSelect.append(`<option value="${sablon.nama_sablon}">${sablon.nama_sablon}</option>`);
                    });
                },
                error: function() {
                    // Fallback data
                    const fallbackData = ['Plastisol', 'Rubber', 'DTG', 'Bordir'];
                    const sablonSelect = $('#sablon');
                    sablonSelect.html('<option value="" disabled selected>Pilih Sablon</option>');
                    
                    fallbackData.forEach(function(sablon) {
                        sablonSelect.append(`<option value="${sablon}">${sablon}</option>`);
                    });
                }
            });
        }

        function loadTambahanLainOptions() {
            $.ajax({
                url: "/api/tambahan-lain",
                method: "GET",
                dataType: "json",
                success: function(data) {
                    const container = $('#tambahan_lain_container');
                    container.empty();
                    
                    data.forEach(function(tambahan) {
                        container.append(`
                            <label class="inline-flex items-center">
                                <input name="tambahan_lain[]" value="${tambahan.nama_tambahan}" type="checkbox" class="form-checkbox h-5 w-5 text-blue-600">
                                <span class="ml-2 text-base text-gray-700">${tambahan.nama_tambahan}</span>
                            </label>
                        `);
                    });
                },
                error: function() {
                    // Fallback data
                    const fallbackData = ['Hangtag', 'Woven', 'Label Brand Sablon'];
                    const container = $('#tambahan_lain_container');
                    container.empty();
                    
                    fallbackData.forEach(function(tambahan) {
                        container.append(`
                            <label class="inline-flex items-center">
                                <input name="tambahan_lain[]" value="${tambahan}" type="checkbox" class="form-checkbox h-5 w-5 text-blue-600">
                                <span class="ml-2 text-base text-gray-700">${tambahan}</span>
                            </label>
                        `);
                    });
                }
            });
        }

        function loadWaktuPengerjaanOptions(jenisProduk) {
            $.ajax({
                url: `/api/waktu-pengerjaan?produk=${jenisProduk}`,
                method: "GET",
                dataType: "json",
                success: function(data) {
                    const container = $('#waktu_pengerjaan_container');
                    container.empty();
                    
                    data.forEach(function(waktu) {
                        container.append(`
                            <label class="inline-flex items-center">
                                <input name="waktu_pengerjaan" value="${waktu.nama_waktu}" type="radio" class="form-radio h-5 w-5 text-blue-600">
                                <span class="ml-2 text-base text-gray-700">${waktu.nama_waktu}</span>
                            </label>
                        `);
                    });
                },
                error: function() {
                    // Fallback data
                    const fallbackData = ['Standard', 'Express'];
                    const container = $('#waktu_pengerjaan_container');
                    container.empty();
                    
                    fallbackData.forEach(function(waktu) {
                        container.append(`
                            <label class="inline-flex items-center">
                                <input name="waktu_pengerjaan" value="${waktu}" type="radio" class="form-radio h-5 w-5 text-blue-600">
                                <span class="ml-2 text-base text-gray-700">${waktu}</span>
                            </label>
                        `);
                    });
                }
            });
        }
    });
    </script>
</div>
</x-layout>
