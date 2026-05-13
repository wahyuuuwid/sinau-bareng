<x-layout.app_user title="Dashboard Mahasiswa">
    
    {{-- CSS KHUSUS DASHBOARD --}}
    <style>
        .stat-card { transition: all 0.3s ease; }
        .stat-card:hover { transform: translateY(-5px); border-color: #6155F5; }
        .custom-modal { transition: opacity 0.3s ease; }
    </style>

    {{-- WELCOME HEADER --}}
    <div class="mb-10">
        <h1 class="text-[28px] font-bold text-gray-900">Selamat Datang, {{ auth()->user()->username }}! 👋</h1>
        <p class="text-gray-500 text-[14px] mt-1 font-medium">Pantau statistik unggahanmu dan eksplorasi materi populer minggu ini.</p>
    </div>

    {{-- STATISTIC CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
        <div class="stat-card bg-white border border-[#D7D7D7] rounded-[24px] p-6 shadow-sm flex items-center gap-5">
            <div class="w-14 h-14 bg-indigo-50 text-[#6155F5] rounded-2xl flex items-center justify-center shadow-sm">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <div>
                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Total Unggahan</p>
                <h3 class="text-2xl font-bold text-gray-900">{{ $totalMateri }} <span class="text-sm font-medium text-gray-400 ml-1">Materi</span></h3>
            </div>
        </div>

        <div class="stat-card bg-white border border-[#D7D7D7] rounded-[24px] p-6 shadow-sm flex items-center gap-5">
            <div class="w-14 h-14 bg-amber-50 text-amber-500 rounded-2xl flex items-center justify-center shadow-sm">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
            </div>
            <div>
                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Rata-rata Rating</p>
                <h3 class="text-2xl font-bold text-gray-900">{{ $averageRating }} <span class="text-sm font-medium text-gray-400 ml-1">/ 5.0</span></h3>
            </div>
        </div>
    </div>

    {{-- MATERI POPULER SECTION --}}
    <div class="mb-12">
        <div class="flex justify-between items-end mb-6">
            <div>
                <h2 class="text-xl font-bold text-gray-900">Materi Populer</h2>
                <p class="text-sm text-gray-400">Paling banyak dipelajari mahasiswa minggu ini.</p>
            </div>
            <a href="{{ route('materi.eksplorasi') }}" class="text-sm font-bold text-[#6155F5] hover:text-[#5246e5] flex items-center gap-2 group transition-all">
                Lihat Semua Materi 
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
            @forelse($materiPopuler as $materi)
                <div class="bg-white border border-[#D7D7D7] rounded-[24px] p-5 shadow-sm hover:shadow-md transition-all relative group flex flex-col h-full overflow-hidden">
                    <div class="absolute top-0 right-0">
                        <div class="bg-amber-400 text-white text-[9px] font-black px-3 py-1 rounded-bl-xl uppercase tracking-widest">🔥 Trending</div>
                    </div>
                    <div class="w-12 h-12 bg-indigo-50 text-[#6155F5] rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <h3 class="text-sm font-bold text-gray-800 mb-1 line-clamp-2 h-10">{{ $materi->judul }}</h3>
                    <p class="text-[11px] text-gray-400 mb-2 font-medium">Oleh: {{ $materi->user->username ?? 'Mahasiswa' }}</p>

                    <div class="flex items-center gap-1 mb-5">
                        <div class="flex text-amber-400">
                            @for($i=1; $i<=5; $i++)
                                <svg class="w-3 h-3 {{ $i <= round($materi->rating) ? 'fill-current' : 'text-gray-200' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                        <span class="text-[10px] font-bold text-gray-400">({{ $materi->rating ?? '0' }})</span>
                    </div>

                    <div class="flex gap-2 mt-auto">
                         <a href="{{ route('materi.download', $materi->id) }}" class="flex-1 py-2.5 bg-gray-50 text-emerald-600 rounded-xl text-[11px] font-bold text-center hover:bg-emerald-600 hover:text-white transition-all">Unduh</a>
                         <button onclick="openModal('detailModal-{{ $materi->id }}')" class="flex-1 py-2.5 bg-[#6155F5] text-white rounded-xl text-[11px] font-bold text-center hover:bg-[#5246e5] transition-all">Detail</button>
                    </div>
                </div>

                {{-- MODAL PREVIEW --}}
                <div id="detailModal-{{ $materi->id }}" class="custom-modal fixed inset-0 z-[100] hidden items-center justify-center bg-gray-900/60 backdrop-blur-sm px-4">
                    <div class="bg-white rounded-[24px] w-full max-w-md p-8 shadow-2xl">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Preview Materi</h3>
                            <button onclick="closeModal('detailModal-{{ $materi->id }}')" class="text-gray-400 hover:text-gray-600">✕</button>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="text-[11px] font-bold text-gray-400 uppercase tracking-widest block mb-1">Mata Kuliah</label>
                                <p class="text-indigo-600 font-bold">{{ $materi->mata_kuliah }}</p>
                            </div>
                            <div>
                                <label class="text-[11px] font-bold text-gray-400 uppercase tracking-widest block mb-1">Deskripsi</label>
                                <p class="text-gray-600 text-sm leading-relaxed">{{ $materi->deskripsi ?? 'Tidak ada deskripsi tambahan.' }}</p>
                            </div>
                        </div>
                        <div class="mt-8">
                            <a href="{{ route('materi.download', $materi->id) }}" class="block w-full py-3.5 bg-[#6155F5] text-white text-center rounded-xl font-bold text-sm shadow-lg hover:bg-[#5246e5] transition-all">Download Sekarang</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center text-gray-400 font-medium">Belum ada materi populer minggu ini.</div>
            @endforelse
        </div>
    </div>

    {{-- MODAL SCRIPTS --}}
    <script>
        function openModal(id) {
            const modal = document.getElementById(id);
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }
        function closeModal(id) {
            const modal = document.getElementById(id);
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }
    </script>
</x-layout.app_user>