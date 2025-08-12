<x-layout-admin>
    <div class="px-6 pt-6">
        <!-- Header & Search -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <div class="text-2xl font-bold text-gray-800">Pesanan</div>
                <div class="text-gray-500 text-sm">Selamat datang di Admin Panel Konveksi Estetika.os</div>
                <div class="mt-2">
                    <a href="/admin/dashboard" class="text-blue-600 hover:text-blue-800 text-sm flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Dashboard
                    </a>
                </div>
            </div>

            <!-- Search (status aktif ikut dibawa) -->
            <form method="GET">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari pesanan, produk..."
                    class="w-72 px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-sm">
                <input type="hidden" name="status" value="{{ request('status', 'all') }}">
            </form>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div
                class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Breadcrumb -->
        <div class="mb-4 flex items-center gap-2 text-sm text-gray-500">
            <a href="/admin/dashboard" class="hover:text-blue-600">Dashboard</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="text-gray-700 font-medium">Pesanan</span>
        </div>

        <!-- FILTER STATUS -->
        @php
            // Daftar chip filter status
            $statusFilters = [
                'all' => ['label' => 'Semua'],
                'menunggu konfirmasi' => ['label' => 'Menunggu Konfirmasi'],
                'menunggu pembayaran' => ['label' => 'Menunggu Pembayaran'],
                'diproses' => ['label' => 'Diproses'],
                'selesai' => ['label' => 'Selesai'],
                'ditolak' => ['label' => 'Ditolak'],
                // 'antrian'             => ['label' => 'Antrian'],
            ];

            $activeStatusRaw = strtolower(request('status', 'all'));
            // Backward-compat: ?status=menunggu dianggap "menunggu konfirmasi"
            $activeStatus = $activeStatusRaw === 'menunggu' ? 'menunggu konfirmasi' : $activeStatusRaw;

            $baseQuery = request()->except('page', 'status'); // bawa query lain (mis. q) waktu ganti status
        @endphp

        <div class="mb-4">
            <div class="text-sm font-semibold text-gray-700 mb-2">Filter Status:</div>
            <div class="flex flex-wrap gap-3">
                @foreach ($statusFilters as $key => $meta)
                    @php
                        $isActive = $activeStatus === $key;
                        $query = array_merge($baseQuery, $key === 'all' ? [] : ['status' => $key]);
                        $href = url()->current() . (count($query) ? '?' . http_build_query($query) : '');
                        $pillBase =
                            'inline-flex items-center gap-2 px-4 py-1.5 rounded-full border text-xs font-medium transition';
                        $pillActive = 'bg-[#1e335f] text-white border-[#1e335f] shadow-sm';
                        $pillInactive = 'bg-gray-100 text-gray-700 border-gray-200 hover:bg-gray-200';
                    @endphp
                    <a href="{{ $href }}"
                        class="{{ $pillBase }} {{ $isActive ? $pillActive : $pillInactive }}">
                        {{ $meta['label'] }}
                        <span
                            class="ml-1 w-4 h-4 rounded-full border {{ $isActive ? 'bg-white border-white/20' : 'bg-white border-gray-300' }}"></span>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Daftar Pesanan -->
        <div class="bg-white border border-gray-200 rounded-xl p-6">
            <div class="text-xl font-semibold mb-4">Daftar Pesanan</div>

            @if ($orders->isEmpty())
                <div class="p-6 text-center border rounded-lg text-gray-500">
                    Belum ada pesanan untuk filter yang dipilih.
                </div>
            @else
                <div class="space-y-4">
                    @foreach ($orders as $order)
                        <div class="flex items-center justify-between border rounded-lg p-4">
                            <div class="flex items-center gap-4">
                                <div class="bg-white rounded-lg p-2 shadow">
                                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.35 2.7A2 2 0 007.52 19h8.96a2 2 0 001.87-2.3L17 13M9 21h6" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold text-base">KODE PESANAN: {{ $order->id }}</div>
                                    <div class="flex flex-wrap items-center gap-2 text-sm text-gray-500">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.847.607 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            {{ $order->user->name ?? '-' }}
                                        </span>
                                        <span>• {{ $order->nama_proyek ?? 'Pesanan' }}</span>
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ $order->created_at ? $order->created_at->setTimezone('Asia/Jakarta')->format('d-m-Y H:i:s') . ' WIB' : '-' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <div class="text-right">
                                    <div class="font-semibold text-gray-700">
                                        Rp {{ number_format((float) $order->budget, 0, ',', '.') }}
                                    </div>
                                    <div class="text-xs text-gray-400">{{ $order->kuantitas ?? 0 }} pcs</div>
                                </div>

                                @php
                                    $statusLabel = [
                                        'menunggu' => [
                                            'label' => 'Menunggu Konfirmasi',
                                            'color' => 'bg-yellow-400 text-white',
                                        ],
                                        'menunggu konfirmasi' => [
                                            'label' => 'Menunggu Konfirmasi',
                                            'color' => 'bg-yellow-400 text-white',
                                        ],
                                        'menunggu pembayaran' => [
                                            'label' => 'Menunggu Pembayaran',
                                            'color' => 'bg-blue-500 text-white',
                                        ],
                                        'diproses' => ['label' => 'Diproses', 'color' => 'bg-gray-700 text-white'],
                                        'selesai' => ['label' => 'Selesai', 'color' => 'bg-green-600 text-white'],
                                        'ditolak' => ['label' => 'Ditolak', 'color' => 'bg-red-500 text-white'],
                                        'antrian' => ['label' => 'Antrian', 'color' => 'bg-gray-400 text-white'],
                                    ];
                                    $statusKey = strtolower($order->status ?? '');
                                    $label =
                                        $statusLabel[$statusKey]['label'] ??
                                        ucfirst($order->status ?? 'Menunggu Konfirmasi');
                                    $color = $statusLabel[$statusKey]['color'] ?? 'bg-yellow-400 text-white';
                                @endphp

                                <span
                                    class="{{ $color }} text-xs font-semibold px-3 py-1 rounded">{{ $label }}</span>

                                {{-- Tombol ke Jadwal Produksi saat sudah diproses (atau selesai) --}}
                                @if (in_array($statusKey, ['diproses', 'selesai']))
                                    <a href="/admin/produksi?order_id={{ $order->id }}"
                                        class="px-3 py-1 text-xs rounded bg-purple-600 text-white hover:bg-purple-700">
                                        Lihat Jadwal
                                    </a>
                                @endif

                                <a href="/admin/pesanan/{{ $order->id }}" class="text-gray-500 hover:text-blue-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layout-admin>
