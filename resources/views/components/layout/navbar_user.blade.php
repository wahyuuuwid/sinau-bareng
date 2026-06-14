<header class="flex justify-between items-center w-full mb-10 mt-2 font-['Poppins']">
    
    {{-- Bagian Kiri: Diisi dinamis oleh halaman yang memanggilnya (Slot) --}}
    <div class="flex-1">
        {{ $slot }}
    </div>

    {{-- Bagian Kanan: Notifikasi (Profil dihilangkan sesuai permintaan) --}}
    <div class="flex items-center ml-auto">

        @php
            // Mengambil notifikasi user yang belum dibaca dari database
            $unreadNotifs = auth()->user()->notifications()->where('is_read', false)->get() ?? collect();
        @endphp

        <div class="relative group inline-block">
            {{-- Tombol Lonceng --}}
            <button class="relative p-2.5 bg-white border border-gray-200 text-gray-500 hover:text-[#6155F5] hover:border-[#6155F5] transition-all rounded-full shadow-sm flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                
                {{-- Indikator Titik Merah --}}
                @if($unreadNotifs->count() > 0)
                    <span class="absolute top-0 right-0 w-3 h-3 bg-red-500 rounded-full border-2 border-white animate-pulse"></span>
                @endif
            </button>

            {{-- Dropdown Kotak Notifikasi --}}
            <div class="absolute right-0 mt-3 w-80 bg-white border border-gray-100 rounded-2xl shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 overflow-hidden transform origin-top-right scale-95 group-hover:scale-100">
                <div class="p-4 bg-gray-50 border-b border-gray-100 flex justify-between items-center">
                    <span class="font-bold text-gray-800 text-sm">Notifikasi</span>
                    @if($unreadNotifs->count() > 0)
                        <span class="text-[10px] font-bold bg-[#6155F5] text-white px-2.5 py-1 rounded-full">{{ $unreadNotifs->count() }} Baru</span>
                    @endif
                </div>
                
                <div class="max-h-72 overflow-y-auto">
                    @forelse($unreadNotifs as $notif)
                        <div class="p-4 border-b border-gray-50 hover:bg-indigo-50/50 transition-colors cursor-pointer group/item">
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-full flex-shrink-0 flex items-center justify-center {{ str_contains($notif->title, '✅') ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                    @if(str_contains($notif->title, '✅'))
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    @else
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    @endif
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-gray-800 group-hover/item:text-[#6155F5] transition-colors">{{ $notif->title }}</h4>
                                    <p class="text-xs text-gray-500 mt-1 leading-relaxed">{{ $notif->message }}</p>
                                    <span class="text-[10px] font-medium text-gray-400 mt-2 block">{{ $notif->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 flex flex-col items-center justify-center text-center">
                            <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center text-gray-300 mb-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                            </div>
                            <p class="text-sm font-medium text-gray-500">Belum ada notifikasi baru.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</header>