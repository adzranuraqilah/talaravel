<x-layout-admin>
<div class="flex items-center justify-center min-h-screen bg-gray-900">
    <div class="bg-white rounded-xl shadow p-8 w-full max-w-md">
        <h2 class="text-lg font-semibold text-gray-800 mb-6">Edit Tools</h2>
        <form action="{{ route('admin.tools.update', $tool->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 mb-1">Nama Tools</label>
                <input type="text" name="nama" value="{{ $tool->nama }}" placeholder="Nama Tools" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#1e335f] focus:border-[#1e335f] text-base placeholder-gray-400" />
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 mb-1">Gambar Tools</label>
                @if($tool->gambar)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $tool->gambar) }}" alt="{{ $tool->nama }}" class="w-32 h-32 object-cover rounded border">
                        <p class="text-sm text-gray-500 mt-1">Gambar saat ini</p>
                    </div>
                @endif
                <label class="flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:bg-gray-50 transition">
                    <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                    <span class="text-gray-400">Klik untuk unggah gambar baru</span>
                    <input type="file" name="gambar" class="hidden" />
                </label>
            </div>
            <div class="flex justify-end gap-3">
                <a href="/admin/galeri" class="px-6 py-2 rounded bg-red-600 text-white font-semibold hover:bg-red-700 transition">Batal</a>
                <button type="submit" class="px-6 py-2 rounded bg-[#1e335f] text-white font-semibold hover:bg-[#162547] transition">Update</button>
            </div>
        </form>
    </div>
</div>
</x-layout-admin> 