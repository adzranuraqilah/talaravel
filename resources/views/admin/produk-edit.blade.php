<x-layout-admin>
<div class="px-6 pt-8 max-w-4xl mx-auto">
    <div class="text-lg font-semibold text-gray-800 mb-4">Edit Produk</div>
    <div class="bg-white border border-gray-300 rounded-xl p-6">
        <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-base font-medium text-gray-800 mb-1">Jenis Produk</label>
                    <input type="text" name="nama_produk" class="block w-full px-4 py-2 border border-gray-300 rounded-md @error('nama_produk') border-red-500 @enderror" value="{{ old('nama_produk', $produk->nama_produk) }}" placeholder="Contoh: kaos, hoodie, almamater, kemeja, jaket" required>
                    @error('nama_produk')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-base font-medium text-gray-800 mb-1">Harga (Rp)</label>
                    <input type="number" name="harga" class="block w-full px-4 py-2 border border-gray-300 rounded-md @error('harga') border-red-500 @enderror" value="{{ old('harga', $produk->harga) }}" placeholder="Masukkan harga produk" required>
                    @error('harga')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Pilih Bahan -->
            <div>
                <label class="block text-base font-medium text-gray-800 mb-2">Pilih Bahan</label>
                <div class="relative">
                    <div id="dropdown-trigger-bahan" class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus-within:ring-2 focus-within:ring-[#1e335f] focus-within:border-[#1e335f] min-h-[50px] cursor-pointer bg-white">
                        <div id="selected-tags-bahan" class="flex flex-wrap gap-2 mb-2">
                            @foreach($produk->bahans as $bahan)
                            <span class="inline-flex items-center gap-1 px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded-full">
                                {{ $bahan->nama_bahan }}
                                <button type="button" onclick="removeBahan('{{ $bahan->id }}')" class="text-blue-500 hover:text-blue-700">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </span>
                            @endforeach
                        </div>
                        <div id="placeholder-bahan" class="text-gray-500" style="{{ $produk->bahans->count() > 0 ? 'display: none;' : '' }}">Pilih bahan yang tersedia...</div>
                    </div>
                    
                    <div id="dropdown-options-bahan" class="absolute z-[9999] w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-xl max-h-48 overflow-y-auto hidden">
                        <div class="p-2">
                            @foreach($bahans as $bahan)
                            <label class="flex items-center gap-3 p-2 hover:bg-gray-100 rounded cursor-pointer">
                                <input type="checkbox" name="bahan_ids[]" value="{{ $bahan->id }}" class="bahan-checkbox w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" {{ $produk->bahans->contains($bahan->id) ? 'checked' : '' }} />
                                <span class="text-sm">{{ $bahan->nama_bahan }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                @error('bahan_ids')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pilih Warna Bahan -->
            <div>
                <label class="block text-base font-medium text-gray-800 mb-2">Pilih Warna Bahan</label>
                <div class="relative">
                    <div id="dropdown-trigger-warna" class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus-within:ring-2 focus-within:ring-[#1e335f] focus-within:border-[#1e335f] min-h-[50px] cursor-pointer bg-white">
                        <div id="selected-tags-warna" class="flex flex-wrap gap-2 mb-2">
                            @foreach($produk->warnaBahans as $warnaBahan)
                            <div class="flex items-center gap-1">
                                <div class="w-3 h-3 rounded-full border border-gray-300" style="background-color: {{ $warnaBahan->kode_warna }}"></div>
                                <span class="inline-flex items-center gap-1 px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full">
                                    {{ $warnaBahan->nama_warna }}
                                    <button type="button" onclick="removeWarnaBahan('{{ $warnaBahan->id }}')" class="text-green-500 hover:text-green-700">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </span>
                            </div>
                            @endforeach
                        </div>
                        <div id="placeholder-warna" class="text-gray-500" style="{{ $produk->warnaBahans->count() > 0 ? 'display: none;' : '' }}">Pilih warna bahan yang tersedia...</div>
                    </div>
                    
                    <div id="dropdown-options-warna" class="absolute z-[9999] w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-xl max-h-48 overflow-y-auto hidden">
                        <div class="p-2" id="warna-options-container">
                            <!-- Options akan diisi secara dinamis -->
                        </div>
                    </div>
                </div>
                @error('warna_bahan_ids')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-base font-medium text-gray-800 mb-1">Deskripsi (Opsional)</label>
                <textarea name="deskripsi" rows="3" class="block w-full px-4 py-2 border border-gray-300 rounded-md @error('deskripsi') border-red-500 @enderror" placeholder="Tambahkan deskripsi produk...">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                @error('deskripsi')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Update Produk</button>
                <a href="{{ route('admin.produk.index') }}" class="px-6 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
let selectedBahan = [];
let selectedWarnaBahan = [];
let allWarnaBahans = @json($warnaBahans);

// Inisialisasi data yang sudah ada
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, setting up dropdowns for produk edit');
    
    // Setup dropdown bahan
    const dropdownTriggerBahan = document.getElementById('dropdown-trigger-bahan');
    const dropdownBahan = document.getElementById('dropdown-options-bahan');
    const bahanCheckboxes = document.querySelectorAll('.bahan-checkbox');
    
    // Event listener untuk dropdown trigger bahan
    if (dropdownTriggerBahan && dropdownBahan) {
        dropdownTriggerBahan.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            dropdownBahan.classList.toggle('hidden');
        });
    }
    
    // Event listener untuk checkbox bahan
    bahanCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const bahanName = this.nextElementSibling.textContent;
            toggleBahan(this, bahanName);
        });
    });
    
    // Setup dropdown warna bahan
    const dropdownTriggerWarna = document.getElementById('dropdown-trigger-warna');
    const dropdownWarna = document.getElementById('dropdown-options-warna');
    
    // Event listener untuk dropdown trigger warna
    if (dropdownTriggerWarna && dropdownWarna) {
        dropdownTriggerWarna.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            dropdownWarna.classList.toggle('hidden');
        });
    }
    
    // Tutup dropdown ketika klik di luar
    document.addEventListener('click', function(event) {
        if (dropdownBahan && !dropdownTriggerBahan.contains(event.target) && !dropdownBahan.contains(event.target)) {
            dropdownBahan.classList.add('hidden');
        }
        if (dropdownWarna && !dropdownTriggerWarna.contains(event.target) && !dropdownWarna.contains(event.target)) {
            dropdownWarna.classList.add('hidden');
        }
    });
    
    // Inisialisasi data yang sudah ada
    const checkedBahanCheckboxes = document.querySelectorAll('.bahan-checkbox:checked');
    checkedBahanCheckboxes.forEach(checkbox => {
        const bahanName = checkbox.nextElementSibling.textContent;
        selectedBahan.push({ value: checkbox.value, name: bahanName });
    });
    updateTagsBahan();
    updateWarnaBahanOptions();
    
    // Inisialisasi warna bahan yang sudah ada
    const checkedWarnaCheckboxes = document.querySelectorAll('input[name="warna_bahan_ids[]"]:checked');
    checkedWarnaCheckboxes.forEach(checkbox => {
        const warnaName = checkbox.closest('label').querySelector('span').textContent;
        selectedWarnaBahan.push({ value: checkbox.value, name: warnaName });
    });
    updateTagsWarna();
});

