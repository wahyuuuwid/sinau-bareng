<header class="fixed top-0 left-0 w-full bg-white/80 backdrop-blur-md border-b border-gray-300 z-50">
    <div class="max-w-7xl mx-auto px-4 py-2">
        <div class="flex items-center justify-between h-16 mx-3 md:mx-0">

            <div class="flex items-center gap-16">
                <a href="/" class="inline-flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Sinau Bareng Logo" class="h-12 w-auto mr-2" />
                </a>
            </div>

            <div class="hidden md:flex flex-1 max-w-md mx-8">
                <div class="relative w-full text-indigo-600">
                    <input 
                        type="text" 
                        placeholder="Cari soal atau materi..." 
                        class="w-full px-4 py-2 pl-10 pr-16 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent"
                    />
                    <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <button class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-indigo-600 text-white px-3 py-1 rounded-md text-sm hover:bg-indigo-700 transition">
                        Cari
                    </button>
                </div>
            </div>

            <div class="hidden md:flex items-center gap-4 text-indigo-600">
                <div class="relative group">
                    <button class="flex items-center gap-1 text-gray-700 hover:text-indigo-600 transition px-3 py-2 font-medium">
                        <span>Explore</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">Bank Soal</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">Materi</a>
                    </div>
                </div>

                <a href="#" class="text-gray-700 hover:text-indigo-600 transition px-3 py-2 font-medium">AI Tools</a>
                <a href="#" class="text-gray-700 hover:text-indigo-600 transition px-3 py-2 font-medium">Tentang</a>

                <div class="h-6 w-px bg-gray-300 mx-2"></div>

                <a href="/login" class="text-gray-700 hover:text-indigo-600 transition px-3 py-2 font-medium">Masuk</a>
                <a href="/register" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition font-medium">
                    Daftar Gratis
                </a>
            </div>

            <button id="menu-btn" class="md:hidden flex items-center text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>

        </div>
    </div>

    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-300">
        <div class="px-6 py-4 space-y-4">
            <a href="/login" class="block w-full text-center border border-indigo-600 text-indigo-600 px-4 py-3 rounded-lg font-medium">Masuk</a>
            <a href="/register" class="block w-full text-center bg-indigo-600 text-white px-4 py-3 rounded-lg font-medium">Daftar Gratis</a>
        </div>
    </div>
</header>

<script>
    // Script sederhana untuk buka/tutup menu di HP
    const btn = document.getElementById("menu-btn");
    const menu = document.getElementById("mobile-menu");

    btn?.addEventListener("click", () => {
        menu?.classList.toggle("hidden");
    });
</script>