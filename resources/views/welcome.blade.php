@php
// Ambil data tools dari database
$tools = \App\Models\Tool::all();
// Jika tidak ada data tools, gunakan data default
if ($tools->count() == 0) {
    $tools = collect([
        ['img' => 'https://dummyimage.com/200x120/cccccc/333333&text=Screen', 'label' => 'Screen'],
        ['img' => 'https://dummyimage.com/200x120/cccccc/333333&text=Rakaf', 'label' => 'Rakaf'],
        ['img' => 'https://dummyimage.com/200x120/cccccc/333333&text=Tinta+Sablon', 'label' => 'Tinta Sablon'],
        ['img' => 'https://dummyimage.com/200x120/cccccc/333333&text=Sablon', 'label' => 'Sablon'],
        ['img' => 'https://dummyimage.com/200x120/cccccc/333333&text=Sablon', 'label' => 'Sablon'],
        ['img' => 'https://dummyimage.com/200x120/cccccc/333333&text=Setrika+Uap', 'label' => 'Setrika Uap'],
        ['img' => 'https://dummyimage.com/200x120/cccccc/333333&text=Benang+Jahit', 'label' => 'Benang Jahit'],
        ['img' => 'https://dummyimage.com/200x120/cccccc/333333&text=Tools', 'label' => 'Tools'],
        ['img' => 'https://dummyimage.com/200x120/cccccc/333333&text=Mesin+Jahit', 'label' => 'Mesin Jahit'],
        ['img' => 'https://dummyimage.com/200x120/cccccc/333333&text=Sablon', 'label' => 'Sablon'],
    ]);
}
// Ambil data portfolio dari database
$portfolios = \App\Models\GaleriPratinjau::all();
// Jika tidak ada data portfolio, gunakan data default
if ($portfolios->count() == 0) {
    $portfolios = collect([
        ['img' => 'https://dummyimage.com/200x120/eeeeee/333333&text=Portofolio+1', 'label' => 'Pinisi'],
        ['img' => 'https://dummyimage.com/200x120/eeeeee/333333&text=Portofolio+2', 'label' => 'Pinisi'],
        ['img' => 'https://dummyimage.com/200x120/eeeeee/333333&text=Portofolio+3', 'label' => 'Pinisi'],
        ['img' => 'https://dummyimage.com/200x120/eeeeee/333333&text=Portofolio+4', 'label' => 'Lentera'],
        ['img' => 'https://dummyimage.com/200x120/eeeeee/333333&text=Portofolio+5', 'label' => 'Lentera'],
        ['img' => 'https://dummyimage.com/200x120/eeeeee/333333&text=Portofolio+6', 'label' => 'Lentera'],
        ['img' => 'https://dummyimage.com/200x120/eeeeee/333333&text=Portofolio+7', 'label' => 'XXVI Pinisi'],
        ['img' => 'https://dummyimage.com/200x120/eeeeee/333333&text=Portofolio+8', 'label' => 'XXVI Pinisi'],
        ['img' => 'https://dummyimage.com/200x120/eeeeee/333333&text=Portofolio+9', 'label' => 'KKN 155'],
        ['img' => 'https://dummyimage.com/200x120/eeeeee/333333&text=Portofolio+10', 'label' => 'KKN 155'],
        ['img' => 'https://dummyimage.com/200x120/eeeeee/333333&text=Portofolio+11', 'label' => 'KKN 155'],
        ['img' => 'https://dummyimage.com/200x120/eeeeee/333333&text=Portofolio+12', 'label' => 'KKN 155'],
        ['img' => 'https://dummyimage.com/200x120/eeeeee/333333&text=Portofolio+13', 'label' => 'Militan Perun'],
        ['img' => 'https://dummyimage.com/200x120/eeeeee/333333&text=Portofolio+14', 'label' => 'Militan Perun'],
        ['img' => 'https://dummyimage.com/200x120/eeeeee/333333&text=Portofolio+15', 'label' => 'Our Tribal Rules'],
        ['img' => 'https://dummyimage.com/200x120/eeeeee/333333&text=Portofolio+16', 'label' => 'Our Tribal Rules'],
        ['img' => 'https://dummyimage.com/200x120/eeeeee/333333&text=Portofolio+17', 'label' => 'OPTIG'],
        ['img' => 'https://dummyimage.com/200x120/eeeeee/333333&text=Portofolio+18', 'label' => 'CIMSA FK UIN SH'],
    ]);
}
@endphp
<x-layout>
<div class="max-w-7xl mx-auto px-4 sm:px-8 md:px-12 lg:px-20 py-10">
    <!-- Hero Section -->
    <div class="flex flex-col md:flex-row items-center justify-between gap-8 mb-6">
        <div class="flex-1">
            <h1 class="text-3xl md:text-4xl font-extrabold text-[#1e335f] mb-2 leading-tight">Solusi Konveksi<br>Modern, Cepat, dan<br>Transparan!</h1>
            <p class="text-gray-700 mb-6">Mudah, Cepat dan Transparan dalam proses jahit-menjahit.</p>
        </div>
        <div class="flex-1 flex justify-center">
            <img src="{{ asset('/img/Mivace.png') }}" alt="Produk Kaos" class="w-[260px] md:w-[340px] object-contain">
        </div>
    </div>
    <div class="flex flex-col items-center">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 w-full max-w-3xl mb-12">
            <a href="/estimasi-harga" class="flex flex-col items-center justify-center gap-2 py-4 bg-white rounded-xl shadow border hover:bg-gray-50 hover:shadow-lg hover:scale-105 transition-all duration-200 w-full group">
                <span class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 mb-1 group-hover:bg-blue-100 transition-colors">
                    <svg class="w-6 h-6 text-[#1e335f] group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                </span>
                <span class="font-semibold text-[#1e335f] text-base">Cek Estimasi Harga</span>
            </a>
            <a href="/tender" class="flex flex-col items-center justify-center gap-2 py-4 bg-white rounded-xl shadow border hover:bg-gray-50 hover:shadow-lg hover:scale-105 transition-all duration-200 w-full group">
                <span class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 mb-1 group-hover:bg-blue-100 transition-colors">
                    <svg class="w-6 h-6 text-[#1e335f] group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v4a1 1 0 001 1h3m10-5h2a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h2m2 0V5a2 2 0 114 0v2m-4 0h4"/></svg>
                </span>
                <span class="font-semibold text-[#1e335f] text-base">Ajukan Pesanan</span>
            </a>
            <a href="/custom" class="flex flex-col items-center justify-center gap-2 py-4 bg-white rounded-xl shadow border hover:bg-gray-50 hover:shadow-lg hover:scale-105 transition-all duration-200 w-full group">
                <span class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 mb-1 group-hover:bg-blue-100 transition-colors">
                    <svg class="w-6 h-6 text-[#1e335f] group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                </span>
                <span class="font-semibold text-[#1e335f] text-base">Custom</span>
            </a>
            <a href="https://wa.me/6281234567890?text=Halo, saya ingin berkonsultasi tentang jasa konveksi" target="_blank" class="flex flex-col items-center justify-center gap-2 py-4 bg-white rounded-xl shadow border hover:bg-gray-50 hover:shadow-lg hover:scale-105 transition-all duration-200 w-full group">
                <span class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 mb-1 group-hover:bg-blue-100 transition-colors">
                    <svg class="w-6 h-6 text-[#1e335f] group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h2a2 2 0 012 2v10a2 2 0 01-2 2H3m0-14v14m0-14a2 2 0 012-2h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
                </span>
                <span class="font-semibold text-[#1e335f] text-base">Hubungi Admin</span>
            </a>
        </div>
    </div>

    <!-- Tools Section -->
    <div class="mb-12">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-bold text-[#1e335f]">Tools</h2>
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="/admin/galeri" class="text-blue-600 hover:text-blue-800 text-sm flex items-center gap-1">
                        Kelola Tools
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                @endif
            @endauth
        </div>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            @foreach($tools as $tool)
            <div class="bg-white rounded-lg shadow border overflow-hidden flex flex-col hover:shadow-lg hover:scale-105 transition-all duration-200 group cursor-pointer">
                @if(isset($tool->gambar) && $tool->gambar)
                    <img src="{{ asset('storage/' . $tool->gambar) }}" alt="{{ $tool->nama }}" class="w-full h-24 object-cover grayscale group-hover:grayscale-0 transition-all">
                @else
                    <img src="https://dummyimage.com/200x120/cccccc/333333&text={{ urlencode($tool->nama ?? 'Tool') }}" alt="{{ $tool->nama ?? 'Tool' }}" class="w-full h-24 object-cover grayscale group-hover:grayscale-0 transition-all">
                @endif
                <div class="p-2 flex-1 flex items-end">
                    <span class="text-xs font-medium text-gray-700 group-hover:text-[#1e335f] transition-colors">{{ $tool->nama ?? $tool['label'] ?? 'Tool' }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Portfolio Section -->
    <div>
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-bold text-[#1e335f]">Portofolio Kami</h2>
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="/admin/galeri" class="text-blue-600 hover:text-blue-800 text-sm flex items-center gap-1">
                        Kelola Portfolio
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                @endif
            @endauth
        </div>
        <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
            @foreach($portfolios as $portfolio)
            <div class="bg-white rounded-lg shadow border overflow-hidden flex flex-col hover:shadow-lg hover:scale-105 transition-all duration-200 group cursor-pointer">
                @if(isset($portfolio->foto_pratinjau) && $portfolio->foto_pratinjau)
                    <img src="{{ asset('storage/' . $portfolio->foto_pratinjau) }}" alt="{{ $portfolio->nama_produk }}" class="w-full h-24 object-cover group-hover:brightness-110 transition-all">
                @elseif(isset($portfolio['img']))
                    <img src="{{ $portfolio['img'] }}" alt="{{ $portfolio['label'] }}" class="w-full h-24 object-cover group-hover:brightness-110 transition-all">
                @else
                    <img src="https://dummyimage.com/200x120/eeeeee/333333&text={{ urlencode($portfolio->nama_produk ?? $portfolio['label'] ?? 'Portfolio') }}" alt="{{ $portfolio->nama_produk ?? $portfolio['label'] ?? 'Portfolio' }}" class="w-full h-24 object-cover group-hover:brightness-110 transition-all">
                @endif
                <div class="p-2 flex-1 flex items-end">
                    <span class="text-xs font-medium text-gray-700 group-hover:text-[#1e335f] transition-colors">{{ $portfolio->nama_produk ?? $portfolio['label'] ?? 'Portfolio' }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
</x-layout>
