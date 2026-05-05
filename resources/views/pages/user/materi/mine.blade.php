<x-layout.app_user title="Cari & Unduh Materi" class="bg-[#E5E5E5]">
    <main>
        <h1 class="text-3xl font-bold text-black mb-8">
            Materi > Cari & Unduh Materi
        </h1>

        {{-- Pesan Sukses --}}
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-xl mb-6 shadow-lg flex items-center gap-3 animate-bounce">
                <span class="font-bold">✅ {{ session('success') }}</span>
            </div>
        @endif

        {{-- FORM FILTER & SEARCH --}}
        <form method="GET" action="{{ route('materi.cari') }}">
            <div class="flex items-center gap-4 mb-8">
                <div class="relative flex-1 max-w-md shadow-sm rounded-xl overflow-hidden">
                    <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Masukan Kata Kunci..."
                        class="w-full pl-5 pr-12 py-3 border-none outline-none font-medium text-sm">
                    <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>

                <span class="font-bold text-gray-700 text-sm">Filter :</span>

                <select name="matkul" class="bg-white px-4 py-2 rounded-lg shadow-sm text-xs font-bold border-none focus:ring-2 focus:ring-[#6155F5]">
                    <option value="">Mata Kuliah</option>
                    @foreach($listMatkul as $m)
                        <option value="{{ $m->id }}" {{ request('matkul') == $m->id ? 'selected' : '' }}>{{ $m->nama_mk }}</option>
                    @endforeach
                </select>

                <select name="dosen" class="bg-white px-4 py-2 rounded-lg shadow-sm text-xs font-bold border-none focus:ring-2 focus:ring-[#6155F5]">
                    <option value="">Dosen</option>
                    @foreach($listDosen as $d)
                        <option value="{{ $d->id }}" {{ request('dosen') == $d->id ? 'selected' : '' }}>{{ $d->username }}</option>
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
                        <th class="py-5 px-4 font-bold border-l border-white/20 text-left">Matakuliah</th>
                        <th class="py-5 px-4 font-bold border-l border-white/20 text-left">Materi</th>
                        <th class="py-5 px-4 font-bold border-l border-white/20">Dosen</th>
                        <th class="py-5 px-4 font-bold border-l border-white/20">Tahun</th>
                        <th class="py-5 px-4 font-bold border-l border-white/20">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-[13px] font-semibold text-gray-700">
                    @forelse($materis as $index => $materi)
                        <tr class="border-b {{ $index % 2 == 1 ? 'bg-[#EFEEFF]' : 'bg-white' }} hover:bg-indigo-50 transition-colors">
                            <td class="py-4">{{ $index + 1 }}.</td>
                            <td class="text-left px-4">{{ $materi->mataKuliah->nama_mk ?? '-' }}</td>
                            <td class="text-left px-4">{{ $materi->judul_materi }}</td>
                            <td>{{ $materi->dosen->username ?? '-' }}</td>
                            <td>{{ $materi->tahun }}</td>
                            <td class="py-4">
                                <div class="flex justify-center items-center gap-3">
                                    {{-- Tombol Detail --}}
                                    <button onclick="openModal('modal-detail-{{ $materi->id }}')" class="p-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition-all">
                                        👁️
                                    </button>

                                    {{-- Tombol Laporkan --}}
                                    <button onclick="openModal('modal-report-{{ $materi->id }}')" class="p-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition-all">
                                        ⚠️
                                    </button>

                                    {{-- Tombol Rating --}}
                                    <button onclick="openModal('modal-rate-{{ $materi->id }}')" class="p-2 bg-yellow-100 text-yellow-600 rounded-lg hover:bg-yellow-500 hover:text-white transition-all">
                                        ⭐
                                    </button>

                                    {{-- Tombol Unduh --}}
                                    <a href="{{ asset('storage/' . $materi->file_path) }}" download class="p-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-800 hover:text-white transition-all">
                                        ⬇️
                                    </a>
                                </div>
                            </td>
                        </tr>

                        {{-- MODAL DETAIL --}}
                        <div id="modal-detail-{{ $materi->id }}" class="fixed inset-0 z-50 hidden bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
                            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl overflow-hidden animate-modal-enter">
                                <div class="bg-[#6155F5] px-6 py-4 flex justify-between items-center text-white">
                                    <h3 class="font-bold text-lg">Detail Materi</h3>
                                    <button onclick="closeModal('modal-detail-{{ $materi->id }}')">✕</button>
                                </div>
                                <div class="p-8 text-left">
                                    <h4 class="text-2xl font-black text-[#6155F5] mb-4">{{ $materi->judul_materi }}</h4>
                                    <div class="bg-gray-50 p-4 rounded-xl italic text-gray-600">
                                        {{ $materi->deskripsi ?? 'Tidak ada deskripsi.' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- MODAL RATING (BINTANG INTERAKTIF) --}}
                        <div id="modal-rate-{{ $materi->id }}" class="fixed inset-0 z-50 hidden bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
                            <div class="bg-white rounded-2xl w-full max-w-sm overflow-hidden animate-modal-enter shadow-2xl">
                                <form action="{{ route('materi.rate', $materi->id) }}" method="POST" class="p-8 text-center">
                                    @csrf
                                    <h3 class="text-xl font-black text-gray-800 mb-1">Beri Penilaian</h3>
                                    <p class="text-gray-400 text-xs mb-6">{{ $materi->judul_materi }}</p>
                                    
                                    <input type="hidden" name="nilai" id="rating-value-{{ $materi->id }}" value="0">

                                    <div class="flex justify-center gap-2 mb-8">
                                        @for($i = 1; $i <= 5; $i++)
                                            <button type="button" 
                                                onclick="setRating({{ $materi->id }}, {{ $i }})"
                                                onmouseover="hoverRating({{ $materi->id }}, {{ $i }})"
                                                onmouseleave="resetRating({{ $materi->id }})"
                                                class="star-{{ $materi->id }} text-gray-300 transition-all transform hover:scale-125"
                                                data-value="{{ $i }}">
                                                <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                            </button>
                                        @endfor
                                    </div>

                                    <div class="flex gap-3">
                                        <button type="button" onclick="closeModal('modal-rate-{{ $materi->id }}')" class="flex-1 py-4 bg-gray-100 text-gray-600 font-bold rounded-2xl">Batal</button>
                                        <button type="submit" class="flex-1 py-4 bg-[#6155F5] text-white font-bold rounded-2xl shadow-lg">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    @empty
                        <tr>
                            <td colspan="6" class="py-10 text-gray-400 italic">Materi tidak ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

    <style>
        .animate-modal-enter { animation: modalEnter 0.3s ease-out forwards; }
        @keyframes modalEnter {
            from { opacity: 0; transform: scale(0.9) translateY(20px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }
    </style>

    <script>
        let currentRatings = {};

        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function setRating(materiId, val) {
            currentRatings[materiId] = val;
            document.getElementById(`rating-value-${materiId}`).value = val;
            applyColor(materiId, val);
        }

        function hoverRating(materiId, val) { applyColor(materiId, val); }
        function resetRating(materiId) { applyColor(materiId, currentRatings[materiId] || 0); }

        function applyColor(materiId, val) {
            const stars = document.querySelectorAll(`.star-${materiId}`);
            stars.forEach(star => {
                const starVal = parseInt(star.getAttribute('data-value'));
                if (starVal <= val) {
                    star.classList.replace('text-gray-300', 'text-yellow-400');
                } else {
                    star.classList.replace('text-yellow-400', 'text-gray-300');
                }
            });
        }
    </script>
</x-layout.app_user>