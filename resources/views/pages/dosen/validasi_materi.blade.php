@extends('components.layout.app')

@section('content')
<div class="flex min-h-screen bg-[#F4F4F4]">
    <x-layout.sidebar_dosen />

    <main class="flex-1 p-8">
        <x-layout.navbar_dosen />

        <nav class="text-sm font-medium text-gray-500 mb-6">
            Dashboard > <span class="text-gray-800">Validasi Materi</span>
        </nav>

        <div class="bg-white rounded-2xl shadow-sm p-8">
            <h3 class="text-lg font-bold text-gray-800 mb-6">Daftar Materi</h3>

            <div class="overflow-hidden rounded-xl border border-gray-100">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#6155F5] text-white">
                            <th class="p-4 text-center font-bold">No</th>
                            <th class="p-4 font-bold">Judul Konten</th>
                            <th class="p-4 font-bold">Pengunggah</th>
                            <th class="p-4 font-bold">Mata Kuliah</th>
                            <th class="p-4 font-bold text-center">Status</th>
                            <th class="p-4 font-bold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse($materis as $materi)
                        <tr class="border-b last:border-0 {{ $loop->iteration % 2 == 0 ? 'bg-gray-50' : 'bg-white' }}">
                            <td class="p-4 text-center font-semibold">{{ $loop->iteration }}</td>
                            <td class="p-4 font-medium">{{ $materi->judul_materi }}</td>
                            <td class="p-4 text-gray-600">{{ $materi->user->username }}</td>
                            <td class="p-4 text-gray-600 font-bold uppercase">{{ $materi->mataKuliah->nama_mk }}</td>
                            <td class="p-4 text-center">
                                @if($materi->status == 'pending')
                                    <span class="bg-yellow-100 text-yellow-600 px-4 py-1 rounded-full text-xs font-bold italic">Pending</span>
                                @elseif($materi->status == 'approved')
                                    <span class="bg-green-100 text-green-600 px-4 py-1 rounded-full text-xs font-bold italic">Approved</span>
                                @else
                                    <span class="bg-red-100 text-red-600 px-4 py-1 rounded-full text-xs font-bold italic">Rejected</span>
                                @endif
                            </td>
                            <td class="p-4 text-center">
                                <a href="{{ route('dosen.materi.show', $materi->id) }}" class="text-gray-400 hover:text-[#6155F5] transition-colors">
                                    <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-10 text-center text-gray-400 italic">Belum ada materi yang perlu divalidasi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
@endsection