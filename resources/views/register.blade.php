<x-layout>
<div class="max-w-lg mx-auto mt-8 p-8 bg-white border border-gray-300 rounded-2xl" style="box-shadow:none;">
    <div class="mb-8">
        <h2 class="text-4xl font-extrabold text-gray-700 mb-2">Daftar</h2>
        <p class="text-gray-600 text-base">Daftar untuk mengakses akunmu</p>
    </div>
    <form class="space-y-5">
        <div>
            <input type="text" placeholder="Masukkan Nama" class="block w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-base">
        </div>
        <div>
            <input type="text" placeholder="Masukkan No Telepon" class="block w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-base">
        </div>
        <div>
            <input type="email" placeholder="Masukkan E-Mail" class="block w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-base">
        </div>
        <div class="relative">
            <input type="password" placeholder="Masukkan Kata Sandi" class="block w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-base pr-10">
            <span class="absolute inset-y-0 right-3 flex items-center cursor-pointer">
                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2"/><circle cx="12" cy="12" r="3" stroke-width="2"/></svg>
            </span>
        </div>
        <div class="relative">
            <input type="password" placeholder="Konfirmasi Kata Sandi" class="block w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-base pr-10">
            <span class="absolute inset-y-0 right-3 flex items-center cursor-pointer">
                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2"/><circle cx="12" cy="12" r="3" stroke-width="2"/></svg>
            </span>
        </div>
        <div class="flex items-center mt-2">
            <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600">
            <label class="ml-2 text-sm text-gray-800 select-none">
                Saya Menyetujui <a href="#" class="font-bold text-[#1e335f] hover:underline">Syarat & Ketentuan</a> Yang Berlaku
            </label>
        </div>
        <div class="text-center mt-4 mb-2">
            <span class="text-gray-700 text-base">Sudah punya akun? </span>
            <a href="#" class="font-bold text-[#1e335f] hover:underline">Login</a>
        </div>
        <button type="submit" class="w-full py-3 rounded-md bg-[#384967] text-white font-semibold text-base hover:bg-[#22304a] transition">Daftar</button>
    </form>
</div>
</x-layout> 