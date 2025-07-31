<x-layout-admin>
<div class="flex">
    <div class="flex-1 p-8">
        <!-- Breadcrumb -->
        <div class="mb-4 flex items-center gap-2 text-sm text-gray-500">
            <span class="text-gray-700 font-medium">Dashboard</span>
        </div>
        
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-1">Dashboard</h1>
                <p class="text-gray-500">Selamat datang di Admin Panel Konveksi Estetika.os</p>
                <div class="mt-2">
                    <a href="/admin/pesanan" class="text-blue-600 hover:text-blue-800 text-sm flex items-center gap-1">
                        Lihat Semua Pesanan
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>
            <form method="GET">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari pesanan, produk..." class="w-80 px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-sm" />
            </form>
        </div>
        <div class="grid grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-center">
                <div class="text-sm text-gray-500 mb-1">Total Pesanan</div>
                <div class="text-2xl font-bold">{{ $totalPesanan }}</div>
            </div>
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-center">
                <div class="text-sm text-gray-500 mb-1">Pelanggan</div>
                <div class="text-2xl font-bold">{{ $totalPelanggan }}</div>
            </div>
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-center">
                <div class="text-sm text-gray-500 mb-1">Pendapatan</div>
                <div class="text-2xl font-bold">Rp. {{ number_format($totalPendapatan,0,',','.') }}</div>
            </div>
        </div>
        <div class="flex gap-8">
            <div class="flex-1">
                <div class="bg-white rounded-xl shadow p-6 mb-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold">Pesanan Terbaru</h2>
                        <a href="/admin/pesanan" class="text-blue-600 hover:text-blue-800 text-sm">Lihat Semua</a>
                    </div>
                    @foreach($pesananTerbaru as $order)
                        <a href="/admin/pesanan/{{ $order->id }}" class="block mb-4 p-4 bg-gray-50 rounded flex flex-col gap-1 hover:bg-gray-100 transition">
                            <div class="font-semibold text-base">Kode Pesanan: <span class="font-normal">{{ $order->id ?? '-' }}</span></div>
                            <div class="text-sm text-gray-700">Nama Pelanggan: {{ $order->user->name ?? '-' }}</div>
                            <div class="text-sm text-gray-500">Kategori Produk: {{ $order->nama_proyek ?? '-' }} . Kuantitas: {{ $order->kuantitas ?? '-' }}</div>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="text-xs text-gray-400">{{ $order->created_at ? $order->created_at->setTimezone('Asia/Jakarta')->format('d/m/Y H:i:s') . ' WIB' : '-' }}</span>
                                @php
                                    $statusLabel = [
                                        'menunggu' => ['label' => 'Menunggu Konfirmasi', 'color' => 'bg-yellow-400 text-white'],
                                        'menunggu pembayaran' => ['label' => 'Menunggu Pembayaran', 'color' => 'bg-blue-500 text-white'],
                                        'diproses' => ['label' => 'Diproses', 'color' => 'bg-gray-700 text-white'],
                                        'selesai' => ['label' => 'Selesai', 'color' => 'bg-green-600 text-white'],
                                        'ditolak' => ['label' => 'Ditolak', 'color' => 'bg-red-500 text-white'],
                                        'antrian' => ['label' => 'Antrian', 'color' => 'bg-gray-400 text-white'],
                                    ];
                                    $statusKey = strtolower($order->status ?? '');
                                    $label = $statusLabel[$statusKey]['label'] ?? ucfirst($order->status ?? 'Menunggu Konfirmasi');
                                    $color = $statusLabel[$statusKey]['color'] ?? 'bg-yellow-400 text-white';
                                @endphp
                                <span class="ml-auto text-sm font-semibold px-3 py-1 rounded {{ $color }}">{{ $label }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="w-72">
                <div class="bg-white rounded-xl shadow p-6">
                    <h2 class="text-lg font-semibold mb-4">Status Pesanan</h2>
                    <div class="flex flex-col gap-2">
                        @foreach($status as $label => $jumlah)
                            <div class="flex justify-between text-sm">
                                <span>{{ $label }}</span>
                                <span>{{ $jumlah }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-layout-admin> 