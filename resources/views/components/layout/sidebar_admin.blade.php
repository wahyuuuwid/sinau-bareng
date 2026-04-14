<div class="bg-white w-70 flex flex-col shadow-lg min-h-screen sticky top-0">
    <div class="p-10 flex justify-center">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-16" />
    </div>

    <div class="px-6 mb-4 text-xs font-bold text-gray-400 uppercase tracking-widest">
        Menu
    </div>

    <nav class="flex-1 px-4 space-y-2">
        @php
            $menus = [
                ['name' => 'Dashboard', 'url' => '/admin', 'icon' => 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z'],
                ['name' => 'Kelola Pengguna', 'url' => '/admin/users', 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                ['name' => 'Moderasi Konten', 'url' => '/admin/moderasi', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                ['name' => 'Manajemen Laporan', 'url' => '/admin/laporan', 'icon' => 'M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
            ];
        @endphp

        @foreach($menus as $menu)
            <a href="{{ $menu['url'] }}" 
                class="flex items-center gap-4 py-3 px-6 rounded-xl transition-all {{ request()->is(trim($menu['url'], '/')) ? 'bg-indigo-100 text-indigo-600 font-bold' : 'text-gray-500 hover:bg-gray-50' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $menu['icon'] }}"/>
                </svg>
                <span>{{ $menu['name'] }}</span>
            </a>
        @endforeach
    </nav>

    <div class="p-8">
        <form method="POST" action="/logout">
            @csrf
            <button class="flex items-center gap-3 text-red-500 font-semibold hover:bg-red-50 p-3 rounded-xl w-full transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Keluar
            </button>
        </form>
    </div>
</div>