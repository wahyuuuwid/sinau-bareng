<header class="w-full h-[80px] bg-[#FFFFFF] border border-[#CCCCCC] rounded-[14px] flex items-center justify-between px-[24px] shadow-sm font-['Poppins']">
    
    {{-- Search Bar DNA --}}
    <div class="flex items-center w-[300px] relative">
        <svg class="w-5 h-5 text-[#666666] mr-[12px] z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
        <input type="text" placeholder="Search" class="outline-none text-[15px] text-[#848080] placeholder-[#848080] w-full bg-transparent">
        
        <div class="absolute right-0 flex items-center justify-center gap-[4px] px-[8px] py-[4px] border border-[#E9E9E9] bg-[#F9F9F9] rounded-[6px]">
            <span class="text-[11px] text-[#848080] font-bold">⌘ K</span>
        </div>
    </div>

    <div class="flex items-center gap-[24px]">
        {{-- Notification DNA --}}
       <div x-data="{ open: false }" class="relative">

    <button
        @click="open = !open"
        class="relative text-[#666666] hover:text-[#6155F5] transition-colors p-2"
    >
        <svg class="w-[24px] h-[24px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
            </path>
        </svg>

        @if($unreadCount > 0)
            <span
                class="absolute top-[6px] right-[8px] min-w-[18px] h-[18px] bg-red-500 text-white text-[10px] rounded-full flex items-center justify-center">
                {{ $unreadCount }}
            </span>
        @endif
    </button>

    <style>
    [x-cloak] {
        display: none !important;
    }
</style>

    <div
        x-show="open"
        @click.away="open = false"
         x-cloak
        x-transition
        class="absolute right-0 mt-3 w-80 bg-white rounded-xl shadow-xl border z-50"
    >
        <div class="p-4 border-b">
            <h3 class="font-semibold">Notifikasi</h3>
        </div>

        <div class="max-h-96 overflow-y-auto">
            @forelse($notifications as $notification)
                <div class="p-4 border-b hover:bg-gray-50">
                    <p class="font-medium text-sm">
                        {{ $notification->title }}
                    </p>

                    <p class="text-xs text-gray-500 mt-1">
                        {{ $notification->message }}
                    </p>

                    <p class="text-[11px] text-gray-400 mt-2">
                        {{ $notification->created_at->diffForHumans() }}
                    </p>
                </div>
            @empty
                <div class="p-4 text-center text-gray-500">
                    Belum ada notifikasi
                </div>
            @endforelse
        </div>
    </div>

</div>

        {{-- Profile Card DNA --}}
        <a href="{{ route('admin.profile') }}" class="flex items-center gap-[12px] bg-[#6155F5] hover:bg-[#5246e5] cursor-pointer transition-colors rounded-[24px] py-[6px] pl-[20px] pr-[6px] shadow-md">
            <div class="flex flex-col text-right">
                <p class="text-[14px] leading-[18px] font-semibold text-white tracking-wide">{{ Auth::user()->username ?? 'Wahyu Widodo' }}</p>
                <p class="text-[10px] leading-[14px] font-medium text-white/80 uppercase tracking-widest mt-[2px]">Administrator</p>
            </div>
            <div class="w-[42px] h-[42px] rounded-[18px] bg-white p-[2px] overflow-hidden flex-shrink-0 shadow-sm">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->username ?? 'Admin') }}&background=ECECEC&color=6155F5" class="w-full h-full rounded-[14px] object-cover">
            </div>
        </a>
    </div>

</header>