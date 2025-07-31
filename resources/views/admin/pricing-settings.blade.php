<x-layout-admin>
<div class="px-6 pt-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Pengaturan Harga</h1>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white border border-gray-300 rounded-xl p-6">
        <form action="/admin/pricing-settings" method="POST" class="space-y-8">
            @csrf
            @method('PUT')
            
            <!-- Sablon Pricing -->
            <div class="border-b border-gray-200 pb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Harga Sablon</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Plastisol (Rp)</label>
                        <input type="number" name="sablon_plastisol" value="{{ $sablonPricing['plastisol'] ?? 20000 }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Rubber (Rp)</label>
                        <input type="number" name="sablon_rubber" value="{{ $sablonPricing['rubber'] ?? 15000 }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">DTG (Rp)</label>
                        <input type="number" name="sablon_dtg" value="{{ $sablonPricing['dtg'] ?? 30000 }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Bordir (Rp)</label>
                        <input type="number" name="sablon_bordir" value="{{ $sablonPricing['bordir'] ?? 15000 }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Max Patch Bordir</label>
                        <input type="number" name="sablon_bordir_max_patch" value="{{ $sablonPricing['bordir_max_patch'] ?? 3 }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            <!-- Additional Costs -->
            <div class="border-b border-gray-200 pb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Biaya Tambahan</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Hangtag (Rp)</label>
                        <input type="number" name="additional_hangtag" value="{{ $additionalCosts['hangtag'] ?? 500 }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Woven (Rp)</label>
                        <input type="number" name="additional_woven" value="{{ $additionalCosts['woven'] ?? 500 }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Label Brand Sablon (Rp)</label>
                        <input type="number" name="additional_label_brand_sablon" value="{{ $additionalCosts['label_brand_sablon'] ?? 1000 }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            <!-- Quantity Discounts -->
            <div class="border-b border-gray-200 pb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Diskon Kuantitas</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Minimal Kuantitas</label>
                        <input type="number" name="quantity_min" value="{{ $quantityDiscounts['min_quantity'] ?? 24 }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Diskon per 100 Pcs (Rp)</label>
                        <input type="number" name="quantity_discount_per_100" value="{{ $quantityDiscounts['discount_per_100'] ?? 5000 }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Threshold Diskon</label>
                        <input type="number" name="quantity_threshold" value="{{ $quantityDiscounts['discount_threshold'] ?? 100 }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            <!-- Express Pricing -->
            <div class="border-b border-gray-200 pb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Layanan Express</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Biaya Express per Pcs (Rp)</label>
                        <input type="number" name="express_cost_per_piece" value="{{ $expressPricing['express_cost_per_piece'] ?? 10000 }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pengurangan Waktu Express</label>
                        <input type="text" name="express_time_reduction" value="{{ $expressPricing['express_time_reduction'] ?? '1 minggu' }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            <!-- Working Time Settings -->
            <div class="border-b border-gray-200 pb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Waktu Pengerjaan</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kaos</label>
                        <input type="text" name="working_time_kaos" value="{{ $workingTimeSettings['kaos'] ?? '2 minggu' }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Hoodie</label>
                        <input type="text" name="working_time_hoodie" value="{{ $workingTimeSettings['hoodie'] ?? '2 minggu' }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kemeja</label>
                        <input type="text" name="working_time_kemeja" value="{{ $workingTimeSettings['kemeja'] ?? '3 minggu' }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Almamater</label>
                        <input type="text" name="working_time_almamater" value="{{ $workingTimeSettings['almamater'] ?? '3 minggu' }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jaket</label>
                        <input type="text" name="working_time_jaket" value="{{ $workingTimeSettings['jaket'] ?? '2 minggu' }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Threshold Kuantitas Besar</label>
                        <input type="number" name="working_time_large_threshold" value="{{ $workingTimeSettings['large_quantity_threshold'] ?? 300 }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pengali Waktu Kuantitas Besar</label>
                        <input type="number" step="0.1" name="working_time_large_multiplier" value="{{ $workingTimeSettings['large_quantity_multiplier'] ?? 1.5 }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Simpan Pengaturan
                </button>
                <a href="/admin/dashboard" class="px-6 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
</x-layout-admin> 