<nav class="bg-white" x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 md:px-12 lg:px-20">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="/" class="flex items-center">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-10 w-10">
                </a>
            </div>
            <!-- Desktop Navigation Links -->
            <div class="hidden md:flex items-center space-x-10">
                <a href="/" class="{{ Request::is('/') ? 'font-bold text-[#1e335f]' : 'text-gray-500 hover:text-[#1e335f]' }} px-2 py-2 text-base">Beranda</a>
                <a href="/estimasi-harga" class="{{ Request::is('estimasi-harga') ? 'font-bold text-[#1e335f]' : 'text-gray-500 hover:text-[#1e335f]' }} px-2 py-2 text-base">Harga</a>
                <a href="/tender" class="{{ Request::is('tender') ? 'font-bold text-[#1e335f]' : 'text-gray-500 hover:text-[#1e335f]' }} px-2 py-2 text-base">Tender</a>
                <a href="/custom" class="{{ Request::is('custom') ? 'font-bold text-[#1e335f]' : 'text-gray-500 hover:text-[#1e335f]' }} px-2 py-2 text-base">Custom</a>
                <a href="/profile" class="{{ Request::is('profile') ? 'font-bold text-[#1e335f]' : 'text-gray-500 hover:text-[#1e335f]' }} px-2 py-2 text-base">
                <span class="ml-6 flex items-center">
                    <span class="w-8 h-8 rounded-full bg-blue-200 flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20"><path d="M10 10a4 4 0 100-8 4 4 0 000 8zm0 2c-4 0-6 2-6 4v1a1 1 0 001 1h10a1 1 0 001-1v-1c0-2-2-4-6-4z"/></svg>
                    </span>
                </span>
                </a>
            </div>
            <!-- Mobile Hamburger -->
            <div class="md:hidden flex items-center">
                <button @click="open = !open" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-[#1e335f] focus:outline-none">
                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- Mobile Menu -->
    <div class="md:hidden" x-show="open" x-transition>
        <div class="px-4 pt-2 pb-4 space-y-2 bg-white shadow">
            <a href="/" class="block {{ Request::is('/') ? 'font-bold text-[#1e335f]' : 'text-gray-500 hover:text-[#1e335f]' }} px-2 py-2 text-base">Beranda</a>
            <a href="/estimasi-harga" class="block {{ Request::is('estimasi-harga') ? 'font-bold text-[#1e335f]' : 'text-gray-500 hover:text-[#1e335f]' }} px-2 py-2 text-base">Harga</a>
            <a href="/tender" class="block {{ Request::is('tender') ? 'font-bold text-[#1e335f]' : 'text-gray-500 hover:text-[#1e335f]' }} px-2 py-2 text-base">Tender</a>
            <a href="/custom" class="block {{ Request::is('custom') ? 'font-bold text-[#1e335f]' : 'text-gray-500 hover:text-[#1e335f]' }} px-2 py-2 text-base">Custom</a>
            <div class="flex justify-center mt-2">
                <span class="w-10 h-10 rounded-full bg-blue-200 flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-400" fill="currentColor" viewBox="0 0 20 20"><path d="M10 10a4 4 0 100-8 4 4 0 000 8zm0 2c-4 0-6 2-6 4v1a1 1 0 001 1h10a1 1 0 001-1v-1c0-2-2-4-6-4z"/></svg>
                </span>
            </div>
        </div>
    </div>
</nav>
