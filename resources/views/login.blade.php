<x-layout>
<div class="max-w-lg mx-auto mt-8 p-8 bg-white border border-gray-300 rounded-2xl" style="box-shadow:none;">
    <div class="mb-8">
        <h2 class="text-4xl font-extrabold text-gray-700 mb-2">MASUK</h2>
        <p class="text-gray-600 text-base">Masuk untuk mengakses akunmu</p>
    </div>
    @if(session('error'))
        <div class="mb-4 text-red-600 font-semibold">{{ session('error') }}</div>
    @endif
    <form class="space-y-6" method="POST" action="/login">
        @csrf
        <div>
            <input type="email" name="email" placeholder="Email" class="block w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-base" required>
        </div>
        <div>
            <input type="password" name="password" placeholder="Password" class="block w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-base" required>
        </div>
        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2">
                <input type="checkbox" name="remember" class="form-checkbox h-5 w-5 text-blue-600">
                <span class="text-gray-700 text-base">Ingat Saya</span>
            </label>
            <a href="#" class="text-[#1e335f] text-base hover:underline">Lupa Password</a>
        </div>
        <button type="submit" class="w-full py-3 rounded-md bg-[#384967] text-white font-semibold text-base hover:bg-[#22304a] transition">Masuk</button>
    </form>
    <div class="mt-16 text-center">
        <span class="text-gray-700 text-base">Tidak punya akun? </span>
        <a href="#" class="font-bold text-[#1e335f] hover:underline">Daftar</a>
    </div>
</div>
</x-layout> 