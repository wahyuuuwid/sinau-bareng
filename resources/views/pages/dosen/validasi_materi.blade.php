<x-layout.app title="Validasi Materi">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@400;500;600;700&display=swap');
    </style>

    <div class="min-h-screen bg-[#ECECEC] font-['Poppins'] text-[#000000] flex w-full overflow-x-hidden">
        
        <x-layout.sidebar_dosen />

        <main class="flex-1 relative pt-[32px] px-[24px] pb-[40px] min-w-0 flex flex-col">
            
            {{-- NAVBAR DENGAN JUDUL SEJAJAR LONCENG --}}
            <x-layout.navbar_dosen>
                <h1 class="text-[30px] leading-[30px] font-semibold text-[#000000] m-0" style="font-family: 'Poppins', sans-serif;">
                    Validasi Materi
                </h1>
            </x-layout.navbar_dosen>

            <div class="w-full flex flex-col flex-1 mt-4">
                
                {{-- Breadcrumb --}}
                <nav class="text-sm font-medium text-gray-500 mb-6">
                    Dashboard > <span class="text-gray-800 font-semibold">Validasi Materi</span>
                </nav>

                {{-- Tabel Validasi Bergaya Admin/Dosen Dashboard --}}
                <div class="bg-[#FFFFFF] border border-[#D7D7D7] rounded-[16px] p-[24px] relative shadow-sm flex flex-col font-['Inter']">
                    <h3 class="text-[16px] font-semibold text-[#000000] mb-[20px] font-['Poppins']">Daftar Materi</h3>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="py-4 px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-center">No</th>
                                    <th class="py-4 px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Judul Konten</th>
                                    <th class="py-4 px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Pengunggah</th>
                                    <th class="py-4 px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Mata Kuliah</th>
                                    <th class="py-4 px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-center">Status</th>
                                    <th class="py-4 px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-[14px]">
                                @forelse($materis as $materi)
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                    <td class="py-4 px-4 text-center text-gray-600">{{ $loop->iteration }}</td>
                                    <td class="py-4 px-4 font-semibold text-gray-800">{{ $materi->judul_materi }}</td>
                                    <td class="py-4 px-4 text-gray-500">{{ $materi->user->username }}</td>
                                    <td class="py-4 px-4 text-gray-500 font-semibold uppercase">{{ $materi->mataKuliah->nama_mk }}</td>
                                    <td class="py-4 px-4 text-center">
                                        @if($materi->status == 'pending')
                                            <span class="bg-[#FFF4E5] text-[#FF9800] border border-[#FF9800]/20 px-3 py-1.5 rounded-[6px] text-xs font-semibold">Pending</span>
                                        @elseif($materi->status == 'approved')
                                            <span class="bg-[#E8F5E9] text-[#4CAF50] border border-[#4CAF50]/20 px-3 py-1.5 rounded-[6px] text-xs font-semibold">Approved</span>
                                        @else
                                            <span class="bg-[#FFEBEE] text-[#F44336] border border-[#F44336]/20 px-3 py-1.5 rounded-[6px] text-xs font-semibold">Rejected</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-4 text-center">
                                        <a href="{{ route('dosen.materi.show', $materi->id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-[#6155F5] text-white rounded-[8px] text-xs font-bold hover:bg-[#4e44d4] transition-all shadow-md">
                                            <span>Detail</span>
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="py-12 px-4 text-center text-gray-500 italic">Belum ada materi yang perlu divalidasi.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-layout.app>