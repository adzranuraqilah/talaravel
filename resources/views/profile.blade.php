<x-layout>
    <div class="max-w-3xl mx-auto py-10 px-4">
        @if (session('success'))
            <div class="mb-4 text-green-600 font-semibold">{{ session('success') }}</div>
        @endif

        <div class="flex items-center gap-6 mb-8">
            <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center text-3xl text-gray-400">
                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle cx="12" cy="8" r="4" />
                    <path d="M6 20c0-2.2 3.6-3.5 6-3.5s6 1.3 6 3.5v1H6v-1z" />
                </svg>
            </div>
            <div>
                <div class="text-xl font-bold">{{ $user->name ?? '-' }}</div>
                <div class="text-gray-600">{{ $user->email ?? '-' }}</div>
                <div class="text-gray-500 text-sm">{{ $user->phone ?? '-' }}</div>

                <button class="mt-2 px-4 py-1 bg-[#1e335f] text-white rounded hover:bg-[#162547] transition"
                    onclick="document.getElementById('edit-form').classList.toggle('hidden')">Edit Akun</button>

                <form method="POST" action="/logout" class="inline-block ml-2">
                    @csrf
                    <button type="submit"
                        class="px-4 py-1 bg-red-500 text-white rounded hover:bg-red-700 transition">Logout</button>
                </form>
            </div>
        </div>

        <!-- Form Edit Akun -->
        <div id="edit-form" class="hidden mb-8">
            <form method="POST" action="/profile/update"
                class="bg-gray-50 border border-gray-200 rounded-lg p-6 max-w-md mx-auto">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Nama</label>
                    <input type="text" name="name" value="{{ $user->name }}"
                        class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}"
                        class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">No. Telepon</label>
                    <input type="text" name="phone" value="{{ $user->phone }}"
                        class="w-full border rounded px-3 py-2">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Alamat</label>
                    <input type="text" name="alamat" value="{{ $user->alamat }}"
                        class="w-full border rounded px-3 py-2">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Password Baru (opsional)</label>
                    <input type="password" name="password" class="w-full border rounded px-3 py-2"
                        placeholder="Biarkan kosong jika tidak ingin mengubah password">
                </div>
                <div class="flex gap-3">
                    <button type="submit"
                        class="px-6 py-2 rounded bg-[#1e335f] text-white font-semibold hover:bg-[#162547] transition">Simpan
                        Perubahan</button>
                    <button type="button" onclick="document.getElementById('edit-form').classList.add('hidden')"
                        class="px-6 py-2 rounded bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300 transition">Batal</button>
                </div>
            </form>
        </div>

        <!-- Statistik Pesanan -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-gray-100 rounded-lg p-4 text-center">
                <div class="text-2xl font-bold">{{ $tenderDiajukan }}</div>
                <div class="text-gray-600 text-sm">Pesanan Diajukan</div>
            </div>
            <div class="bg-gray-100 rounded-lg p-4 text-center">
                <div class="text-2xl font-bold">{{ $tenderDiterima }}</div>
                <div class="text-gray-600 text-sm">Pesanan Diterima</div>
            </div>
            <div class="bg-gray-100 rounded-lg p-4 text-center">
                <div class="text-2xl font-bold">{{ $tenderSelesai }}</div>
                <div class="text-gray-600 text-sm">Pesanan Selesai</div>
            </div>
        </div>

        @php
            // Map status => [label, warna]
            function status_badge($status)
            {
                $map = [
                    'menunggu' => ['Menunggu Konfirmasi', 'bg-yellow-400'],
                    'menunggu konfirmasi' => ['Menunggu Konfirmasi', 'bg-yellow-400'],
                    'menunggu pembayaran' => ['Menunggu Pembayaran', 'bg-blue-500'],
                    'diproses' => ['Pesanan Diproses', 'bg-gray-700'],
                    'ditolak' => ['Ditolak', 'bg-red-500'],
                    'selesai' => ['Selesai', 'bg-green-600'],
                ];
                $key = strtolower($status ?? '');
                return $map[$key] ?? ['-', 'bg-gray-400'];
            }
        @endphp

        <!-- Riwayat Pesanan Instansi -->
        <div class="mb-4 text-lg font-semibold">Riwayat Pesanan Instansi</div>
        <div class="space-y-4">
            @forelse($riwayat->where('tipe', 'tender') as $order)
                @php [$lbl, $bg] = status_badge($order->status); @endphp
                <a href="/order/{{ $order->id }}"
                    class="block bg-gray-100 rounded-lg p-4 border hover:bg-blue-50 transition">
                    <div class="flex justify-between items-center mb-2">
                        <div class="font-bold">{{ $order->nama_proyek ?? '-' }}</div>
                        <div class="text-sm text-gray-700">Pelanggan : {{ $order->user->name ?? '-' }}</div>
                    </div>
                    <div class="text-sm text-gray-700">Instansi : {{ $order->instansi ?? '-' }}</div>
                    <div class="text-sm text-gray-700">Tanggal Pengajuan :
                        {{ $order->created_at ? $order->created_at->setTimezone('Asia/Jakarta')->format('d-m-Y H:i:s') . ' WIB' : '-' }}
                    </div>
                    <div class="text-sm text-gray-700">Jumlah : {{ $order->kuantitas ?? '-' }}</div>
                    <div class="text-sm text-gray-700">Harga : Rp
                        {{ $order->budget && $order->budget > 0 ? number_format((float) $order->budget, 0, ',', '.') : '-' }}
                    </div>
                    <div class="text-sm text-gray-700">Detail Pesanan : {{ $order->deskripsi ?? '-' }}</div>

                    <span
                        class="{{ $bg }} text-white text-xs font-semibold px-3 py-1 rounded">{{ $lbl }}</span>
                </a>
            @empty
                <p class="text-gray-500">Belum ada pesanan Instansi yang diajukan.</p>
            @endforelse
        </div>

        <!-- Riwayat Pesanan Personal -->
        <div class="mt-10 mb-4 text-lg font-semibold">Riwayat Pesanan Personal</div>
        <div class="space-y-4">
            @forelse($riwayat->where('tipe', 'personal') as $order)
                @php [$lbl, $bg] = status_badge($order->status); @endphp
                <a href="/order/{{ $order->id }}"
                    class="block bg-gray-100 rounded-lg p-4 border hover:bg-blue-50 transition">
                    <div class="flex justify-between items-center mb-2">
                        <div class="font-bold">{{ $order->nama_proyek ?? '-' }}</div>
                        <div class="text-sm text-gray-700">Pelanggan : {{ $order->user->name ?? '-' }}</div>
                    </div>
                    <div class="text-sm text-gray-700">Instansi : {{ $order->instansi ?? '-' }}</div>
                    <div class="text-sm text-gray-700">Tanggal Pengajuan :
                        {{ $order->created_at ? $order->created_at->setTimezone('Asia/Jakarta')->format('d-m-Y H:i:s') . ' WIB' : '-' }}
                    </div>
                    <div class="text-sm text-gray-700">Jumlah : {{ $order->kuantitas ?? '-' }}</div>
                    <div class="text-sm text-gray-700">Harga : Rp
                        {{ $order->budget && $order->budget > 0 ? number_format((float) $order->budget, 0, ',', '.') : '-' }}
                    </div>
                    <div class="text-sm text-gray-700">Detail Pesanan : {{ $order->deskripsi ?? '-' }}</div>

                    <span
                        class="{{ $bg }} text-white text-xs font-semibold px-3 py-1 rounded">{{ $lbl }}</span>
                </a>
            @empty
                <p class="text-gray-500">Belum ada pesanan personal.</p>
            @endforelse
        </div>
    </div>
</x-layout>
