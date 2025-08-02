<x-layout-admin>
    <div class="px-6 pt-6">
        <!-- Header & Tombol Tambah -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <div class="text-2xl font-bold text-gray-800">Sablon</div>
                <div class="text-gray-500 text-sm">Kelola data sablon</div>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('admin.sablon.create') }}" class="inline-flex items-center gap-2 px-4 py-2 border border-gray-200 rounded-lg text-gray-700 bg-white hover:bg-gray-100 font-medium shadow-sm transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Sablon
                </a>
            </div>
        </div>
    
        <!-- Alert Success -->
        @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
        @endif
        
        <!-- Tabel Sablon -->
        <div class="bg-white border border-gray-200 rounded-xl p-6">
            <div class="flex items-center gap-2 mb-4">
                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z"/>
                </svg>
                <span class="text-lg font-semibold text-gray-700">Daftar Sablon</span>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full min-w-[600px] text-sm">
                    <thead>
                        <tr class="border-b">
                            <th class="py-3 px-4 text-left text-gray-600 font-semibold">No</th>
                            <th class="py-3 px-4 text-left text-gray-600 font-semibold">Nama Sablon</th>
                            <th class="py-3 px-4 text-left text-gray-600 font-semibold">Deskripsi</th>
                            <th class="py-3 px-4 text-left text-gray-600 font-semibold">Tanggal Dibuat</th>
                            <th class="py-3 px-4 text-left text-gray-600 font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sablons as $index => $sablon)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-4">{{ $index + 1 }}</td>
                            <td class="py-3 px-4">
                                <span class="font-medium">{{ $sablon->nama_sablon }}</span>
                            </td>
                            <td class="py-3 px-4">
                                @if($sablon->deskripsi)
                                    <span class="text-gray-600">{{ Str::limit($sablon->deskripsi, 50) }}</span>
                                @else
                                    <span class="text-gray-400 italic">Tidak ada deskripsi</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-gray-500">
                                {{ $sablon->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.sablon.edit', $sablon->id) }}" class="p-2 rounded hover:bg-blue-100 text-blue-600" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.sablon.destroy', $sablon->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus sablon ini?')">
                                        @csrf
                                        @method('DELETE')
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
                            <td colspan="5" class="py-8 px-4 text-center text-gray-500">Tidak ada data sablon</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout-admin>