<aside class="bg-[#FFFFFF] border-r border-[#C5C5C5] min-h-screen flex flex-col  z-50 fixed top-0 shadow-sm" x-data="{ showLogoutModal: false }">
    <div class="mt-[30px] flex justify-center">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Sinau Bareng" class="w-20 h-20 object-contain">
    </div>

    <div class="mt-[40px] px-[24px]">
        <h3 class="text-[14px] leading-[27px] text-gray-400 font-medium uppercase tracking-wider font-['Poppins']">Menu</h3>
    </div>

    <nav class="mt-[20px] px-[16px] flex flex-col gap-2 font-['Poppins']">
        {{-- Dashboard --}}
        <a href="{{ route('admin.dashboard') }}" 
           class="w-full h-[56px] flex items-center px-[20px] rounded-[16px] transition-all group
           {{ request()->routeIs('admin.dashboard') ? 'bg-[#6155F5] text-white shadow-lg shadow-indigo-200' : 'text-[#666666] hover:bg-indigo-50 hover:text-[#6155F5]' }}">
            <svg class="w-6 h-6 mr-[16px]" fill="currentColor" viewBox="0 0 24 24"><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/></svg>
            <span class="text-[16px] font-medium tracking-wide">Dashboard</span>
        </a>

        {{-- Kelola Pengguna --}}
        <a href="{{ route('admin.users') }}" 
           class="w-full h-[56px] flex items-center px-[20px] rounded-[16px] transition-all group
           {{ request()->routeIs('admin.users') ? 'bg-[#6155F5] text-white shadow-lg shadow-indigo-200' : 'text-[#666666] hover:bg-indigo-50 hover:text-[#6155F5]' }}">
            <svg class="w-6 h-6 mr-[16px]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
            <span class="text-[16px] font-medium tracking-wide">Kelola Pengguna</span>
        </a>

        {{-- Moderasi Konten --}}
        <a href="{{ route('admin.moderation') }}" 
           class="w-full h-[56px] flex items-center px-[20px] rounded-[16px] transition-all group
           {{ request()->routeIs('admin.moderation') ? 'bg-[#6155F5] text-white shadow-lg shadow-indigo-200' : 'text-[#666666] hover:bg-indigo-50 hover:text-[#6155F5]' }}">
            <svg class="w-6 h-6 mr-[16px]" fill="currentColor" viewBox="0 0 24 24"><path d="M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 4h5v8l-2.5-1.5L6 12V4z"/></svg>
            <span class="text-[16px] font-medium tracking-wide">Moderasi Konten</span>
        </a>

        {{-- Manajemen Laporan --}}
        <a href="{{ route('admin.laporan') }}" 
           class="w-full h-[56px] flex items-center px-[20px] rounded-[16px] transition-all group
           {{ request()->routeIs('admin.laporan') ? 'bg-[#6155F5] text-white shadow-lg shadow-indigo-200' : 'text-[#666666] hover:bg-indigo-50 hover:text-[#6155F5]' }}">
            <svg class="w-6 h-6 mr-[16px]" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
            <span class="text-[16px] font-medium tracking-wide">Manajemen Laporan</span>
        </a>
    </nav>

    <div class="mt-auto mb-[40px] px-[16px] font-['Poppins']">
       
            <button type="button"  @click="showLogoutModal = true" class="w-full h-[56px] flex items-center px-[20px] cursor-pointer hover:bg-red-50 rounded-[16px] transition-all group">
                <svg class="w-[24px] h-[24px] text-[#FF0000] mr-[16px]" fill="currentColor" viewBox="0 0 24 24"><path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/></svg>
                <span class="text-[16px] text-[#FF0000] font-normal group-hover:font-medium">Keluar</span>
            </button>
    </div>

    <div x-show="showLogoutModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/60 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
         
        <div @click.away="showLogoutModal = false" class="bg-white rounded-3xl p-8 w-[400px] shadow-2xl transform transition-all text-center border border-indigo-100 text-gray-800"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-90 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0">
             
            <div class="w-20 h-20 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-6 border-4 border-white shadow-sm">
                <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
            </div>
            
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Konfirmasi Keluar</h3>
            <p class="text-gray-500 mb-8 font-medium">Apakah Anda yakin ingin keluar dari sesi aplikasi Sinau Bareng ini?</p>
            
            <div class="flex gap-4 justify-center">
                <button @click="showLogoutModal = false" type="button" class="w-1/2 py-3 rounded-xl text-gray-600 bg-gray-100 hover:bg-gray-200 font-bold transition-colors">
                    Batal
                </button>
                <form method="POST" action="/logout" class="w-1/2 m-0 p-0">
                    @csrf
                    <button type="submit" class="w-full py-3 rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 font-bold shadow-lg shadow-indigo-200 transition-colors">
                        Ya, Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</aside>