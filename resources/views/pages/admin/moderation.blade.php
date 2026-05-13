<x-layout.app title="Moderasi Konten">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@400;500;600&display=swap');
    </style>

    <div class="min-h-screen bg-[#ECECEC] font-['Poppins'] text-[#000000] flex w-full overflow-x-hidden">
        
        <x-layout.sidebar_admin />

        <main class="flex-1 relative pt-[32px] px-[24px] pb-[40px] min-w-0 flex flex-col">
            
            <x-layout.navbar_admin />

            <div class="mt-[32px] w-full flex flex-col flex-1">
                
                <div class="flex justify-between items-center mb-[24px]">
                    <div class="flex items-center gap-4">
                        <h1 class="text-[22px] leading-[30px] font-semibold text-[#000000]">Moderasi Konten</h1>
                        
                        <div class="flex items-center gap-2 bg-white border border-[#D7D7D7] px-[16px] py-[8px] rounded-[14px] shadow-sm">
                            <span class="text-[13px] text-gray-400 font-medium uppercase tracking-wider">Menunggu:</span>
                            {{-- Variabel yang tadi error sekarang sudah aman --}}
                            <span class="text-[15px] font-bold text-[#6155F5]">{{ $totalKonten }} Konten</span>
                        </div>
                    </div>
                </div>

                @if(session('success'))
                    <div class="mb-[20px] p-[16px] bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-[16px] text-[14px] font-medium flex items-center gap-3 shadow-sm">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        {{ session('success') }}
                    </div>
                @endif

                <div class="bg-[#FFFFFF] border border-[#D7D7D7] rounded-[20px] shadow-sm overflow-hidden flex flex-col">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse whitespace-nowrap">
                            <thead class="bg-gray-50/80 border-b border-gray-100">
                                <tr>
                                    <th class="px-[24px] py-[20px] text-[13px] font-bold text-gray-400 uppercase tracking-widest w-[80px]">No</th>
                                    <th class="px-[24px] py-[20px] text-[13px] font-bold text-gray-400 uppercase tracking-widest">Judul Materi</th>
                                    <th class="px-[24px] py-[20px] text-[13px] font-bold text-gray-400 uppercase tracking-widest">Pengunggah</th>
                                    <th class="px-[24px] py-[20px] text-[13px] font-bold text-gray-400 uppercase tracking-widest">Tanggal</th>
                                    <th class="px-[24px] py-[20px] text-[13px] font-bold text-gray-400 uppercase tracking-widest text-center">Aksi</th>
                                </tr>
                            </thead>
                            
                            <tbody class="divide-y divide-gray-100">
                                @forelse($kontens as $index => $konten)
                                <tr class="hover:bg-[#F9F9FC] transition-colors duration-200 group">
                                    <td class="px-[24px] py-[18px] text-[14px] font-medium text-gray-400">
                                        {{ sprintf('%02d', $index + 1) }}
                                    </td>
                                    <td class="px-[24px] py-[18px]">
                                        <div class="flex flex-col">
                                            <span class="text-[15px] font-semibold text-gray-800">{{ $konten->judul }}</span>
                                            <span class="text-[12px] text-gray-400 italic">ID: #{{ $konten->id }}</span>
                                        </div>
                                    </td>
                                    <td class="px-[24px] py-[18px] text-[14px] text-gray-600 font-medium">
                                        {{ $konten->user->username ?? 'Anonim' }}
                                    </td>
                                    <td class="px-[24px] py-[18px] text-[13px] text-gray-500 font-['Inter']">
                                        {{ $konten->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-[24px] py-[18px]">
                                        <div class="flex justify-center gap-[10px]">
                                            {{-- Tombol Lihat/Detail --}}
                                            <a href="#" class="px-4 py-2 bg-indigo-50 text-[#6155F5] rounded-xl text-xs font-bold hover:bg-indigo-100 transition-all">
                                                Tinjau
                                            </a>
                                            {{-- Tombol Hapus/Tolak --}}
                                            <form action="{{ route('admin.moderation.delete', $konten->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus konten ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="px-4 py-2 bg-red-50 text-red-600 rounded-xl text-xs font-bold hover:bg-red-100 transition-all">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="py-[60px] text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center text-gray-300 mb-3">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            </div>
                                            <p class="text-gray-500 font-medium">Semua konten bersih!</p>
                                            <p class="text-gray-400 text-xs mt-1">Tidak ada materi yang perlu dimoderasi saat ini.</p>
                                        </div>
                                    </td>
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