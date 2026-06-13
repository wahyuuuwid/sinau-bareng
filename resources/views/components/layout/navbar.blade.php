<header class="fixed top-0 left-0 w-full bg-white/80 backdrop-blur-md border-b border-slate-200 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">

            {{-- LOGO AREA --}}
            <div class="flex items-center">
                <a href="#hero" class="inline-flex items-center">
                    <img src="{{ asset('logo.png') }}" alt="Sinau Bareng Logo" class="h-10 w-auto" />
                </a>
            </div>

            {{-- DESKTOP MENU: SMOOTH SCROLL INTERNAL --}}
            <div class="hidden md:flex items-center gap-8 text-sm font-bold text-slate-600">
                <a href="#hero" class="hover:text-[#6155F5] transition-colors duration-200">Utama</a>
                <a href="#fitur" class="hover:text-[#6155F5] transition-colors duration-200">Fitur Layanan</a>
                <a href="#alur" class="hover:text-[#6155F5] transition-colors duration-200">Cara Kerja</a>
                <a href="#statistik" class="hover:text-[#6155F5] transition-colors duration-200">Keunggulan</a>

                <div class="h-5 w-px bg-slate-200 mx-2"></div>

              @auth
    <div class="flex items-center gap-3">
        <a href="/student/dashboard" class="flex items-center gap-2">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->username) }}&background=6155F5&color=fff" class="w-10 h-10 rounded-full shadow-sm border border-indigo-100">
            <span class="text-slate-700">
                {{ auth()->user()->username }}
            </span>
        </a>
    </div>
@else
    <a href="/auth/login"
       class="text-slate-700 hover:text-[#6155F5] transition-colors duration-200">
        Masuk
    </a>

    <a href="/auth/register"
       class="bg-[#6155F5] text-white px-5 py-2.5 rounded-xl hover:bg-[#4f44d8] transition-all duration-300 shadow-md shadow-[#6155F5]/10 transform active:scale-95">
        Daftar Gratis
    </a>
@endauth
            </div>

            {{-- MOBILE MENU BUTTON --}}
            <button id="menu-btn" class="md:hidden flex items-center text-slate-700 focus:outline-none p-2 rounded-lg hover:bg-slate-50">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>

        </div>
    </div>

    {{-- MOBILE MENU DROPDOWN --}}
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-slate-100 shadow-lg animate-modal-enter">
        <div class="px-6 py-6 space-y-4 flex flex-col text-left font-bold text-slate-600">
            <a href="#hero" class="mobile-link hover:text-[#6155F5] py-2 border-b border-slate-50">Utama</a>
            <a href="#fitur" class="mobile-link hover:text-[#6155F5] py-2 border-b border-slate-50">Fitur Layanan</a>
            <a href="#alur" class="mobile-link hover:text-[#6155F5] py-2 border-b border-slate-50">Cara Kerja</a>
            <a href="#statistik" class="mobile-link hover:text-[#6155F5] py-2">Keunggulan</a>
            
            <div class="pt-4 grid grid-cols-2 gap-4">
                <a href="/auth/login" class="text-center border-2 border-slate-200 text-slate-700 px-4 py-3 rounded-xl font-bold">Masuk</a>
                <a href="/auth/register" class="text-center bg-[#6155F5] text-white px-4 py-3 rounded-xl font-bold shadow-md shadow-[#6155F5]/10">Daftar</a>
            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const btn = document.getElementById("menu-btn");
        const menu = document.getElementById("mobile-menu");
        const mobileLinks = document.querySelectorAll(".mobile-link");

        // Toggle mobile menu
        btn?.addEventListener("click", () => {
            menu?.classList.toggle("hidden");
        });

        // Close mobile menu pas ngeklik link internal smooth scroll
        mobileLinks.forEach(link => {
            link.addEventListener("click", () => {
                menu?.classList.add("hidden");
            });
        });
    });
</script>