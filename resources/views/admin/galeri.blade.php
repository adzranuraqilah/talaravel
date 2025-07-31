<x-layout-admin>
<div class="flex">
    <!-- Sidebar otomatis dari layout-admin -->
    <div class="flex-1 p-8">
        <!-- Breadcrumb -->
        <div class="mb-4 flex items-center gap-2 text-sm text-gray-500">
            <a href="/" class="hover:text-blue-600">Beranda</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-gray-700 font-medium">Galeri</span>
        </div>
        
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-1">Galeri Portfolio Kami</h1>
                <p class="text-gray-500">Kelola Portfolio dan Tools</p>
                <div class="mt-2">
                    <a href="/" class="text-blue-600 hover:text-blue-800 text-sm flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Lihat di Beranda
                    </a>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <a href="/" class="text-blue-600 hover:text-blue-800 text-sm">Lihat di Beranda</a>
                <a href="/admin/portfolio/tambah" class="px-4 py-1.5 bg-gray-100 border border-gray-300 rounded text-sm font-medium hover:bg-gray-200">Tambah Portfolio</a>
            </div>
        </div>

        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-800">Galeri Tools</h2>
                <div class="flex items-center gap-2">
                    <a href="/" class="text-blue-600 hover:text-blue-800 text-sm">Lihat di Beranda</a>
                    <a href="/admin/tools/tambah" class="px-4 py-1.5 bg-gray-100 border border-gray-300 rounded text-sm font-medium hover:bg-gray-200">Tambah Tools</a>
                </div>
            </div>
            @php
            $tools = \App\Models\Tool::all();
            @endphp
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach ($tools as $tool)
                <div class="bg-white border border-gray-200 rounded-lg flex flex-col items-center p-4">
                    <div class="w-16 h-16 bg-gray-100 rounded flex items-center justify-center mb-2 overflow-hidden">
                        @if ($tool->gambar)
                            <img src="{{ asset('storage/' . $tool->gambar) }}" alt="{{ $tool->nama }}" class="object-cover w-16 h-16 rounded" />
                        @else
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 3v4M8 3v4" /></svg>
                        @endif
                    </div>
                    <div class="font-semibold text-gray-700 text-sm mb-2 text-center">{{ $tool->nama }}</div>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.tools.edit', $tool->id) }}" class="text-blue-600 text-xs font-semibold hover:underline">Edit</a>
                        <form action="{{ route('admin.tools.destroy', $tool->id) }}" method="POST" onsubmit="return confirm('Yakin hapus tool ini?')" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 text-xs font-semibold hover:underline">Hapus</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @if($galeri && $galeri->count())
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Galeri Portfolio Kami</h2>
                    <div class="flex items-center gap-2">
                        <a href="/" class="text-blue-600 hover:text-blue-800 text-sm">Lihat di Beranda</a>
                        <a href="/admin/portfolio/tambah" class="px-4 py-1.5 bg-gray-100 border border-gray-300 rounded text-sm font-medium hover:bg-gray-200">Tambah Portfolio</a>
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    @foreach ($galeri as $portfolio)
                    <div class="bg-white border border-gray-200 rounded-lg flex flex-col items-center p-4">
                        <div class="w-16 h-16 bg-gray-100 rounded flex items-center justify-center mb-2 overflow-hidden">
                            @if ($portfolio->foto_pratinjau)
                                <img src="{{ asset('storage/' . $portfolio->foto_pratinjau) }}" alt="{{ $portfolio->nama_produk }}" class="object-cover w-16 h-16 rounded" />
                            @else
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 3v4M8 3v4" /></svg>
                            @endif
                        </div>
                        <div class="font-semibold text-gray-700 text-sm mb-2 text-center">{{ $portfolio->nama_produk }}</div>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.portfolio.edit', $portfolio->id) }}" class="text-blue-600 text-xs font-semibold hover:underline">Edit</a>
                            <form action="{{ route('admin.portfolio.destroy', $portfolio->id) }}" method="POST" onsubmit="return confirm('Yakin hapus portfolio ini?')" style="display: inline;">
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
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Galeri Portfolio Kami</h2>
                    <div class="flex items-center gap-2">
                        <a href="/" class="text-blue-600 hover:text-blue-800 text-sm">Lihat di Beranda</a>
                        <a href="/admin/portfolio/tambah" class="px-4 py-1.5 bg-gray-100 border border-gray-300 rounded text-sm font-medium hover:bg-gray-200">Tambah Portfolio</a>
                    </div>
                </div>
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada portfolio</h3>
                    <p class="text-gray-500 mb-4">Tambah portfolio pertama Anda</p>
                    <a href="/admin/portfolio/tambah" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Tambah Portfolio</a>
                </div>
            </div>
        @endif
    </div>
</div>
</x-layout-admin> 