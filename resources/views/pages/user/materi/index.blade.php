<x-layout.app_user title="Eksplorasi Materi">
    
    {{-- CSS UNTUK RATING & ANIMASI --}}
    <style>
        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center;
        }
        .star-rating input {
            display: none;
        }
        .star-rating label {
            cursor: pointer;
            color: #E5E7EB; 
            transition: all 0.2s ease;
        }
        .star-rating input:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: #FBBF24;
            transform: scale(1.1);
        }
    </style>

    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-[24px] font-bold text-gray-900">Eksplorasi Materi</h1>
        <p class="text-gray-500 text-[14px] mt-1">Temukan referensi terbaik untuk mendukung studimu.</p>
    </div>

    {{-- KOTAK PENCARIAN --}}
    <div class="bg-white p-6 rounded-[20px] shadow-sm border border-[#D7D7D7] mb-8">
        <form action="{{ route('materi.cari') }}" method="GET" class="flex gap-4">
            <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Cari judul materi..." 
                   class="flex-1 px-5 py-3 bg-[#F9F9FC] border border-[#D7D7D7] rounded-xl outline-none focus:ring-2 focus:ring-[#6155F5] transition-all text-sm font-medium">
            <button type="submit" class="bg-[#6155F5] text-white px-8 py-3 rounded-xl font-bold text-sm shadow-md shadow-indigo-100 hover:bg-[#5246e5] active:scale-[0.98] transition-all">
                Cari
            </button>
        </form>
    </div>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-xl text-sm font-semibold flex items-center gap-3">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- GRID KARTU MATERI --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 relative">
        @forelse ($materis as $materi)
            <div class="bg-white border border-[#D7D7D7] rounded-[20px] shadow-sm p-6 flex flex-col hover:-translate-y-1 hover:shadow-md transition-all duration-300 h-full">
                
                {{-- ICON & ACTION BUTTONS --}}
                <div class="flex justify-between items-start mb-4">
                    <div class="w-12 h-12 bg-indigo-50 text-[#6155F5] rounded-xl flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477-4.5 1.253"></path></svg>
                    </div>

                    <div class="flex items-center gap-1.5">
                        <button onclick="openModal('detailModal-{{ $materi->id }}')" class="p-2 text-indigo-500 bg-indigo-50 hover:bg-indigo-500 hover:text-white rounded-lg transition-all" title="Detail">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </button>
                        <button onclick="openModal('ratingModal-{{ $materi->id }}')" class="p-2 text-amber-500 bg-amber-50 hover:bg-amber-500 hover:text-white rounded-lg transition-all" title="Rating">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                        </button>
                        <button onclick="openModal('reportModal-{{ $materi->id }}')" class="p-2 text-red-500 bg-red-50 hover:bg-red-500 hover:text-white rounded-lg transition-all" title="Lapor">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </button>
                        <a href="{{ route('materi.download', $materi->id) }}" class="p-2 text-emerald-500 bg-emerald-50 hover:bg-emerald-500 hover:text-white rounded-lg transition-all" title="Unduh">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        </a>
                    </div>
                </div>
                
                {{-- MATERI INFO --}}
                <h3 class="text-[16px] font-bold text-gray-800 mb-1 line-clamp-2">{{ $materi->judul }}</h3>
                <p class="text-[12px] text-gray-400 font-medium mb-1">Oleh: {{ $materi->user->username ?? 'Mahasiswa' }}</p>

                {{-- VISUALISASI RATING --}}
                <div class="flex items-center gap-1 mb-4">
                    @php $currentRating = round($materi->rating ?? 0); @endphp
                    <div class="flex text-amber-400">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg class="w-3.5 h-3.5 {{ $i <= $currentRating ? 'fill-current' : 'text-gray-200' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <span class="text-[11px] font-bold text-gray-400 mt-0.5">({{ $materi->rating ?? '0' }})</span>
                </div>
                
                <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                    <span class="text-xs font-bold text-[#6155F5] bg-indigo-50 px-3 py-1.5 rounded-lg truncate max-w-[120px]">{{ $materi->mata_kuliah }}</span>
                    <span class="text-[10px] font-bold text-gray-400 uppercase border border-gray-200 px-2 py-1 rounded-md bg-gray-50">{{ $materi->tipe_file }}</span>
                </div>
            </div>

            {{-- 1. MODAL DETAIL --}}
            <div id="detailModal-{{ $materi->id }}" class="custom-modal fixed inset-0 z-[100] hidden items-center justify-center bg-gray-900/60 backdrop-blur-sm px-4">
                <div class="bg-white rounded-[24px] w-full max-w-md p-8 shadow-2xl">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Detail Materi</h3>
                        <button onclick="closeModal('detailModal-{{ $materi->id }}')" class="text-gray-400 hover:text-gray-600">✕</button>
                    </div>
                    <div class="space-y-5">
                        <div>
                            <label class="text-[11px] font-bold text-gray-400 uppercase tracking-widest block mb-1">Judul Materi</label>
                            <p class="text-gray-800 font-semibold">{{ $materi->judul }}</p>
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-gray-400 uppercase tracking-widest block mb-1">Mata Kuliah</label>
                            <p class="text-indigo-600 font-bold">{{ $materi->mata_kuliah }}</p>
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-gray-400 uppercase tracking-widest block mb-1">Deskripsi</label>
                            <p class="text-gray-600 text-sm leading-relaxed">{{ $materi->deskripsi ?? 'Tidak ada deskripsi tambahan.' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. MODAL RATING --}}
            <div id="ratingModal-{{ $materi->id }}" class="custom-modal fixed inset-0 z-[100] hidden items-center justify-center bg-gray-900/60 backdrop-blur-sm px-4">
                <div class="bg-white rounded-[24px] w-full max-w-xs p-8 shadow-2xl text-center">
                    <h3 class="text-lg font-bold text-gray-900 mb-6">Beri Rating</h3>
                    <form action="{{ route('materi.rate', $materi->id) }}" method="POST">
                        @csrf
                        <div class="star-rating mb-8">
                            @for($i=5; $i>=1; $i--)
                                <input type="radio" id="star{{ $i }}-{{ $materi->id }}" name="rating" value="{{ $i }}" class="hidden peer" required>
                                <label for="star{{ $i }}-{{ $materi->id }}" class="px-1">
                                    <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                </label>
                            @endfor
                        </div>
                        <div class="flex gap-3">
                            <button type="button" onclick="closeModal('ratingModal-{{ $materi->id }}')" class="flex-1 py-3 text-sm font-bold text-gray-400">Batal</button>
                            <button type="submit" class="flex-1 py-3 bg-[#6155F5] text-white rounded-xl font-bold text-sm shadow-lg shadow-indigo-100">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- 3. MODAL REPORT --}}
            <div id="reportModal-{{ $materi->id }}" class="custom-modal fixed inset-0 z-[100] hidden items-center justify-center bg-gray-900/60 backdrop-blur-sm px-4">
                <div class="bg-white rounded-[24px] w-full max-w-sm p-8 shadow-2xl">
                    <h3 class="text-lg font-bold text-red-600 mb-2 text-center">Laporkan Materi</h3>
                    <p class="text-xs text-gray-500 mb-6 text-center">Bantu kami menjaga kualitas platform.</p>
                    <form action="{{ route('materi.report', $materi->id) }}" method="POST">
                        @csrf
                        <textarea name="alasan" rows="3" required placeholder="Sebutkan alasan..." class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-red-400 text-sm mb-6 resize-none"></textarea>
                        <div class="flex gap-3">
                            <button type="button" onclick="closeModal('reportModal-{{ $materi->id }}')" class="flex-1 py-3 text-sm font-bold text-gray-400 text-center">Batal</button>
                            <button type="submit" class="flex-1 py-3 bg-red-600 text-white rounded-xl font-bold text-sm shadow-lg shadow-red-100">Laporkan</button>
                        </div>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white border border-gray-100 rounded-[20px] shadow-sm p-12 text-center flex flex-col items-center justify-center">
                <h3 class="text-lg font-bold text-gray-800 mb-1">Materi Tidak Ditemukan</h3>
            </div>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    @if($materis->hasPages())
        <div class="mt-10">
            {{ $materis->withQueryString()->links() }}
        </div>
    @endif

    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
            document.getElementById(id).classList.add('flex');
        }
        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
            document.getElementById(id).classList.remove('flex');
        }
        window.onclick = function(e) {
            if (e.target.classList.contains('custom-modal')) {
                e.target.classList.add('hidden');
                e.target.classList.remove('flex');
            }
        }
    </script>
</x-layout.app_user>