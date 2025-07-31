<x-layout-admin>
<div class="px-6 pt-6">
    <!-- Header & Search -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <div class="text-2xl font-bold text-gray-800">Jadwal Produksi</div>
            <div class="text-gray-500 text-sm">Selamat datang di Admin Panel Konveksi Estetika.os</div>
        </div>
        <form method="GET">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari pesanan, produk..." class="w-72 px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-sm">
        </form>
    </div>
    <!-- Pesan Sukses -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                {{ session('success') }}
            </div>
        </div>
    @endif
    <!-- Filter Tanggal -->
    <div class="mb-4">
        <button class="flex items-center gap-2 px-4 py-2 border border-gray-200 rounded-lg text-gray-600 bg-gray-50 hover:bg-gray-100 text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            hh/bb/tttt
        </button>
    </div>
    <!-- Statistik Produksi -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white border border-gray-200 rounded-lg p-5 flex items-center gap-4">
            <div class="bg-blue-100 rounded-full p-2">
                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/>
                    <polygon points="10,8 16,12 10,16" fill="currentColor"/>
                </svg>
            </div>
            <div>
                <div class="text-xs text-gray-500 mb-1">Sedang Berlangsung</div>
                <div class="text-xl font-bold text-gray-700">{{ $sedangBerlangsung }}</div>
            </div>
        </div>
        <div class="bg-white border border-gray-200 rounded-lg p-5 flex items-center gap-4">
            <div class="bg-yellow-100 rounded-full p-2">
                <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/>
                    <path d="M12 6v6l4 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div>
                <div class="text-xs text-gray-500 mb-1">Terjadwal</div>
                <div class="text-xl font-bold text-gray-700">{{ $terjadwal }}</div>
            </div>
        </div>
        <div class="bg-white border border-gray-200 rounded-lg p-5 flex items-center gap-4">
            <div class="bg-gray-100 rounded-full p-2">
                <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/>
                    <path d="M12 8v4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <circle cx="12" cy="16" r="1" fill="currentColor"/>
                </svg>
            </div>
            <div>
                <div class="text-xs text-gray-500 mb-1">Pending</div>
                <div class="text-xl font-bold text-gray-700">{{ $pending }}</div>
            </div>
        </div>
        <div class="bg-white border border-gray-200 rounded-lg p-5 flex items-center gap-4">
            <div class="bg-green-100 rounded-full p-2">
                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/>
                    <path d="M9 12l2 2 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div>
                <div class="text-xs text-gray-500 mb-1">Selesai Bulan Ini</div>
                <div class="text-xl font-bold text-gray-700">{{ $selesaiBulanIni }}</div>
            </div>
        </div>
    </div>
    <!-- Jadwal Produksi Aktif -->
    <div class="bg-white border border-gray-200 rounded-xl p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
            <div class="text-lg font-semibold text-gray-800 mb-2 md:mb-0">Jadwal Produksi Aktif</div>
            <a href="/admin/produksi-tambah" class="flex items-center gap-2 px-4 py-2 border border-gray-200 rounded-lg text-gray-600 bg-gray-50 hover:bg-gray-100 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Jadwalkan Produksi
            </a>
        </div>
        <div class="space-y-4">
            @forelse($produksi as $jadwal)
            <div class="flex flex-col md:flex-row md:items-center md:justify-between bg-gray-50 border border-gray-100 rounded-lg p-4 hover:bg-gray-200 cursor-pointer transition">
                <div>
                    <div class="font-semibold text-base">{{ $jadwal->order ? 'ORD-' . str_pad($jadwal->order->id, 3, '0', STR_PAD_LEFT) : 'KODE PESANAN' }}</div>
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.847.607 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ $jadwal->order->user->name ?? 'Nama Pelanggan' }}
                        </span>
                        <span>• {{ $jadwal->order->nama_proyek ?? 'Pesanan' }}</span>
                    </div>
                </div>
                <div class="flex flex-col md:items-end gap-2 mt-2 md:mt-0">
                    <div class="text-sm text-gray-700">
                        {{ $jadwal->tanggal_mulai ? \Carbon\Carbon::parse($jadwal->tanggal_mulai)->format('d-m-Y') : 'hh-bb-tttt' }} - 
                        {{ $jadwal->tanggal_selesai ? \Carbon\Carbon::parse($jadwal->tanggal_selesai)->format('d-m-Y') : 'hh-bb-tttt' }}
                    </div>
                    <div class="text-xs text-gray-400">Timeline produksi</div>
                </div>
                <div class="flex items-center gap-2 mt-2 md:mt-0">
                    @if($jadwal->status === 'terjadwal')
                        <span class="bg-yellow-500 text-white text-xs font-semibold px-3 py-1 rounded">Terjadwal</span>
                    @elseif($jadwal->status === 'sedang_berlangsung')
                        <span class="bg-blue-500 text-white text-xs font-semibold px-3 py-1 rounded">Diproses</span>
                    @elseif($jadwal->status === 'selesai')
                        <span class="bg-green-600 text-white text-xs font-semibold px-3 py-1 rounded">Selesai</span>
                    @else
                        <span class="bg-gray-500 text-white text-xs font-semibold px-3 py-1 rounded">{{ ucfirst($jadwal->status) }}</span>
                    @endif
                    
                    <!-- Dropdown untuk update status -->
                    <div class="relative">
                        <button onclick="toggleDropdown({{ $jadwal->id }})" class="p-1 hover:bg-gray-300 rounded">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                            </svg>
                        </button>
                        <div id="dropdown-{{ $jadwal->id }}" class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-10">
                            <form action="/admin/produksi/{{ $jadwal->id }}/update-status" method="POST" class="p-2">
                                @csrf
                                <button type="submit" name="status" value="terjadwal" class="block w-full text-left px-3 py-2 text-sm hover:bg-gray-100 rounded">Set Terjadwal</button>
                                <button type="submit" name="status" value="sedang_berlangsung" class="block w-full text-left px-3 py-2 text-sm hover:bg-gray-100 rounded">Set Sedang Berlangsung</button>
                                <button type="submit" name="status" value="selesai" class="block w-full text-left px-3 py-2 text-sm hover:bg-gray-100 rounded">Set Selesai</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-8 text-gray-500">
                Belum ada jadwal produksi yang aktif.
                <br>
                <a href="/admin/pesanan" class="text-blue-600 hover:underline">Cek pesanan yang sudah dibayar</a>
            </div>
            @endforelse
        </div>
    </div>
</div>

<script>
function toggleDropdown(id) {
    const dropdown = document.getElementById('dropdown-' + id);
    dropdown.classList.toggle('hidden');
    
    // Tutup dropdown lain
    document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
        if (el.id !== 'dropdown-' + id) {
            el.classList.add('hidden');
        }
    });
}

// Tutup dropdown ketika klik di luar
document.addEventListener('click', function(event) {
    if (!event.target.closest('.relative')) {
        document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
            el.classList.add('hidden');
        });
    }
});
</script>
</x-layout-admin>