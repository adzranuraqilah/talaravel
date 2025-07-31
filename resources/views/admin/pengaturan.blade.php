<x-layout-admin>
<div class="px-6 pt-6 pb-10 max-w-3xl mx-auto">
    <!-- Header & Search -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <div class="text-2xl font-bold text-gray-800">Pengaturan</div>
            <div class="text-gray-500 text-sm">Kelola pengaturan sistem dan preferensi</div>
        </div>
    </div>

    <form method="POST" action="/admin/pengaturan">
        @csrf
        <!-- Profil Pengguna -->
        <div class="bg-white border border-gray-200 rounded-xl p-6 mb-6">
            <div class="flex items-center gap-2 mb-4">
                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle cx="12" cy="7" r="4"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 21v-2a4 4 0 014-4h0a4 4 0 014 4v2"/>
                </svg>
                <span class="text-lg font-semibold text-gray-700">Profil Pengguna</span>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">
                <div>
                    <label class="block text-gray-700 mb-1">Nama Perusahaan</label>
                    <input type="text" name="nama_perusahaan" value="{{ $setting->nama_perusahaan ?? '' }}" class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f]" />
                </div>
                <div>
                    <label class="block text-gray-700 mb-1">Nama Admin</label>
                    <input type="text" name="nama_admin" value="{{ $setting->nama_admin ?? ($user->name ?? '') }}" class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f]" />
                </div>
                <div>
                    <label class="block text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ $setting->email ?? ($user->email ?? '') }}" class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f]" />
                </div>
                <div>
                    <label class="block text-gray-700 mb-1">Nomor Telepon</label>
                    <input type="text" name="phone" value="{{ $setting->phone ?? ($user->phone ?? '') }}" class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f]" />
                </div>
            </div>
            <div>
                <label class="block text-gray-700 mb-1">Alamat</label>
                <input type="text" name="alamat" value="{{ $setting->alamat ?? ($user->alamat ?? '') }}" class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f]" />
            </div>
        </div>
        <!-- Notifikasi -->
        <div class="bg-white border border-gray-200 rounded-xl p-6 mb-6">
            <div class="flex items-center gap-2 mb-4">
                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
                <span class="text-lg font-semibold text-gray-700">Notifikasi</span>
            </div>
            <div class="flex items-center justify-between">
                <div>
                    <div class="font-semibold text-gray-700">Notifikasi Pesanan Baru</div>
                    <div class="text-gray-400 text-sm">Notifikasi saat ada pesanan baru</div>
                </div>
                <!-- Switch Toggle -->
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="notif_pesanan_baru" class="sr-only peer" {{ ($setting->notif_pesanan_baru ?? true) ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-blue-600 transition"></div>
                    <div class="absolute w-4 h-4 bg-white rounded-full left-1 top-1 peer-checked:translate-x-5 transition"></div>
                </label>
            </div>
        </div>
        <!-- Keamanan -->
        <div class="bg-white border border-gray-200 rounded-xl p-6 mb-6">
            <div class="flex items-center gap-2 mb-4">
                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <rect x="3" y="11" width="18" height="11" rx="2"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11V7a5 5 0 0110 0v4"/>
                </svg>
                <span class="text-lg font-semibold text-gray-700">Keamanan</span>
            </div>
            <div class="mb-3">
                <label class="block text-gray-700 mb-1">Password Saat Ini</label>
                <input type="password" name="password_saat_ini" class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f]" />
            </div>
            <div class="mb-3">
                <label class="block text-gray-700 mb-1">Password Baru</label>
                <input type="password" name="password_baru" class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f]" />
            </div>
            <div>
                <label class="block text-gray-700 mb-1">Konfirmasi Password Baru</label>
                <input type="password" name="password_baru_konfirmasi" class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f]" />
            </div>
        </div>
        <!-- Tombol Simpan -->
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-900 text-white px-5 py-2 rounded-lg font-semibold hover:bg-blue-800 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Simpan Pengaturan
            </button>
        </div>
    </form>
</div>
</x-layout-admin>