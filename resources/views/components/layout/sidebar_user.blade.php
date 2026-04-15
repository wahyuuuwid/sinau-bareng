<div class="bg-[#6366f1] w-64 flex flex-col min-h-screen sticky top-0 text-white" x-data="{ openMateri: {{ request()->is('materi*') ? 'true' : 'false' }} }">
    <div class="p-10 font-bold text-2xl tracking-widest uppercase">
        Logo
    </div>

    <div class="px-8 mb-4 text-xs font-bold text-indigo-200 uppercase tracking-widest">
        Menu
    </div>

    <nav class="flex-1 px-4 space-y-2">
        <a href="/user" 
            class="flex items-center gap-4 py-3 px-6 rounded-lg transition-all {{ request()->is('user') ? 'bg-[#4f46e5]/50 text-yellow-400 font-bold' : 'hover:bg-indigo-500/50' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
            </svg>
            <span>Dashboard</span>
        </a>

        {{-- MENU MATERI DENGAN SUB-MENU (DROPDOWN) --}}
        <div class="space-y-1">
            <button @click="openMateri = !openMateri" 
                class="w-full flex items-center justify-between py-3 px-6 rounded-lg transition-all {{ request()->is('materi*') ? 'bg-[#4f46e5]/50 text-yellow-400 font-bold' : 'hover:bg-indigo-500/50 text-white' }}">
                <div class="flex items-center gap-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <span><a >Materi</a></span>
                </div>
                {{-- Panah Dropdown --}}
                <svg :class="openMateri ? 'rotate-180' : ''" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>

            {{-- Anak-anak Menu Materi --}}
            <div x-show="openMateri" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 transform scale-95" class="pl-14 space-y-2 mt-1">
                <a href="/materi/cari" class="block py-2 text-sm {{ request()->is('materi/cari') ? 'text-yellow-400 font-bold' : 'text-indigo-100 hover:text-white' }}">
                    Cari & Unduh
                </a>
                <a href="/materi/unggah" class="block py-2 text-sm {{ request()->is('materi/unggah') ? 'text-yellow-400 font-bold' : 'text-indigo-100 hover:text-white' }}">
                    Unggah Materi
                </a>
                <a href="/materi/saya" class="block py-2 text-sm {{ request()->is('materi/saya') ? 'text-yellow-400 font-bold' : 'text-indigo-100 hover:text-white' }}">
                    Materi Saya
                </a>
            </div>
        </div>

        {{-- Generate Soal Tetap Sama --}}
        <a href="/generate" 
            class="flex items-center gap-4 py-3 px-6 rounded-lg transition-all {{ request()->is('generate') ? 'bg-[#4f46e5]/50 text-yellow-400 font-bold' : 'hover:bg-indigo-500/50' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            <span>Generate Soal</span>
        </a>
    </nav>

    <div class="mt-auto">
        <a href="/profil" class="flex items-center gap-4 py-4 px-10 hover:bg-indigo-500 transition">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            <span>Profil</span>
        </a>
        <form method="POST" action="/logout" class="bg-white">
            @csrf
            <button type="submit" class="flex items-center gap-4 py-4 px-10 text-gray-800 font-bold w-full hover:bg-gray-100 transition">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Keluar
            </button>
        </form>
    </div>
</div>