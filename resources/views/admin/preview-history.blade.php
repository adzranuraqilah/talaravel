<x-layout-admin>
<div class="flex">
    <!-- Sidebar otomatis dari layout-admin -->
    <div class="flex-1 p-8">
        <!-- Breadcrumb -->
        <div class="mb-4 flex items-center gap-2 text-sm text-gray-500">
            <a href="/admin/galeri" class="hover:text-blue-600">Galeri</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-gray-700 font-medium">Riwayat Foto Pratinjau</span>
        </div>
        
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-1">Riwayat Foto Pratinjau</h1>
                <p class="text-gray-500">Kelola foto pratinjau untuk produk</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="/admin/galeri" class="text-blue-600 hover:text-blue-800 text-sm">Kembali ke Galeri</a>
                <a href="/admin/preview/upload" class="px-4 py-1.5 bg-gray-100 border border-gray-300 rounded text-sm font-medium hover:bg-gray-200">Upload Foto Pratinjau</a>
            </div>
        </div>

        @if($previewHistory->count())
            <div class="mb-8">
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    @foreach($previewHistory as $item)
                        <div class="bg-white border border-gray-200 rounded-lg flex flex-col items-center p-4">
                            <div class="w-16 h-16 bg-gray-100 rounded flex items-center justify-center mb-2 overflow-hidden">
                                <img src="{{ asset('storage/'.$item->foto_pratinjau) }}" class="object-cover w-16 h-16 rounded" alt="{{ $item->nama_produk }}">
                            </div>
                            <div class="font-semibold text-gray-700 text-sm mb-2 text-center">{{ $item->nama_produk }}</div>
                            <div class="text-xs text-gray-500 mb-2">{{ ucfirst($item->jenis_produk) }}</div>
                            <div class="flex gap-2">
                                <a href="{{ route('admin.preview.edit', $item->id) }}" class="text-blue-600 text-xs font-semibold hover:underline">Edit</a>
                                <form action="{{ route('admin.preview.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus foto pratinjau ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 text-xs font-semibold hover:underline">Hapus</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada foto pratinjau</h3>
                <p class="text-gray-500 mb-4">Upload foto pratinjau untuk produk Anda</p>
                <a href="/admin/preview/upload" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Upload Foto Pratinjau</a>
            </div>
        @endif
    </div>
</div>
</x-layout-admin> 