<x-layout.app_admin title="Manajemen Laporan - Sinau Admin">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Poppins:wght@400;500;600;700&display=swap');
        
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #6155F5; border-radius: 10px; }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
    </style>

    <div class=" bg-[#ECECEC] font(['Poppins']) text-[#000000] flex w-full overflow-x-hidden">

        <main class="flex-1 relative pt-[32px] px-[24px] pb-[40px] min-w-0 flex flex-col">
            
            <div class=" w-full flex flex-col flex-1">
                
                {{-- HEADER AREA --}}
                <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-[24px] gap-4">
                    <div>
                        
                        <h1 class="text-[26px] leading-[34px] font-bold text-[#000000]">Manajemen Laporan</h1>
                        <p class="text-[14px] text-gray-500 font-medium">Tinjau laporan dan amankan komunitas dari konten bermasalah.</p>
                    </div>

                    {{-- QUICK FILTER TABS --}}
                    <div class="flex bg-white p-1 rounded-[14px] border border-[#D7D7D7] shadow-sm">
                        <button class="px-4 py-2 bg-[#6155F5] text-white rounded-[10px] text-[12px] font-bold shadow-md shadow-indigo-100 transition-all">Semua</button>
                        <button class="px-4 py-2 text-gray-400 hover:text-gray-600 rounded-[10px] text-[12px] font-bold transition-all">Pending</button>
                        <button class="px-4 py-2 text-gray-400 hover:text-gray-600 rounded-[10px] text-[12px] font-bold transition-all">Dihapus</button>
                    </div>
                </div>

                @if(session('success'))
                <div class="mb-[24px] bg-emerald-50 border border-emerald-100 text-emerald-700 px-[20px] py-[14px] rounded-[16px] text-[14px] font-bold flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="bg-emerald-500 text-white p-1 rounded-full">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        {{ session('success') }}
                    </div>
                    <button class="text-emerald-400 hover:text-emerald-600">✕</button>
                </div>
                @endif

                {{-- MAIN TABLE CARD --}}
                <div class="bg-white border border-[#D7D7D7] rounded-[24px] shadow-sm flex-1 flex flex-col overflow-hidden glass-card">
                    
                    {{-- TABLE TOOLBAR --}}
                    <div class="px-[24px] py-[18px] border-b border-gray-100 flex justify-between items-center bg-white/50">
                        <h3 class="text-[15px] font-bold text-gray-800">Daftar Laporan Aktif <span class="ml-2 px-2 py-0.5 bg-gray-100 text-gray-400 rounded-full text-[10px]">{{ $reports->count() }}</span></h3>
                        <div class="flex gap-2">
                            <button class="p-2 hover:bg-gray-100 rounded-lg text-gray-400 transition-all" title="Refresh Data">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            </button>
                        </div>
                    </div>

                    <div class="overflow-x-auto custom-scrollbar flex-1">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-[11px] font-bold text-gray-400 uppercase tracking-[0.15em] bg-gray-50/30">
                                    <th class="px-[24px] py-[16px]">Info Materi</th>
                                    <th class="px-[24px] py-[16px]">Detail Pelaporan</th>
                                    <th class="px-[24px] py-[16px] text-center">Status</th>
                                    <th class="px-[24px] py-[16px] text-center">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse($reports as $report)
                                <tr class="group hover:bg-indigo-50/30 transition-all duration-300">
                                    <td class="px-[24px] py-[22px]">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 bg-white border border-gray-100 rounded-xl flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                                <svg class="w-5 h-5 text-[#6155F5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            </div>
                                            <div class="flex flex-col gap-0.5">
                                                <span class="text-[14px] font-bold text-gray-900 leading-tight">
                                                    {{ $report->materi->judul ?? 'Materi Terhapus' }}
                                                </span>
                                                <span class="text-[11px] font-semibold text-gray-400 flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path></svg>
                                                    {{ $report->user->username ?? 'Anonim' }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-[24px] py-[22px]">
                                        <div class="bg-gray-50 group-hover:bg-white p-3 rounded-xl border border-gray-100 transition-colors">
                                            <p class="text-[13px] font-['Inter'] text-gray-600 leading-[1.6] max-w-[300px]">
                                                "{{ $report->alasan }}"
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-[24px] py-[22px] text-center">
                                        <div class="flex flex-col items-center gap-1">
                                            <span class="px-3 py-1 bg-amber-100 text-amber-600 rounded-lg text-[10px] font-black uppercase tracking-tighter border border-amber-200 shadow-sm">
                                                Perlu Tinjauan
                                            </span>
                                            <span class="text-[9px] text-gray-400 font-medium">{{ $report->created_at->diffForHumans() }}</span>
                                        </div>
                                    </td>
                                    <td class="px-[24px] py-[22px]">
                                        <div class="flex items-center justify-center gap-3">
                                            {{-- Form Abaikan --}}
                                            <form action="{{ route('admin.laporan.ignore', $report->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="p-2.5 bg-white border border-gray-200 text-gray-400 rounded-xl hover:text-emerald-500 hover:border-emerald-200 hover:bg-emerald-50 transition-all shadow-sm" title="Abaikan Laporan">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                </button>
                                            </form>

                                            {{-- Form Hapus --}}
                                            <form action="{{ route('admin.laporan.delete', $report->id) }}" method="POST" onsubmit="return confirm('Materi ini akan dihapus permanen. Lanjutkan?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2.5 bg-white border border-gray-200 text-gray-400 rounded-xl hover:text-red-500 hover:border-red-200 hover:bg-red-50 transition-all shadow-sm" title="Hapus Materi">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-[24px] py-[100px] text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4 border border-dashed border-gray-200">
                                                <svg class="w-10 h-10 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            </div>
                                            <p class="text-[16px] font-semibold text-gray-400">Semua Bersih!</p>
                                            <p class="text-[13px] text-gray-300">Tidak ada materi yang dilaporkan saat ini.</p>
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
</x-layout.app_admin>