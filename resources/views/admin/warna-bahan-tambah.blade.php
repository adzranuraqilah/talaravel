<x-layout-admin>
<div class="px-6 pt-6 max-w-2xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <div class="text-2xl font-bold text-gray-800">Tambah Warna Bahan</div>
        <div class="text-gray-500 text-sm">Tambah warna baru dan pilih bahan yang tersedia</div>
    </div>
    
    <!-- Form Card -->
    <div class="bg-white border border-gray-200 rounded-xl p-6">
        <form action="{{ route('admin.warna-bahan.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <!-- Nama Warna -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Nama Warna</label>
                    <input type="text" name="nama_warna" placeholder="Masukkan nama warna" value="{{ old('nama_warna') }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] @error('nama_warna') border-red-500 @enderror" required />
                    @error('nama_warna')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Pilih Warna (Color Picker) -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Pilih Warna</label>
                    <div class="flex items-center gap-3">
                        <input type="color" name="kode_warna" value="{{ old('kode_warna', '#ff0000') }}" class="w-12 h-12 border border-gray-300 rounded-lg cursor-pointer" />
                        <span class="text-sm text-gray-500">Klik untuk memilih warna</span>
                    </div>
                    @error('kode_warna')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Pilih Bahan -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Pilih Bahan yang Tersedia</label>
                    <div class="relative">
                        <!-- Input untuk dropdown -->
                        <div id="dropdown-trigger" class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus-within:ring-2 focus-within:ring-[#1e335f] focus-within:border-[#1e335f] min-h-[50px] cursor-pointer bg-white">
                            <!-- Tags yang sudah dipilih -->
                            <div id="selected-tags" class="flex flex-wrap gap-2 mb-2">
                                <!-- Tags akan muncul di sini -->
                            </div>
                            <!-- Placeholder -->
                            <div id="placeholder" class="text-gray-500">Pilih bahan yang tersedia...</div>
                        </div>
                        
                        <!-- Dropdown options -->
                        <div id="dropdown-options" class="absolute z-[9999] w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-xl max-h-48 overflow-y-auto hidden">
                            <div class="p-2">
                                @foreach($bahans as $bahan)
                                <label class="flex items-center gap-3 p-2 hover:bg-gray-100 rounded cursor-pointer">
                                    <input type="checkbox" name="bahan_ids[]" value="{{ $bahan->id }}" class="bahan-checkbox w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" />
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
                
                <!-- Deskripsi (Opsional) -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Deskripsi (Opsional)</label>
                    <textarea name="deskripsi" placeholder="Tambahkan deskripsi warna..." rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f]">{{ old('deskripsi') }}</textarea>
                </div>
            </div>
            
            <!-- Tombol -->
            <div class="flex gap-4 mt-6">
                <a href="{{ route('admin.warna-bahan.index') }}" class="px-6 py-2 rounded-lg bg-gray-500 text-white font-semibold hover:bg-gray-600 transition">Batal</a>
                <button type="submit" class="px-6 py-2 rounded-lg bg-blue-900 text-white font-semibold hover:bg-blue-800 transition">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
let selectedBahan = [];

// Tunggu sampai DOM selesai dimuat
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, setting up dropdown');
    
    const dropdownTrigger = document.getElementById('dropdown-trigger');
    const dropdown = document.getElementById('dropdown-options');
    const checkboxes = document.querySelectorAll('.bahan-checkbox');
    
    // Event listener untuk dropdown trigger
    if (dropdownTrigger && dropdown) {
        dropdownTrigger.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log('Dropdown clicked');
            dropdown.classList.toggle('hidden');
            console.log('Dropdown visible:', !dropdown.classList.contains('hidden'));
        });
    }
    
    // Event listener untuk checkbox
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const bahanName = this.nextElementSibling.textContent;
            toggleBahan(this, bahanName);
        });
    });
    
    // Tutup dropdown ketika klik di luar
    document.addEventListener('click', function(event) {
        if (dropdown && !dropdownTrigger.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });
});

function toggleBahan(checkbox, bahanName) {
    console.log('Toggle bahan:', bahanName, 'checked:', checkbox.checked);
    if (checkbox.checked) {
        selectedBahan.push({ value: checkbox.value, name: bahanName });
    } else {
        selectedBahan = selectedBahan.filter(item => item.value !== checkbox.value);
    }
    console.log('Selected bahan:', selectedBahan);
    updateTags();
}

function updateTags() {
    const tagsContainer = document.getElementById('selected-tags');
    const placeholder = document.getElementById('placeholder');
    
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
    updateTags();
}
</script>
</x-layout-admin>