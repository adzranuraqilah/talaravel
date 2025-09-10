<x-layout>
    <div class="flex flex-col min-h-screen">
        <div class="flex-grow flex items-center justify-center">
            <div class="bg-white rounded-xl border border-gray-300 p-10 w-full max-w-xl mt-10 mb-10">
                <a href="#" onclick="window.history.back(); return false;"
                    class="inline-block mb-4 text-blue-600 hover:underline">&larr; Kembali</a>

                <h1 class="text-3xl font-bold text-center mb-6">Detail Pesanan</h1>

                @php
                    $statusKey = strtolower($order->status ?? '');
                    if ($statusKey === 'menunggu') {
                        $statusKey = 'menunggu konfirmasi';
                    }

                    $statusMap = [
                        'menunggu konfirmasi' => [
                            'label' => 'Menunggu Konfirmasi',
                            'class' => 'bg-yellow-400 text-white',
                        ],
                        'menunggu pembayaran' => [
                            'label' => 'Menunggu Pembayaran',
                            'class' => 'bg-blue-600 text-white',
                        ],
                        'diproses' => ['label' => 'Pesanan Diproses', 'class' => 'bg-gray-700 text-white'],
                        'selesai' => ['label' => 'Selesai', 'class' => 'bg-green-600 text-white'],
                        'ditolak' => ['label' => 'Ditolak', 'class' => 'bg-red-500 text-white'],
                    ];
                    $statusLabel = $statusMap[$statusKey]['label'] ?? ucfirst($order->status ?? '-');
                    $statusClass = $statusMap[$statusKey]['class'] ?? 'bg-gray-400 text-white';

                    // Ringkasan payment (disimpan via webhook)
                    $pi = (array) ($order->payment_info ?? []);
                    $method = strtoupper($pi['channel'] ?? ($pi['payment_type'] ?? '-'));

                    // Identitas ringkas buat ditampilkan
                    $identitas = null;
                    if (!empty($pi['va_last4']) && !empty($pi['bank'])) {
                        $identitas = 'VA ' . strtoupper($pi['bank']) . ' • ****' . $pi['va_last4'];
                    } elseif (!empty($pi['payment_code']) && !empty($pi['store'])) {
                        $identitas = strtoupper($pi['store']) . ' • Code ' . $pi['payment_code'];
                    } elseif (!empty($pi['masked_card'])) {
                        $jenis = $pi['card_type'] ?? 'credit';
                        $identitas = 'Kartu ' . $pi['masked_card'] . ' (' . strtoupper($jenis) . ')';
                    }
                @endphp

                <div class="space-y-2 text-sm">
                    <div class="font-bold text-lg">{{ $order->nama_proyek ?? '-' }}</div>

                    <div class="flex items-center gap-2">
                        <span>Status:</span>
                        <span class="inline-block px-3 py-0.5 rounded text-xs font-semibold {{ $statusClass }}">
                            {{ $statusLabel }}
                        </span>
                    </div>

                    <div>
                        Tanggal Pengajuan:
                        {{ $order->created_at ? $order->created_at->setTimezone('Asia/Jakarta')->format('d-m-Y H:i:s') . ' WIB' : '-' }}
                    </div>

                    <div>Jumlah: {{ $order->kuantitas ?? '-' }} pcs</div>

                    <div>
                        Harga: Rp
                        {{ $order->budget !== null ? number_format((float) $order->budget, 0, ',', '.') : '-' }}
                    </div>

                    <div>
                        Tenggat: {{ $order->tenggat ? \Carbon\Carbon::parse($order->tenggat)->format('d-m-Y') : '-' }}
                    </div>

                    <div>Deskripsi: {{ $order->deskripsi ?? '-' }}</div>

                    @if ($order->desain)
                        <div class="pt-2">
                            <div class="font-medium">Desain:</div>
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
                                <span class="text-red-500">File desain tidak ditemukan.</span>
                            @endif
                        </div>
                    @endif
                </div>

                {{-- Info Pembayaran (ditarik dari orders.payment_info) --}}
                <div class="mt-6">
                    <h2 class="text-lg font-semibold mb-2">Info Pembayaran</h2>

                    @if (!empty($pi))
                        <div class="rounded-lg border border-gray-200 p-3 text-sm space-y-1">
                            <div>Metode: <span class="font-semibold">{{ $method }}</span></div>
                            @if ($identitas)
                                <div>Identitas: {{ $identitas }}</div>
                            @endif
                            @if (!empty($order->midtrans_tx_status))
                                <div>Status Midtrans: <span
                                        class="font-semibold">{{ strtoupper($order->midtrans_tx_status) }}</span></div>
                            @endif
                            @if (!empty($pi['transaction_time']))
                                <div>Waktu Transaksi:
                                    {{ \Carbon\Carbon::parse($pi['transaction_time'])->setTimezone('Asia/Jakarta')->format('d-m-Y H:i') }}
                                    WIB</div>
                            @endif
                            @if (!empty($pi['settlement_time']))
                                <div>Waktu Settlement:
                                    {{ \Carbon\Carbon::parse($pi['settlement_time'])->setTimezone('Asia/Jakarta')->format('d-m-Y H:i') }}
                                    WIB</div>
                            @endif
                        </div>
                    @else
                        <div class="rounded-lg border border-gray-200 p-3 text-sm text-gray-600">
                            Belum ada info metode pembayaran yang tercatat.
                            @if ($statusKey === 'menunggu pembayaran')
                                Silakan klik <b>Bayar Sekarang</b> di bawah. Setelah kamu memilih metode di Snap dan
                                Midtrans
                                mengirim notifikasi, info akan tampil di sini (sandbox bisa butuh simulasi pembayaran).
                            @endif
                        </div>
                    @endif
                </div>

                {{-- Aksi --}}
                <div class="mt-6 space-y-3">
                    @if ($statusKey === 'menunggu pembayaran')
                        <button type="button" onclick="payNow()"
                            class="w-full bg-blue-900 text-white py-2 rounded-md font-semibold hover:bg-blue-800 transition">
                            Bayar Sekarang (Midtrans)
                        </button>
                        <p class="text-xs text-gray-500 text-center">
                            Setelah pembayaran berhasil, status akan berubah menjadi <b>Diproses</b> secara otomatis.
                            @if (config('midtrans.is_production') ? false : true)
                                <br>Sandbox: untuk VA/CStore, lakukan <i>simulate payment</i> di dashboard Midtrans agar
                                status jadi <b>settlement</b>.
                            @endif
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <footer class="bg-gray-50 py-8 border-t border-gray-200">
            <div
                class="max-w-6xl mx-auto px-4 flex flex-col md:flex-row justify-between items-start md:items-center gap-8">
                <!-- isi footer -->
            </div>
            <div class="text-center text-gray-400 text-xs mt-4">Copyright Estetika.Os</div>
        </footer>
    </div>

    {{-- Midtrans Snap JS --}}
    <script type="text/javascript"
        src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

    {{-- Script pembayaran --}}
    @if ($statusKey === 'menunggu pembayaran')
        <script>
            function payNow() {
                fetch('/api/payment/token', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            order_id: '{{ $order->id }}',
                            amount: '{{ (int) $order->budget }}'
                        }),
                        credentials: 'same-origin'
                    })
                    .then(r => r.json())
                    .then(data => {
                        if (!data || !data.token) {
                            alert('Gagal mengambil Snap Token.');
                            return;
                        }
                        window.snap.pay(data.token, {
                            onSuccess: function() {
                                alert('Pembayaran berhasil!');
                                location.reload();
                            },
                            onPending: function() {
                                alert('Menunggu pembayaran.');
                                location.reload();
                            },
                            onError: function(err) {
                                console.error(err);
                                alert('Pembayaran gagal.');
                            },
                            onClose: function() {
                                /* user menutup popup */ }
                        });
                    })
                    .catch(err => {
                        console.error(err);
                        alert('Terjadi kesalahan saat memulai pembayaran.');
                    });
            }
        </script>
    @endif
</x-layout>
