<x-layout.app_user title="Materi Saya - Sinau Bareng" class="bg-[#E5E5E5]">
    <main class="flex-1">
        <h1 class="text-3xl font-bold text-black mb-8">Materi > Materi Saya</h1>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-xl mb-6 shadow-lg flex items-center gap-3">
                <span class="font-bold">✅ {{ session('success') }}</span>
            </div>
        @endif

        {{-- FILTER & SEARCH FORM --}}
        <form action="{{ route('materi.index') }}" method="GET">
            <div class="flex items-center gap-4 mb-8">
                {{-- Search Input --}}
                <div class="relative flex-1 max-w-md shadow-sm rounded-xl overflow-hidden">
                    <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari materi saya..." 
                        class="w-full pl-5 pr-12 py-3 border-none outline-none font-medium text-sm">
                    <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </div>
                
                <span class="font-bold text-gray-700 text-sm ml-4">Filter :</span>

                {{-- Filter Matkul --}}
                <select name="matkul" onchange="this.form.submit()" class="bg-white px-4 py-2 rounded-lg shadow-sm border-none text-xs font-bold focus:ring-2 focus:ring-[#6155F5]">
                    <option value="">Mata Kuliah</option>
                    @foreach($listMatkul as $mk)
                        <option value="{{ $mk->id }}" {{ request('matkul') == $mk->id ? 'selected' : '' }}>
                            {{ $mk->nama_mk }}
                        </option>
                    @endforeach
                </select>

                {{-- Filter Dosen --}}
                <select name="dosen" onchange="this.form.submit()" class="bg-white px-4 py-2 rounded-lg shadow-sm border-none text-xs font-bold focus:ring-2 focus:ring-[#6155F5]">
                    <option value="">Dosen</option>
                    @foreach($listDosen as $ds)
                        <option value="{{ $ds->id }}" {{ request('dosen') == $ds->id ? 'selected' : '' }}>
                            {{ $ds->username }}
                        </option>
                    @endforeach
                </select>

                {{-- Filter Tahun --}}
                <select name="tahun" onchange="this.form.submit()" class="bg-white px-4 py-2 rounded-lg shadow-sm border-none text-xs font-bold focus:ring-2 focus:ring-[#6155F5]">
                    <option value="">Tahun</option>
                    @foreach($listTahun as $th)
                        <option value="{{ $th }}" {{ request('tahun') == $th ? 'selected' : '' }}>
                            {{ $th }}
                        </option>
                    @endforeach
                </select>

                @if(request()->anyFilled(['cari', 'matkul', 'dosen', 'tahun']))
                    <a href="{{ route('materi.index') }}" class="text-xs text-red-500 font-bold hover:underline">Reset</a>
                @endif
            </div>
        </form>

        {{-- TABEL DATA --}}
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
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
                            <td>{{ $materi->mataKuliah->nama_mk ?? '-' }}</td>
                            <td>{{ $materi->dosen->username ?? '-' }}</td>
                            <td>{{ $materi->tahun }}</td>
                            <td>
                                <div class="flex justify-center gap-3">
                                    <button class="hover:text-blue-500">👁️</button>
                                    <button class="hover:text-red-500">⚠️</button>
                                    <button class="hover:text-yellow-500">⭐</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-10 text-gray-400 italic">Materi tidak ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</x-layout.app_user>