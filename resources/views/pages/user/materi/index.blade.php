<x-layout.app_user title="Cari & Unduh Materi" class="bg-[#E5E5E5]">
    <main>
        <h1 class="text-3xl font-bold text-black mb-8">
            Materi > Cari & Unduh Materi
        </h1>

        {{-- FORM FILTER & SEARCH --}}
        <form method="GET" action="{{ route('materi.cari') }}">
            <div class="flex items-center gap-4 mb-8">

                {{-- SEARCH INPUT --}}
                <div class="relative flex-1 max-w-md shadow-sm rounded-xl overflow-hidden">
                    <input 
                        type="text" 
                        name="cari" 
                        value="{{ request('cari') }}" 
                        placeholder="Masukan Kata Kunci..."
                        class="w-full pl-5 pr-12 py-3 border-none outline-none font-medium text-sm"
                    >
                    <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>

                <span class="font-bold text-gray-700 text-sm">Filter :</span>

                {{-- FILTER MATAKULIAH --}}
                <select name="matkul" class="bg-white px-4 py-2 rounded-lg shadow-sm text-xs font-bold focus:ring-2 focus:ring-[#6155F5]">
                    <option value="">Mata Kuliah</option>
                    @foreach($listMatkul as $m)
                        <option value="{{ $m->id }}" {{ request('matkul') == $m->id ? 'selected' : '' }}>
                            {{ $m->nama_mk }} {{-- Menggunakan nama_mk agar tersambung --}}
                        </option>
                    @endforeach
                </select>

                {{-- FILTER DOSEN --}}
                <select name="dosen" class="bg-white px-4 py-2 rounded-lg shadow-sm text-xs font-bold focus:ring-2 focus:ring-[#6155F5]">
                    <option value="">Dosen</option>
                    @foreach($listDosen as $d)
                        <option value="{{ $d->id }}" {{ request('dosen') == $d->id ? 'selected' : '' }}>
                            {{ $d->username }}
                        </option>
                    @endforeach
                </select>

                {{-- FILTER TAHUN --}}
                <select name="tahun" class="bg-white px-4 py-2 rounded-lg shadow-sm text-xs font-bold focus:ring-2 focus:ring-[#6155F5]">
                    <option value="">Tahun</option>
                    @foreach($listTahun as $t)
                        <option value="{{ $t }}" {{ request('tahun') == $t ? 'selected' : '' }}>
                            {{ $t }}
                        </option>
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
                        <th class="py-5 px-4 font-bold border-l border-white/20">Materi</th>
                        <th class="py-5 px-4 font-bold border-l border-white/20">Matakuliah</th>
                        <th class="py-5 px-4 font-bold border-l border-white/20">Dosen</th>
                        <th class="py-5 px-4 font-bold border-l border-white/20">Tahun</th>
                        <th class="py-5 px-4 font-bold border-l border-white/20">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-[13px] font-semibold">
                    @forelse($materis as $index => $materi)
                        <tr class="border-b {{ $index % 2 == 1 ? 'bg-[#EFEEFF]' : 'bg-white' }}">
                            <td class="py-4">{{ $index + 1 }}.</td>
                            <td>{{ $materi->judul_materi }}</td>
                            {{-- Field nama_mk agar data muncul --}}
                            <td>{{ $materi->mataKuliah->nama_mk ?? '-' }}</td>
                            {{-- Relasi dosen agar username muncul --}}
                            <td>{{ $materi->dosen->username ?? '-' }}</td>
                            <td>{{ $materi->tahun }}</td>
                            <td>
                                <a href="{{ asset('storage/' . $materi->file_path) }}" 
                                   download
                                   class="bg-gray-200 px-6 py-1 rounded-lg text-[10px] font-bold hover:bg-gray-300 transition-colors inline-block">
                                    Unduh
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-10 text-gray-400 italic">
                                Belum ada materi yang tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- {{-- BACK BUTTON --}}
        <button onclick="window.location.href='/student/dashboard'" 
            class="mt-10 bg-white px-8 py-2 rounded-lg shadow-sm flex items-center gap-3 font-bold text-sm hover:bg-gray-50 border border-gray-100 transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali
        </button> -->
    </main>
</x-layout.app_user>