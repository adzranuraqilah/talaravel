<x-layout-admin>
<div class="px-6 pt-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Produk</h1>
        <a href="/admin/produk-tambah" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Tambah Produk
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Search Bar -->
    <div class="bg-white border border-gray-200 rounded-xl p-6 mb-6">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-2">Cari Produk</label>
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="Cari berdasarkan nama produk, jenis bahan, warna..." 
                           class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="md:w-48">
                <label class="block text-sm font-medium text-gray-700 mb-2">Filter Jenis Produk</label>
                <select id="filterJenisProduk" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Jenis</option>
                    <option value="kaos">Kaos</option>
                    <option value="hoodie">Hoodie</option>
                    <option value="almamater">Almamater</option>
                    <option value="kemeja">Kemeja</option>
                    <option value="jaket">Jaket</option>
                </select>
            </div>
            <div class="md:w-48">
                <label class="block text-sm font-medium text-gray-700 mb-2">Filter Harga</label>
                <select id="filterHarga" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Harga</option>
                    <option value="0-50000">≤ Rp 50.000</option>
                    <option value="50000-100000">Rp 50.000 - 100.000</option>
                    <option value="100000-150000">Rp 100.000 - 150.000</option>
                    <option value="150000+">≥ Rp 150.000</option>
                </select>
            </div>
        </div>
        <div class="mt-4 flex items-center justify-between">
            <div class="text-sm text-gray-600">
                <span id="resultCount">0</span> produk ditemukan
            </div>
            <button id="clearSearch" class="text-gray-500 hover:text-gray-700 text-sm">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                Bersihkan Filter
            </button>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Bahan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Warna Bahan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ukuran</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sablon</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Warna</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Model Jahitan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tambahan Lain</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu Pengerjaan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="productTableBody">
                    @forelse($produks as $produk)
                    <tr class="product-row" 
                        data-jenis-produk="{{ strtolower($produk->nama_produk) }}"
                        data-jenis-bahan="{{ strtolower($produk->jenis_bahan) }}"
                        data-warna-bahan="{{ strtolower($produk->warna_bahan) }}"
                        data-sablon="{{ strtolower($produk->sablon ?? '') }}"
                        data-harga="{{ $produk->harga }}">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $produk->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                {{ ucfirst($produk->nama_produk) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $produk->jenis_bahan }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $produk->warna_bahan }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            @if($produk->ukuran)
                                @php $ukuran = is_string($produk->ukuran) ? json_decode($produk->ukuran, true) : $produk->ukuran; @endphp
                                @if(is_array($ukuran))
                                    @foreach($ukuran as $size)
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800 mr-1">{{ $size }}</span>
                                    @endforeach
                                @else
                                    {{ $produk->ukuran }}
                                @endif
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $produk->sablon ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $produk->jumlah_warna_sablon ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $produk->model_jahitan ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            @if($produk->tambahan_lain)
                                @php $tambahan = is_string($produk->tambahan_lain) ? json_decode($produk->tambahan_lain, true) : $produk->tambahan_lain; @endphp
                                @if(is_array($tambahan))
                                    @foreach($tambahan as $item)
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 mr-1">{{ $item }}</span>
                                    @endforeach
                                @else
                                    {{ $produk->tambahan_lain }}
                                @endif
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                {{ $produk->waktu_pengerjaan ?? '-' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">
                            Rp {{ number_format($produk->harga, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="/admin/produk/{{ $produk->id }}/edit" class="text-blue-600 hover:text-blue-900 mr-3">
                                <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <form action="/admin/produk/{{ $produk->id }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">
                                    <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="12" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada produk yang ditemukan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const filterJenisProduk = document.getElementById('filterJenisProduk');
    const filterHarga = document.getElementById('filterHarga');
    const clearSearch = document.getElementById('clearSearch');
    const resultCount = document.getElementById('resultCount');
    const productRows = document.querySelectorAll('.product-row');

    function filterProducts() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedJenisProduk = filterJenisProduk.value.toLowerCase();
        const selectedHarga = filterHarga.value;
        
        let visibleCount = 0;

        productRows.forEach(row => {
            const jenisProduk = row.getAttribute('data-jenis-produk');
            const jenisBahan = row.getAttribute('data-jenis-bahan');
            const warnaBahan = row.getAttribute('data-warna-bahan');
            const sablon = row.getAttribute('data-sablon');
            const harga = parseInt(row.getAttribute('data-harga'));

            // Search filter
            const searchMatch = searchTerm === '' || 
                jenisProduk.includes(searchTerm) ||
                jenisBahan.includes(searchTerm) ||
                warnaBahan.includes(searchTerm) ||
                sablon.includes(searchTerm);

            // Jenis produk filter
            const jenisProdukMatch = selectedJenisProduk === '' || jenisProduk === selectedJenisProduk;

            // Harga filter
            let hargaMatch = true;
            if (selectedHarga !== '') {
                const [min, max] = selectedHarga.split('-').map(val => {
                    if (val === '+') return Infinity;
                    return val === '' ? 0 : parseInt(val);
                });
                hargaMatch = harga >= min && (max === Infinity ? true : harga <= max);
            }

            // Show/hide row based on filters
            if (searchMatch && jenisProdukMatch && hargaMatch) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Update result count
        resultCount.textContent = visibleCount;

        // Show "no results" message if needed
        const noResultsRow = document.querySelector('tbody tr:not(.product-row)');
        if (visibleCount === 0 && noResultsRow) {
            noResultsRow.style.display = '';
        } else if (noResultsRow) {
            noResultsRow.style.display = 'none';
        }
    }

    // Event listeners
    searchInput.addEventListener('input', filterProducts);
    filterJenisProduk.addEventListener('change', filterProducts);
    filterHarga.addEventListener('change', filterProducts);

    clearSearch.addEventListener('click', function() {
        searchInput.value = '';
        filterJenisProduk.value = '';
        filterHarga.value = '';
        filterProducts();
    });

    // Initial count
    filterProducts();
});
</script>
</x-layout-admin>