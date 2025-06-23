<x-layout>
<div class="max-w-md mx-auto mt-8 p-8 bg-white border border-gray-300 rounded-2xl" style="box-shadow:none;">
    <h2 class="text-2xl font-bold text-center mb-8">EDIT AKUN</h2>
    <form class="space-y-6">
        <div>
            <label class="block text-base font-medium text-gray-800 mb-1">Nama Lengkap</label>
            <input type="text" placeholder="Masukkan Nama Anda" class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-base placeholder-gray-400">
        </div>
        <div>
            <label class="block text-base font-medium text-gray-800 mb-1">Email</label>
            <input type="email" placeholder="Masukkan Email Anda" class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-base placeholder-gray-400">
        </div>
        <div>
            <label class="block text-base font-medium text-gray-800 mb-1">No. Telepon</label>
            <input type="text" placeholder="Masukkan No.Telepon Anda" class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-base placeholder-gray-400">
        </div>
        <div>
            <label class="block text-base font-medium text-gray-800 mb-1">Alamat</label>
            <textarea rows="3" placeholder="Masukkan Alamat Anda" class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-base placeholder-gray-400"></textarea>
        </div>
        <div class="flex justify-center gap-6 mt-8">
            <button type="button" class="px-8 py-2 rounded bg-red-600 text-white font-semibold hover:bg-red-700 transition">Batal</button>
            <button type="submit" class="px-8 py-2 rounded bg-[#1e335f] text-white font-semibold hover:bg-[#162547] transition">Simpan</button>
        </div>
    </form>
</div>
</x-layout> 