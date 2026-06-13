<aside class="w-[280px] bg-[#FFFFFF] border-r border-[#C5C5C5] min-h-screen flex flex-col relative z-20 sticky top-0 shadow-sm flex-shrink-0">
    <div class="mt-[30px] flex justify-center">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Sinau Bareng" class="w-[120px] h-[120px] object-contain">
    </div>

    <div class="mt-[40px] px-[24px]">
        <h3 class="text-[18px] leading-[27px] text-gray-400 font-medium uppercase tracking-wider font-['Poppins']">Menu</h3>
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
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full h-[56px] flex items-center px-[20px] cursor-pointer hover:bg-red-50 rounded-[16px] transition-all group">
                <svg class="w-[24px] h-[24px] text-[#FF0000] mr-[16px]" fill="currentColor" viewBox="0 0 24 24"><path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/></svg>
                <span class="text-[16px] text-[#FF0000] font-normal group-hover:font-medium">Keluar</span>
            </button>
        </form>
    </div>
</aside>