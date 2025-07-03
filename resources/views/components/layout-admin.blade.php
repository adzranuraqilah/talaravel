<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
<div x-data="{ open: false }" class="min-h-screen flex">
    <!-- Sidebar -->
    <x-sidebar-admin />
    <!-- Overlay for mobile -->
    <div x-show="open" class="fixed inset-0 bg-black bg-opacity-30 z-20 md:hidden" @click="open = false"></div>
    <!-- Main Content -->
    <div class="flex-1 min-h-screen">
        <!-- Header (mobile only) -->
        <div class="md:hidden flex items-center justify-between px-4 py-3 bg-white border-b border-gray-100 sticky top-0 z-10">
            <div class="text-lg font-bold text-gray-800">Estetika.os</div>
            <button @click="open = !open" class="p-2 rounded hover:bg-gray-100 focus:outline-none">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
        <div class="m-0 p-0">
            {{ $slot }}
        </div>
    </div>
</div>
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>