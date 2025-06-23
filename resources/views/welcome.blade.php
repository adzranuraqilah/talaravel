@php
$tools = [
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
];
$portofolio = [
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
];
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
            <img src="https://i.ibb.co/6wQk6kz/kaos-hero.png" alt="Produk Kaos" class="w-[260px] md:w-[340px] object-contain">
        </div>
    </div>
    <div class="flex flex-col items-center">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 w-full max-w-3xl mb-12">
            <button class="flex flex-col items-center justify-center gap-2 py-4 bg-white rounded-xl shadow border hover:bg-gray-50 transition w-full">
                <span class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 mb-1">
                    <svg class="w-6 h-6 text-[#1e335f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                </span>
                <span class="font-semibold text-[#1e335f] text-base">Cek Estimasi Harga</span>
            </button>
            <button class="flex flex-col items-center justify-center gap-2 py-4 bg-white rounded-xl shadow border hover:bg-gray-50 transition w-full">
                <span class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 mb-1">
                    <svg class="w-6 h-6 text-[#1e335f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v4a1 1 0 001 1h3m10-5h2a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h2m2 0V5a2 2 0 114 0v2m-4 0h4"/></svg>
                </span>
                <span class="font-semibold text-[#1e335f] text-base">Ajukan Tender</span>
            </button>
            <button class="flex flex-col items-center justify-center gap-2 py-4 bg-white rounded-xl shadow border hover:bg-gray-50 transition w-full">
                <span class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 mb-1">
                    <svg class="w-6 h-6 text-[#1e335f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                </span>
                <span class="font-semibold text-[#1e335f] text-base">Custom</span>
            </button>
            <button class="flex flex-col items-center justify-center gap-2 py-4 bg-white rounded-xl shadow border hover:bg-gray-50 transition w-full">
                <span class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 mb-1">
                    <svg class="w-6 h-6 text-[#1e335f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h2a2 2 0 012 2v10a2 2 0 01-2 2H3m0-14v14m0-14a2 2 0 012-2h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
                </span>
                <span class="font-semibold text-[#1e335f] text-base">Hubungi Admin</span>
            </button>
        </div>
    </div>

    <!-- Tools Section -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-[#1e335f] mb-4">Tools</h2>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            @foreach($tools as $tool)
            <div class="bg-white rounded-lg shadow border overflow-hidden flex flex-col">
                <img src="{{$tool['img']}}" alt="{{$tool['label']}}" class="w-full h-24 object-cover grayscale">
                <div class="p-2 flex-1 flex items-end">
                    <span class="text-xs font-medium text-gray-700">{{$tool['label']}}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Portfolio Section -->
    <div>
        <h2 class="text-2xl font-bold text-[#1e335f] mb-4">Portofolio Kami</h2>
        <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
            @foreach($portofolio as $item)
            <div class="bg-white rounded-lg shadow border overflow-hidden flex flex-col">
                <img src="{{$item['img']}}" alt="{{$item['label']}}" class="w-full h-24 object-cover">
                <div class="p-2 flex-1 flex items-end">
                    <span class="text-xs font-medium text-gray-700">{{$item['label']}}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
</x-layout>