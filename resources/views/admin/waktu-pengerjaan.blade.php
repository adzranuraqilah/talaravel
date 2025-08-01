<x-layout-admin>
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Waktu Pengerjaan</h1>
            <a href="{{ route('admin.waktu-pengerjaan.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                Tambah Waktu Pengerjaan
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[600px] text-sm">
                    <thead>
                        <tr class="border-b bg-gray-50">
                            <th class="py-3 px-4 text-left text-gray-600 font-semibold">No</th>
                            <th class="py-3 px-4 text-left text-gray-600 font-semibold">Produk</th>
                            <th class="py-3 px-4 text-left text-gray-600 font-semibold">Nama Waktu</th>
                            <th class="py-3 px-4 text-left text-gray-600 font-semibold">Durasi (Hari)</th>
                            <th class="py-3 px-4 text-left text-gray-600 font-semibold">Deskripsi</th>
                            <th class="py-3 px-4 text-left text-gray-600 font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($waktuPengerjaans as $index => $waktuPengerjaan)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-4">{{ $index + 1 }}</td>
                            <td class="py-3 px-4">
                                <span class="font-medium">{{ $waktuPengerjaan->produk->nama_produk }}</span>
                            </td>
                            <td class="py-3 px-4">
                                <span class="font-medium">{{ $waktuPengerjaan->nama_waktu }}</span>
                            </td>
                            <td class="py-3 px-4">
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-medium">
                                    {{ $waktuPengerjaan->durasi_hari }} hari
                                </span>
                            </td>
                            <td class="py-3 px-4 text-gray-600">
                                {{ Str::limit($waktuPengerjaan->deskripsi, 50) }}
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.waktu-pengerjaan.edit', $waktuPengerjaan->id) }}" 
                                       class="p-2 rounded hover:bg-blue-100 text-blue-600" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.waktu-pengerjaan.destroy', $waktuPengerjaan->id) }}" 
                                          method="POST" class="inline" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus waktu pengerjaan ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 rounded hover:bg-red-100 text-red-600" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-8 px-4 text-center text-gray-500">
                                Tidak ada data waktu pengerjaan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout-admin>