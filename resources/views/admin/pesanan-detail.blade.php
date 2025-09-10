<x-layout-admin>
    <div class="max-w-3xl mx-auto p-8 mt-8 bg-white border border-blue-200 rounded-xl">
        <a href="/admin/pesanan" class="text-blue-600 text-sm font-semibold mb-4 inline-block">&larr; Kembali ke Daftar
            Pesanan</a>

        {{-- Header --}}
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6 flex items-center justify-between">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <span class="inline-block bg-blue-100 p-2 rounded-full">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2z" />
                        </svg>
                    </span>
                    <span class="text-xl font-bold">{{ $order->nama_proyek ?? '-' }}</span>
                </div>
                <div class="text-xs text-gray-500">ID: ORD-{{ str_pad($order->id, 3, '0', STR_PAD_LEFT) }}</div>
                <div class="text-xs text-gray-500 mt-1">
                    Pelanggan: <span class="font-semibold">{{ $order->user->name ?? '-' }}</span>
                </div>
            </div>

            @php
                // Normalisasi status agar konsisten
                $statusKey = strtolower($order->status ?? '');
                if ($statusKey === 'menunggu') {
                    $statusKey = 'menunggu konfirmasi';
                }

                $statusLabelMap = [
                    'menunggu konfirmasi' => ['label' => 'Menunggu Konfirmasi', 'color' => 'bg-yellow-400 text-white'],
                    'menunggu pembayaran' => ['label' => 'Menunggu Pembayaran', 'color' => 'bg-blue-500 text-white'],
                    'diproses' => ['label' => 'Diproses', 'color' => 'bg-gray-700 text-white'],
                    'selesai' => ['label' => 'Selesai', 'color' => 'bg-green-600 text-white'],
                    'ditolak' => ['label' => 'Ditolak', 'color' => 'bg-red-500 text-white'],
                    'antrian' => ['label' => 'Antrian', 'color' => 'bg-gray-400 text-white'],
                ];

                $label = $statusLabelMap[$statusKey]['label'] ?? ucfirst($order->status ?? 'Menunggu Konfirmasi');
                $color = $statusLabelMap[$statusKey]['color'] ?? 'bg-yellow-400 text-white';
            @endphp

            <div class="flex flex-col items-end gap-2">
                <div class="text-xs text-gray-500">Deadline</div>
                <div class="font-semibold">
                    {{ $order->tenggat ? \Carbon\Carbon::parse($order->tenggat)->format('d-m-Y') : '-' }}
                </div>
                <div class="text-xs text-gray-500 mt-2">Total</div>
                <div class="text-green-600 font-bold text-lg">
                    Rp {{ number_format((float) $order->budget, 0, ',', '.') }}
                </div>
                <span class="inline-block px-3 py-1 rounded {{ $color }} text-xs font-semibold mt-2">
                    {{ $label }}
                </span>
            </div>
        </div>

        {{-- Detail Pesanan --}}
        <div class="mb-6">
            <h3 class="font-semibold text-lg mb-2">Detail Pesanan</h3>
            <div class="mb-1">Jumlah: <span class="font-bold">{{ $order->kuantitas ?? '-' }} pieces</span></div>
            <div class="mb-1">Deskripsi: <span class="text-gray-700">{{ $order->deskripsi ?? '-' }}</span></div>
            @if ($order->desain)
                @php
                    $desainPath = $order->desain;
                    $fileExists = \Illuminate\Support\Facades\Storage::disk('public')->exists($desainPath);
                    $isSvg = \Illuminate\Support\Str::endsWith(strtolower($desainPath), '.svg');
                    $isImage = \Illuminate\Support\Str::endsWith(strtolower($desainPath), [
                        '.jpg',
                        '.jpeg',
                        '.png',
                        '.svg',
                    ]);
                    $fileUrl = '/storage/' . $desainPath;
                @endphp
                <div class="mt-2">
                    <div class="text-sm font-medium">Lampiran Desain:</div>
                    @if ($fileExists)
                        @if ($isSvg)
                            <object type="image/svg+xml" data="{{ $fileUrl }}"
                                class="max-w-xs border rounded mt-2"></object>
                        @elseif($isImage)
                            <img src="{{ $fileUrl }}" alt="Desain" class="max-w-xs border rounded mt-2">
                        @else
                            <a href="{{ $fileUrl }}" target="_blank"
                                class="text-blue-600 underline mt-2 inline-block">
                                Download Desain
                            </a>
                        @endif
                    @else
                        <span class="text-xs text-red-500">File desain tidak ditemukan.</span>
                    @endif
                </div>
            @endif
        </div>

        {{-- Info Pembayaran (dari orders.payment_info & orders.midtrans_tx_status) --}}
        @php
            $pi = (array) ($order->payment_info ?? []);
            $method = $order->payment_method_label ?? '-'; // accessor dari model
            $identity = $order->payment_identity ?? null; // accessor dari model
            $tx = strtoupper($order->midtrans_tx_status ?? '-'); // PENDING/SETTLEMENT/...
            $badge = 'bg-gray-100 text-gray-700';
            if ($tx === 'SETTLEMENT' || $tx === 'CAPTURE') {
                $badge = 'bg-green-100 text-green-800';
            } elseif ($tx === 'PENDING') {
                $badge = 'bg-yellow-100 text-yellow-800';
            } elseif (in_array($tx, ['EXPIRE', 'CANCEL', 'DENY'])) {
                $badge = 'bg-red-100 text-red-800';
            }
        @endphp

        <div class="mb-6">
            <h3 class="font-semibold text-lg mb-2">Info Pembayaran</h3>

            <div class="rounded-lg border border-gray-200 p-4 text-sm">
                @if (!empty($pi))
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        <div>Metode:
                            <span class="font-semibold">{{ $method }}</span>
                        </div>
                        <div>Status Midtrans:
                            <span class="inline-block px-2 py-0.5 rounded {{ $badge }}">
                                {{ $tx }}
                            </span>
                        </div>

                        @if ($identity)
                            <div class="sm:col-span-2">Identitas: {{ $identity }}</div>
                        @endif

                        @if (!empty($order->midtrans_order_id))
                            <div class="sm:col-span-2">
                                Midtrans Order ID: <code class="text-xs">{{ $order->midtrans_order_id }}</code>
                            </div>
                        @endif

                        @if (!empty($pi['transaction_time']))
                            <div>Waktu Transaksi:
                                {{ \Carbon\Carbon::parse($pi['transaction_time'])->setTimezone('Asia/Jakarta')->format('d-m-Y H:i') }}
                                WIB
                            </div>
                        @endif
                        @if (!empty($pi['settlement_time']))
                            <div>Waktu Settlement:
                                {{ \Carbon\Carbon::parse($pi['settlement_time'])->setTimezone('Asia/Jakarta')->format('d-m-Y H:i') }}
                                WIB
                            </div>
                        @endif
                    </div>

                    {{-- (Opsional) Tombol refresh status, aktifkan kalau kamu punya route-nya --}}
                    {{--
                <form method="post" action="{{ route('admin.payments.refresh', $order->midtrans_order_id) }}" class="mt-3">
                    @csrf
                    <button class="px-4 py-1.5 rounded border text-sm hover:bg-gray-50">
                        Refresh Status dari Midtrans
                    </button>
                </form>
                --}}
                @else
                    <div class="text-gray-600">
                        Belum ada info metode pembayaran yang tercatat.
                        @if ($statusKey === 'menunggu pembayaran')
                            Pengguna belum memilih/metode belum diproses, atau webhook belum diterima.
                        @endif
                    </div>
                @endif
            </div>
        </div>

        {{-- Form Update Status --}}
        <form method="POST" action="/admin/pesanan/{{ $order->id }}"
            class="bg-gray-50 border border-gray-200 rounded-lg p-6">
            @csrf
            @method('PUT')

            <h3 class="font-semibold text-lg mb-4">Konfirmasi Status Pesanan</h3>

            <div class="flex flex-col gap-2 mb-4">
                {{-- "diterima" di controller-mu sebaiknya dipetakan menjadi "menunggu pembayaran" --}}
                <label class="flex items-center gap-2">
                    <input type="radio" name="status" value="diterima"
                        {{ in_array(strtolower($order->status), ['diterima', 'menunggu pembayaran']) ? 'checked' : '' }}>
                    <span class="text-green-700">Terima Pesanan (Menunggu Pembayaran)</span>
                </label>

                <label class="flex items-center gap-2">
                    <input type="radio" name="status" value="diproses"
                        {{ strtolower($order->status) == 'diproses' ? 'checked' : '' }}>
                    <span class="text-blue-700">Proses Pesanan</span>
                </label>

                <label class="flex items-center gap-2">
                    <input type="radio" name="status" value="selesai"
                        {{ strtolower($order->status) == 'selesai' ? 'checked' : '' }}>
                    <span class="text-green-600">Pesanan Selesai</span>
                </label>

                <label class="flex items-center gap-2">
                    <input type="radio" name="status" value="ditolak"
                        {{ strtolower($order->status) == 'ditolak' ? 'checked' : '' }}>
                    <span class="text-red-600">Tolak Pesanan</span>
                </label>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Catatan (Opsional)</label>
                <textarea name="catatan" class="w-full border rounded px-3 py-2" rows="3"
                    placeholder="Tambahkan catatan untuk keputusan ini...">{{ $order->catatan ?? '' }}</textarea>
            </div>

            <div class="flex gap-3">
                <button type="submit"
                    class="px-6 py-2 rounded bg-[#1e335f] text-white font-semibold hover:bg-[#162547] transition">
                    Simpan Perubahan
                </button>
                <a href="/admin/pesanan"
                    class="px-6 py-2 rounded bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300 transition">
                    Batal
                </a>
            </div>

            @if (session('success'))
                <div class="mt-4 text-green-600 font-semibold">{{ session('success') }}</div>
            @endif
        </form>
    </div>
</x-layout-admin>
