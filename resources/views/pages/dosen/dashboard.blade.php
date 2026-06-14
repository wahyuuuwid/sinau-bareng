<x-layout.app title="Dashboard Dosen">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@400;500;600;700&display=swap');
    </style>

    <div class="min-h-screen bg-[#ECECEC] font-['Poppins'] text-[#000000] flex w-full overflow-x-hidden">
        
        <x-layout.sidebar_dosen />

        <main class="flex-1 relative pt-[32px] px-[24px] pb-[40px] min-w-0 flex flex-col">
            
            <div class="w-full flex flex-col flex-1">
                
                {{-- NAVBAR DENGAN SAPAAN SEJAJAR LONCENG --}}
                <x-layout.navbar_dosen>
                    <h1 class="text-[30px] leading-[30px] font-semibold text-[#000000] m-0" style="font-family: 'Poppins', sans-serif;">
                        Selamat datang, {{ auth()->user()->username }} 👋
                    </h1>
                </x-layout.navbar_dosen>

                {{-- Statistik Cards bergaya Admin (Light Theme) --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-[24px] mt-4">
                    
                    {{-- Card 1: Materi Menunggu --}}
                    <div class="h-[140px] bg-[#FFFFFF] border border-[#D7D7D7] rounded-[16px] relative overflow-hidden transition-transform hover:-translate-y-1 hover:shadow-lg duration-300">
                        <p class="absolute left-[24px] top-[20px] text-[15px] text-gray-500 font-medium">Materi Menunggu Validasi</p>
                        <h2 class="absolute left-[24px] top-[64px] text-[32px] font-bold text-[#000000]">{{ $countMenunggu }}</h2>
                        <div class="absolute right-[20px] top-[68px] w-[48px] h-[48px] bg-[#6155F5] opacity-10 rounded-[12px]"></div>
                        <svg class="absolute right-[20px] top-[68px] w-[48px] h-[48px] text-[#6155F5] p-[10px]" fill="currentColor" viewBox="0 0 20 20"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/></svg>
                    </div>

                    

                    {{-- Card 3: Sudah Disetujui --}}
                    <div class="h-[140px] bg-[#FFFFFF] border border-[#D7D7D7] rounded-[16px] relative overflow-hidden transition-transform hover:-translate-y-1 hover:shadow-lg duration-300">
                        <p class="absolute left-[24px] top-[20px] text-[15px] text-gray-500 font-medium">Sudah Disetujui</p>
                        <h2 class="absolute left-[24px] top-[64px] text-[32px] font-bold text-[#000000]">{{ $countDisetujui }}</h2>
                        <div class="absolute right-[20px] top-[68px] w-[48px] h-[48px] bg-[#10B981] opacity-10 rounded-[12px]"></div>
                        <svg class="absolute right-[20px] top-[68px] w-[48px] h-[48px] text-[#10B981] p-[10px]" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/></svg>
                    </div>

                </div>

                {{-- Tabel Validasi --}}
                <div class="mt-[24px] bg-[#FFFFFF] border border-[#D7D7D7] rounded-[16px] p-[24px] relative shadow-sm flex flex-col font-['Inter']">
                    <h3 class="text-[16px] font-semibold text-[#000000] mb-[20px] font-['Poppins']">Daftar Validasi Terbaru</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="py-4 px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-center">No</th>
                                    <th class="py-4 px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Judul Konten</th>
                                    <th class="py-4 px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Uploader</th>
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
                                        @endif
                                    </td>
                                    {{-- Kolom Aksi yang Fungsional Dipertahankan --}}
                                    <td class="py-4 px-4 text-center">
                                        <a href="{{ route('dosen.materi.show', $materi->id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-[#6155F5] text-white rounded-[8px] text-xs font-bold hover:bg-[#4e44d4] transition-all shadow-md">
                                            <span>Validasi</span>
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="py-12 px-4 text-center text-gray-500 italic">Belum ada materi yang perlu divalidasi saat ini.</td>
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