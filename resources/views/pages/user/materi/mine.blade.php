@extends('components.layout.app')

@section('content')
<div class="flex min-h-screen bg-[#E5E5E5]">
    {{-- Sidebar User --}}
    @include('components.layout.sidebar_user')

    <div class="flex-1 p-10">
        <h1 class="text-3xl font-bold text-black mb-8">Materi > Materi Saya</h1>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-xl mb-6 shadow-lg flex items-center gap-3 animate-fade-in-down">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-bold">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Filter Bar --}}
        <div class="flex items-center gap-4 mb-8">
            <div class="relative flex-1 max-w-md shadow-sm rounded-xl overflow-hidden">
                <input type="text" placeholder="Masukan Kata Kunci" class="w-full pl-5 pr-12 py-3 border-none outline-none font-medium text-sm">
                <button class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </div>
            
            <div class="flex items-center gap-2 ml-4">
                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4.5h18m-18 5h18m-18 5h18m-18 5h18"></path></svg>
                <span class="font-bold text-gray-700 text-sm">Filter :</span>
            </div>

            <select class="bg-white px-4 py-2 rounded-lg shadow-sm border-none text-xs font-bold focus:ring-2 focus:ring-[#6155F5]">
                <option>Mata Kuliah</option>
            </select>
            <select class="bg-white px-4 py-2 rounded-lg shadow-sm border-none text-xs font-bold focus:ring-2 focus:ring-[#6155F5]">
                <option>Dosen</option>
            </select>

            <div class="relative group">
                <button class="bg-white px-4 py-2 rounded-lg shadow-sm text-xs font-bold flex items-center gap-2 min-w-[100px] justify-between">
                    Tahun
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"></path></svg>
                </button>
            </div>
        </div>

        {{-- Tabel Dinamis --}}
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

                            {{--Memanggil nama Mata Kuliah  --}}
                            <td>{{ $materi->mataKuliah->nama_mk ?? 'Tidak Ada Matkul' }}</td>

                            {{--Memanggil nama Dosen Pengampu --}}
                            <td>{{ $materi->dosen->username ?? 'Tidak Ada Dosen' }}</td>

                            <td>{{ $materi->tahun }}</td>
                            <td>
                                <div class="flex justify-center gap-3 items-center">
                                    <button title="Lihat"><svg class="w-5 h-5 text-gray-500 hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg></button>
                                    <button title="Laporkan"><svg class="w-5 h-5 text-gray-500 hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg></button>
                                    <button title="Favorit"><svg class="w-5 h-5 text-gray-400 hover:text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg></button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-10 text-gray-400 italic">Belum ada materi yang kamu unggah.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <button onclick="window.location.href='/materi'"
        class="mt-12 bg-white px-8 py-2 rounded-lg shadow-sm flex items-center gap-3 font-bold text-sm hover:bg-gray-50 transition-all border border-gray-100 text-gray-600">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Kembali
        </button>
    </div>
</div>
@endsection