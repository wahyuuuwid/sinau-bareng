@extends('components.layout.app')

@section('content')
<div class="flex min-h-screen bg-[#E5E5E5]">
    @include('components.layout.sidebar_user')

    <div class="flex-1 p-10">
        <h1 class="text-3xl font-bold text-black mb-8">Materi > Cari & Unduh Materi</h1>

        <div class="flex items-center gap-4 mb-8">
            <div class="relative flex-1 max-w-md shadow-sm rounded-xl overflow-hidden">
                <input type="text" placeholder="Masukan Kata Kunci" class="w-full pl-5 pr-12 py-3 border-none outline-none font-medium text-sm">
                <button class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </div>
            
            <span class="font-bold text-gray-700 text-sm">Filter :</span>
            
            <select class="bg-white px-4 py-2 rounded-lg shadow-sm border-none text-xs font-bold focus:ring-2 focus:ring-[#6155F5]">
                <option value="">Mata Kuliah</option>
                @foreach($listMatkul as $m)
                    <option value="{{ $m->mata_kuliah }}">{{ $m->mata_kuliah }}</option>
                @endforeach
            </select>

            <select class="bg-white px-4 py-2 rounded-lg shadow-sm border-none text-xs font-bold focus:ring-2 focus:ring-[#6155F5]">
                <option value="">Dosen</option>
                @foreach($listDosen as $d)
                    <option value="{{ $d->id }}">{{ $d->username }}</option>
                @endforeach
            </select>

            <select class="bg-white px-4 py-2 rounded-lg shadow-sm border-none text-xs font-bold focus:ring-2 focus:ring-[#6155F5]">
                <option value="">Tahun</option>
                <option value="2026">2026</option>
                <option value="2025">2025</option>
            </select>
        </div>

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
                            <td>{{ $materi->mata_kuliah }}</td>
                            <td>{{ $materi->user->username ?? 'Unknown' }}</td>
                            <td>{{ $materi->tahun }}</td>
                            <td>
                                {{-- Tombol Unduh beneran --}}
                                <a href="{{ asset('storage/' . $materi->file_path) }}" download 
                                    class="bg-gray-200 px-6 py-1 rounded-lg text-[10px] font-bold hover:bg-gray-300 transition-colors inline-block">
                                    Unduh
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-10 text-gray-400 italic">Belum ada materi tersedia untuk diunduh.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <button onclick="window.location.href='/user'" class="mt-10 bg-white px-8 py-2 rounded-lg shadow-sm flex items-center gap-3 font-bold text-sm hover:bg-gray-50 transition-all border border-gray-100">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Kembali
        </button>
    </div>
</div>
@endsection