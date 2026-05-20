<x-layout.app_user title="Cari & Unduh Materi" class="bg-[#E5E5E5]">
    {{-- CSS Custom untuk Scrollbar Halus --}}
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 20px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background-color: #94a3b8;
        }
        .animate-modal-enter { animation: modalEnter 0.3s ease-out forwards; }
        @keyframes modalEnter {
            from { opacity: 0; transform: scale(0.95) translateY(10px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }
    </style>

    <main>
        <h1 class="text-3xl font-bold text-black mb-8">
            Materi > Cari & Unduh Materi
        </h1>

        {{-- ALERT BERHASIL --}}
        @if(session('success'))
            <div id="alert-success" class="bg-green-500 text-white p-4 rounded-2xl mb-6 shadow-lg flex items-center justify-between animate-bounce">
                <div class="flex items-center gap-3">
                    <span class="font-bold">✅ {{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-white/70 hover:text-white font-bold">✕</button>
            </div>
        @endif

        {{-- ALERT PROTEKSI / ERROR RATING --}}
        @if(session('error'))
            <div id="alert-error" class="bg-red-500 text-white p-4 rounded-2xl mb-6 shadow-lg flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="font-bold">❌ {{ session('error') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-white/70 hover:text-white font-bold">✕</button>
            </div>
        @endif

        {{-- FORM FILTER & SEARCH --}}
        <form method="GET" action="{{ route('materi.cari') }}">
            <div class="flex flex-wrap items-center gap-4 mb-8">
                <div class="relative flex-1 min-w-[300px] shadow-sm rounded-xl overflow-hidden">
                    <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Masukan Kata Kunci..."
                        class="w-full pl-5 pr-12 py-3 border-none outline-none font-medium text-sm">
                    <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>

                <span class="font-bold text-gray-700 text-sm">Filter :</span>

                <select name="pelajaran" class="bg-white px-4 py-2 rounded-lg shadow-sm text-xs font-bold border-none focus:ring-2 focus:ring-[#6155F5]">
                    <option value="">Semua Pelajaran</option>
                    @foreach($listPelajaran as $p)
                        <option value="{{ $p }}" {{ request('pelajaran') == $p ? 'selected' : '' }}>{{ $p }}</option>
                    @endforeach
                </select>

                <select name="tahun" class="bg-white px-4 py-2 rounded-lg shadow-sm text-xs font-bold border-none focus:ring-2 focus:ring-[#6155F5]">
                    <option value="">Tahun</option>
                    @foreach($listTahun as $t)
                        <option value="{{ $t }}" {{ request('tahun') == $t ? 'selected' : '' }}>{{ $t }}</option>
                    @endforeach
                </select>

                <button type="submit" class="bg-[#6155F5] hover:bg-[#4f44d8] text-white px-6 py-2 rounded-lg text-xs font-bold transition-all shadow-md">
                    Terapkan
                </button>
            </div>
        </form>

        {{-- TABEL DATA MATERI --}}
        <div class="bg-white rounded-xl overflow-hidden shadow-md">
            <table class="w-full text-center">
                <thead>
                    <tr class="bg-[#6155F5] text-white text-sm">
                        <th class="py-5 px-4 font-bold">No</th>
                        <th class="py-5 px-4 font-bold border-l border-white/20 text-left">Pelajaran</th>
                        <th class="py-5 px-4 font-bold border-l border-white/20 text-left">Materi</th>
                        <th class="py-5 px-4 font-bold border-l border-white/20">Pengunggah</th>
                        <th class="py-5 px-4 font-bold border-l border-white/20">Tahun</th>
                        <th class="py-5 px-4 font-bold border-l border-white/20">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-[13px] font-semibold text-gray-700">
                    @forelse($materis as $index => $materi)
                        {{-- Logika Matematika Hitung Rata-Rata Bintang --}}
                        @php
                            $rataRata = $materi->ratings()->avg('nilai');
                            $jumlahUser = $materi->ratings()->count();
                        @endphp

                        <tr class="border-b {{ $index % 2 == 1 ? 'bg-[#EFEEFF]' : 'bg-white' }} hover:bg-indigo-50 transition-colors">
                            <td class="py-4">{{ $index + 1 }}.</td>
                            <td class="text-left px-4 italic text-gray-600">{{ $materi->pelajaran }}</td>
                            <td class="text-left px-4 py-3">
                                <span class="font-bold text-gray-900 block">{{ $materi->judul_materi }}</span>
                                {{-- Preview Bintang Kumulatif di bawah judul materi --}}
                                <div class="flex items-center gap-1 mt-0.5">
                                    @if($jumlahUser > 0)
                                        <span class="text-yellow-500 text-xs">⭐</span>
                                        <span class="text-gray-700 text-[11px] font-bold">{{ number_format($rataRata, 1) }} <span class="text-gray-400 font-normal">({{ $jumlahUser }} ulasan)</span></span>
                                    @else
                                        <span class="text-gray-400 text-[11px] font-normal italic">Belum ada ulasan</span>
                                    @endif
                                </div>
                            </td>
                            <td>{{ $materi->user->username ?? '-' }}</td>
                            <td>{{ $materi->tahun }}</td>
                            <td class="py-4">
                                <div class="flex justify-center items-center gap-2 px-2">
                                    <button onclick="openModal('modal-detail-{{ $materi->id }}')" class="p-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition-all" title="Detail">👁️</button>
                                    <button onclick="openModal('modal-report-{{ $materi->id }}')" class="p-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition-all" title="Laporkan">⚠️</button>
                                    <button onclick="openModal('modal-rate-{{ $materi->id }}')" class="p-2 bg-yellow-100 text-yellow-600 rounded-lg hover:bg-yellow-500 hover:text-white transition-all" title="Beri Rating">⭐</button>
                                    <a href="{{ asset('storage/' . $materi->file_path) }}" download class="p-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-800 hover:text-white transition-all" title="Unduh File">⬇️</a>
                                </div>
                            </td>
                        </tr>

                        {{-- MODAL DETAIL (FIXED STICKY HEADER & INFO WITH BINTANG) --}}
                        <div id="modal-detail-{{ $materi->id }}" class="fixed inset-0 z-50 hidden bg-black/60 backdrop-blur-sm flex items-center justify-center p-4">
                            <div class="bg-white rounded-[30px] shadow-2xl w-full max-w-2xl max-h-[90vh] flex flex-col overflow-hidden animate-modal-enter">
                                {{-- Header Modal Sticky --}}
                                <div class="bg-[#6155F5] px-8 py-5 flex justify-between items-center text-white flex-shrink-0">
                                    <h3 class="font-bold text-xl tracking-tight">Detail Materi</h3>
                                    <button onclick="closeModal('modal-detail-{{ $materi->id }}')" class="text-2xl hover:rotate-90 transition-transform duration-300">✕</button>
                                </div>
                                {{-- Info Ringkas Sticky --}}
                                <div class="px-10 pt-8 pb-4 space-y-6 text-left flex-shrink-0">
                                    <div>
                                        <div class="flex items-start justify-between gap-4">
                                            <h4 class="text-3xl font-black text-[#6155F5] leading-tight mb-2 flex-1">{{ $materi->judul_materi }}</h4>
                                            {{-- Nilai rating besar di dalam detail --}}
                                            <div class="text-right flex flex-col items-end flex-shrink-0">
                                                @if($jumlahUser > 0)
                                                    <span class="text-2xl font-black text-gray-800 flex items-center gap-1">⭐ {{ number_format($rataRata, 1) }}</span>
                                                    <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">{{ $jumlahUser }} Total Ulasan</span>
                                                @endif
                                            </div>
                                        </div>
                                        <span class="bg-indigo-100 text-indigo-700 px-4 py-1.5 rounded-full text-xs font-bold inline-block mt-1">{{ $materi->pelajaran }}</span>
                                    </div>
                                    <div class="grid grid-cols-2 gap-8 py-4 border-y border-gray-100">
                                        <div>
                                            <p class="text-[10px] uppercase tracking-widest text-gray-400 font-bold mb-1">Pengunggah</p>
                                            <p class="font-bold text-gray-700 text-lg">{{ $materi->user->username ?? '-' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-[10px] uppercase tracking-widest text-gray-400 font-bold mb-1">Tahun Upload</p>
                                            <p class="font-bold text-gray-700 text-lg">{{ $materi->tahun }}</p>
                                        </div>
                                    </div>
                                </div>
                                {{-- Area Deskripsi Scrollable --}}
                                <div class="px-10 pb-8 text-left overflow-y-auto flex-1 custom-scrollbar">
                                    <p class="text-[10px] uppercase tracking-widest text-gray-400 font-bold mb-3 sticky top-0 bg-white py-1">Deskripsi / Catatan</p>
                                    <div class="bg-gray-50 p-6 rounded-2xl text-sm text-gray-600 leading-relaxed italic border border-gray-100 whitespace-pre-line">
                                        {{ $materi->deskripsi ?? 'Tidak ada deskripsi tambahan untuk materi ini.' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- MODAL RATING --}}
                        <div id="modal-rate-{{ $materi->id }}" class="fixed inset-0 z-50 hidden bg-black/60 backdrop-blur-sm flex items-center justify-center p-4">
                            <div class="bg-white rounded-[40px] w-full max-w-md overflow-hidden shadow-2xl animate-modal-enter">
                                <form action="{{ route('materi.rate', $materi->id) }}" method="POST" class="p-10">
                                    @csrf
                                    <div class="text-center mb-8">
                                        <h3 class="text-2xl font-black text-gray-800 mb-2">Beri Penilaian</h3>
                                        <p class="text-gray-400 text-sm font-medium px-4 leading-relaxed italic">"{{ $materi->judul_materi }}"</p>
                                    </div>
                                    <input type="hidden" name="nilai" id="rating-value-{{ $materi->id }}" value="0">
                                    <div class="flex justify-center gap-3 mb-10">
                                        @for($i = 1; $i <= 5; $i++)
                                            <button type="button" onclick="setRating({{ $materi->id }}, {{ $i }})" onmouseover="hoverRating({{ $materi->id }}, {{ $i }})" onmouseleave="resetRating({{ $materi->id }})" class="star-{{ $materi->id }} text-gray-200 transition-all duration-200 transform hover:scale-125" data-value="{{ $i }}">
                                                <svg class="w-14 h-14" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                            </button>
                                        @endfor
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <button type="button" onclick="closeModal('modal-rate-{{ $materi->id }}')" class="py-4 bg-gray-100 text-gray-500 font-bold rounded-2xl hover:bg-gray-200 transition-colors">Batal</button>
                                        <button type="submit" class="py-4 bg-[#6155F5] text-white font-bold rounded-2xl shadow-xl shadow-indigo-100 hover:bg-[#4f44d8] transition-all transform active:scale-95">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- MODAL LAPORAN --}}
                        <div id="modal-report-{{ $materi->id }}" class="fixed inset-0 z-50 hidden bg-black/60 backdrop-blur-sm flex items-center justify-center p-4">
                            <div class="bg-white rounded-[40px] w-full max-w-md overflow-hidden shadow-2xl p-10 text-center animate-modal-enter">
                                <div class="w-20 h-20 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-6 text-4xl">⚠️</div>
                                <h3 class="text-2xl font-black text-gray-800">Laporkan Materi?</h3>
                                <p class="text-gray-400 text-sm mt-2 font-medium px-4">Bantu kami menjaga kualitas materi di Sinau Bareng.</p>
                                <textarea class="w-full mt-6 p-5 bg-gray-50 border border-gray-100 rounded-2xl text-sm outline-none focus:ring-2 focus:ring-red-500 transition-all" rows="3" placeholder="Jelaskan alasan pelaporan secara singkat..."></textarea>
                                <div class="grid grid-cols-2 gap-4 mt-8">
                                    <button onclick="closeModal('modal-report-{{ $materi->id }}')" class="py-3 bg-gray-100 text-gray-500 font-bold rounded-xl hover:bg-gray-200 transition-colors">Batal</button>
                                    <button class="py-3 bg-red-600 text-white font-bold rounded-xl shadow-lg shadow-red-100 hover:bg-red-700 transition-all">Kirim Laporan</button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr><td colspan="6" class="py-16 text-gray-400 italic font-medium">Yah, materi tidak ditemukan. Coba kata kunci lain?</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

    <script>
        let lockedRatings = {}; 
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        function setRating(materiId, val) {
            lockedRatings[materiId] = val;
            document.getElementById(`rating-value-${materiId}`).value = val;
            applyColor(materiId, val);
        }
        function hoverRating(materiId, val) { applyColor(materiId, val); }
        function removeRating(materiId) { applyColor(materiId, lockedRatings[materiId] || 0); }
        function applyColor(materiId, val) {
            const stars = document.querySelectorAll(`.star-${materiId}`);
            stars.forEach(star => {
                const starVal = parseInt(star.getAttribute('data-value'));
                if (starVal <= val) {
                    star.classList.remove('text-gray-200');
                    star.classList.add('text-yellow-400');
                } else {
                    star.classList.remove('text-yellow-400');
                    star.classList.add('text-gray-200');
                }
            });
        }
        window.onclick = function(event) {
            if (event.target.classList.contains('bg-black/60')) {
                event.target.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        }
    </script>
</x-layout.app_user>