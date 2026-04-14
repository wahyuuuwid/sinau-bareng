<div class="bg-white w-70 flex flex-col shadow-lg min-h-screen sticky top-0">
    <div class="p-10 flex justify-center">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-16" />
    </div>

    <div class="px-6 mb-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Menu</div>

    <nav class="flex-1 px-4 space-y-2">
        @php
            $menus = [
                ['name' => 'Dashboard', 'url' => '/dosen', 'icon' => 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z'],
                ['name' => 'Validasi Materi', 'url' => '/dosen/validasi-materi', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                ['name' => 'Validasi Soal AI', 'url' => '/dosen/validasi-soal', 'icon' => 'M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2'],
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