function toggleBahan(checkbox, bahanName) {
    console.log('Toggle bahan:', bahanName, 'checked:', checkbox.checked);
    if (checkbox.checked) {
        selectedBahan.push({ value: checkbox.value, name: bahanName });
    } else {
        selectedBahan = selectedBahan.filter(item => item.value !== checkbox.value);
    }
    console.log('Selected bahan:', selectedBahan);
    updateTagsBahan();
    updateWarnaBahanOptions();
}

function updateTagsBahan() {
    const tagsContainer = document.getElementById('selected-tags-bahan');
    const placeholder = document.getElementById('placeholder-bahan');
    
    if (!tagsContainer || !placeholder) return;
    
    tagsContainer.innerHTML = '';
    
    if (selectedBahan.length > 0) {
        placeholder.style.display = 'none';
        selectedBahan.forEach(bahan => {
            const tag = document.createElement('span');
            tag.className = 'inline-flex items-center gap-1 px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded-full';
            tag.innerHTML = `
                ${bahan.name}
                <button type="button" onclick="removeBahan('${bahan.value}')" class="text-blue-500 hover:text-blue-700">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            `;
            tagsContainer.appendChild(tag);
        });
    } else {
        placeholder.style.display = 'block';
    }
}

function removeBahan(value) {
    console.log('Remove bahan:', value);
    selectedBahan = selectedBahan.filter(item => item.value !== value);
    const checkbox = document.querySelector(`input[value="${value}"]`);
    if (checkbox) checkbox.checked = false;
    updateTagsBahan();
    updateWarnaBahanOptions();
}

