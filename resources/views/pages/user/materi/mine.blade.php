<x-layout.app_user title="Materi Saya - Sinau Bareng" class="bg-[#E5E5E5]">
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
            Materi > Materi Saya
        </h1>

        {{-- Pesan Sukses --}}
        @if(session('success'))
            <div id="alert-success" class="bg-green-500 text-white p-4 rounded-2xl mb-6 shadow-lg flex items-center justify-between animate-bounce">
                <div class="flex items-center gap-3">
                    <span class="font-bold">✅ {{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-white/70 hover:text-white font-bold">✕</button>
            </div>
        @endif

        {{-- FORM FILTER & SEARCH --}}
        <form method="GET" action="{{ route('materi.saya') }}">
            <div class="flex flex-wrap items-center gap-4 mb-8">
                <div class="relative flex-1 min-w-[300px] shadow-sm rounded-xl overflow-hidden">
                    <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari materi saya..."
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

        {{-- TABEL DATA MATERI SAYA --}}
        <div class="bg-white rounded-xl overflow-hidden shadow-md">
            <table class="w-full text-center">
                <thead>
                    <tr class="bg-[#6155F5] text-white text-sm">
                        <th class="py-5 px-4 font-bold">No</th>
                        <th class="py-5 px-4 font-bold border-l border-white/20 text-left">Pelajaran</th>
                        <th class="py-5 px-4 font-bold border-l border-white/20 text-left">Materi</th>
                        <th class="py-5 px-4 font-bold border-l border-white/20">Tahun</th>
                        <th class="py-5 px-4 font-bold border-l border-white/20">Status</th>
                        <th class="py-5 px-4 font-bold border-l border-white/20">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-[13px] font-semibold text-gray-700">
                    @forelse($materis as $index => $materi)
                        <tr class="border-b {{ $index % 2 == 1 ? 'bg-[#EFEEFF]' : 'bg-white' }} hover:bg-indigo-50 transition-colors">
                            <td class="py-4">{{ $index + 1 }}.</td>
                            <td class="text-left px-4 italic text-gray-600">{{ $materi->pelajaran }}</td>
                            <td class="text-left px-4 font-bold text-gray-900">{{ $materi->judul_materi }}</td>
                            <td>{{ $materi->tahun }}</td>
                            <td>
                                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide
                                    {{ $materi->status == 'approved' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $materi->status == 'pending' ? 'bg-yellow-100 text-yellow-700 animate-pulse' : '' }}
                                    {{ $materi->status == 'rejected' ? 'bg-red-100 text-red-700' : '' }}">
                                    {{ $materi->status }}
                                </span>
                            </td>
                            <td class="py-4">
                                <div class="flex justify-center items-center gap-2 px-2">
                                    <button onclick="openModal('modal-detail-{{ $materi->id }}')" class="p-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition-all" title="Detail">👁️</button>
                                    <a href="{{ asset('storage/' . $materi->file_path) }}" download class="p-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-800 hover:text-white transition-all" title="Unduh">⬇️</a>
                                </div>
                            </td>
                        </tr>

                        {{-- MODAL DETAIL SAYA (FIXED STICKY HEADER & INFO) --}}
                        <div id="modal-detail-{{ $materi->id }}" class="fixed inset-0 z-50 hidden bg-black/60 backdrop-blur-sm flex items-center justify-center p-4">
                            <div class="bg-white rounded-[30px] shadow-2xl w-full max-w-2xl max-h-[90vh] flex flex-col overflow-hidden animate-modal-enter">
                                {{-- 1. Header Sticky --}}
                                <div class="bg-[#6155F5] px-8 py-5 flex justify-between items-center text-white flex-shrink-0">
                                    <h3 class="font-bold text-xl tracking-tight">Detail Materi Saya</h3>
                                    <button onclick="closeModal('modal-detail-{{ $materi->id }}')" class="text-2xl hover:rotate-90 transition-transform duration-300">✕</button>
                                </div>
                                {{-- 2. Info Ringkas Sticky --}}
                                <div class="px-10 pt-8 pb-4 space-y-6 text-left flex-shrink-0">
                                    <div>
                                        <h4 class="text-3xl font-black text-[#6155F5] leading-tight mb-2">{{ $materi->judul_materi }}</h4>
                                        <span class="bg-indigo-100 text-indigo-700 px-4 py-1.5 rounded-full text-xs font-bold">{{ $materi->pelajaran }}</span>
                                    </div>
                                    <div class="grid grid-cols-2 gap-8 py-4 border-y border-gray-100">
                                        <div>
                                            <p class="text-[10px] uppercase tracking-widest text-gray-400 font-bold mb-1">Status Verifikasi</p>
                                            <p class="font-bold text-gray-700 text-lg uppercase tracking-wide">{{ $materi->status }}</p>
                                        </div>
                                        <div>
                                            <p class="text-[10px] uppercase tracking-widest text-gray-400 font-bold mb-1">Tahun Upload</p>
                                            <p class="font-bold text-gray-700 text-lg">{{ $materi->tahun }}</p>
                                        </div>
                                    </div>
                                </div>
                                {{-- 3. Area Deskripsi Scrollable --}}
                                <div class="px-10 pb-8 text-left overflow-y-auto flex-1 custom-scrollbar">
                                    <p class="text-[10px] uppercase tracking-widest text-gray-400 font-bold mb-3 sticky top-0 bg-white py-1">Deskripsi / Catatan</p>
                                    <div class="bg-gray-50 p-6 rounded-2xl text-sm text-gray-600 leading-relaxed italic border border-gray-100 whitespace-pre-line">
                                        {{ $materi->deskripsi ?? 'Tidak ada deskripsi tambahan untuk materi ini.' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr><td colspan="6" class="py-16 text-gray-400 italic font-medium">Kamu belum mengunggah materi apapun.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        window.onclick = function(event) {
            if (event.target.classList.contains('bg-black/60')) {
                event.target.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        }
    </script>
</x-layout.app_user>