function updateWarnaBahanOptions() {
    const container = document.getElementById('warna-options-container');
    const selectedBahanIds = selectedBahan.map(b => b.value);
    
    if (selectedBahanIds.length === 0) {
        container.innerHTML = '<div class="p-2 text-gray-500">Pilih bahan terlebih dahulu</div>';
        return;
    }
    
    // Filter warna bahan berdasarkan bahan yang dipilih
    const filteredWarnaBahans = allWarnaBahans.filter(warnaBahan => {
        return warnaBahan.bahans.some(bahan => selectedBahanIds.includes(bahan.id.toString()));
    });
    
    if (filteredWarnaBahans.length === 0) {
        container.innerHTML = '<div class="p-2 text-gray-500">Tidak ada warna bahan untuk bahan yang dipilih</div>';
        return;
    }
    
    container.innerHTML = '';
    filteredWarnaBahans.forEach(warnaBahan => {
        const label = document.createElement('label');
        label.className = 'flex items-center gap-3 p-2 hover:bg-gray-100 rounded cursor-pointer';
        label.innerHTML = `
            <input type="checkbox" name="warna_bahan_ids[]" value="${warnaBahan.id}" class="warna-checkbox w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500" />
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 rounded-full border border-gray-300" style="background-color: ${warnaBahan.kode_warna}"></div>
                <span class="text-sm">${warnaBahan.nama_warna}</span>
            </div>
        `;
        
        // Add event listener
        const checkbox = label.querySelector('.warna-checkbox');
        checkbox.addEventListener('change', function() {
            toggleWarnaBahan(this, warnaBahan.nama_warna);
        });
        
        container.appendChild(label);
    });
}

function toggleWarnaBahan(checkbox, warnaName) {
    console.log('Toggle warna bahan:', warnaName, 'checked:', checkbox.checked);
    if (checkbox.checked) {
        selectedWarnaBahan.push({ value: checkbox.value, name: warnaName });
    } else {
        selectedWarnaBahan = selectedWarnaBahan.filter(item => item.value !== checkbox.value);
    }
    updateTagsWarna();
}

function updateTagsWarna() {
    const tagsContainer = document.getElementById('selected-tags-warna');
    const placeholder = document.getElementById('placeholder-warna');
    
    if (!tagsContainer || !placeholder) return;
    
    tagsContainer.innerHTML = '';
    
    if (selectedWarnaBahan.length > 0) {
        placeholder.style.display = 'none';
        selectedWarnaBahan.forEach(warna => {
            const tag = document.createElement('span');
            tag.className = 'inline-flex items-center gap-1 px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full';
            tag.innerHTML = `
                ${warna.name}
                <button type="button" onclick="removeWarnaBahan('${warna.value}')" class="text-green-500 hover:text-green-700">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            `;
            tagsContainer.appendChild(tag);
        });
    } else {
        placeholder.style.display = 'block';
    }
}

function removeWarnaBahan(value) {
    console.log('Remove warna bahan:', value);
    selectedWarnaBahan = selectedWarnaBahan.filter(item => item.value !== value);
    const checkbox = document.querySelector(`input[name="warna_bahan_ids[]"][value="${value}"]`);
    if (checkbox) checkbox.checked = false;
    updateTagsWarna();
}
</script>
</x-layout-admin> 