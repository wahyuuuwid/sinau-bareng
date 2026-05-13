<x-layout.app title="Admin Dashboard">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Poppins:wght@400;500&family=Roboto:wght@400&display=swap');
    </style>

    <div class="min-h-screen bg-[#ECECEC] font-['Poppins'] text-[#000000] flex w-full overflow-x-hidden">

        <x-layout.sidebar_admin />

        <main class="flex-1 relative pt-[32px] px-[24px] pb-[40px] min-w-0 flex flex-col">
            
            <x-layout.navbar_admin />

            <div class="mt-[32px] w-full flex flex-col flex-1">
                
                <h1 class="text-[22px] leading-[30px] font-semibold text-[#000000] mb-[20px]">Dashboard</h1>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-[24px]">
                    
                    <div class="h-[140px] bg-[#FFFFFF] border border-[#D7D7D7] rounded-[16px] relative overflow-hidden transition-transform hover:-translate-y-1 hover:shadow-lg duration-300">
                        <p class="absolute left-[24px] top-[20px] text-[16px] text-gray-500 font-medium">Total Pengguna</p>
                        <h2 class="absolute left-[24px] top-[64px] text-[32px] font-bold text-[#000000]">{{ $totalPengguna ?? 0 }}</h2>
                        <div class="absolute right-[20px] top-[68px] w-[48px] h-[48px] bg-[#6155F5] opacity-10 rounded-[12px]"></div>
                        <svg class="absolute right-[20px] top-[68px] w-[48px] h-[48px] text-[#6155F5] p-[10px]" fill="currentColor" viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
                    </div>

                    <div class="h-[140px] bg-[#FFFFFF] border border-[#CCCCCC] rounded-[16px] relative overflow-hidden transition-transform hover:-translate-y-1 hover:shadow-lg duration-300">
                        <p class="absolute left-[24px] top-[20px] text-[16px] text-gray-500 font-medium">Total Materi</p>
                        <h2 class="absolute left-[24px] top-[64px] text-[32px] font-bold text-[#000000]">{{ $totalMateri ?? 0 }}</h2>
                        <div class="absolute right-[20px] top-[68px] w-[48px] h-[48px] bg-[#6155F5] opacity-10 rounded-[12px]"></div>
                        <svg class="absolute right-[20px] top-[68px] w-[48px] h-[48px] text-[#6155F5] p-[10px]" fill="currentColor" viewBox="0 0 24 24"><path d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM9 9h10v2H9V9zm0 4h6v2H9v-2z"/></svg>
                    </div>

                    <div class="h-[140px] bg-[#FFFFFF] border border-[#D7D7D7] rounded-[16px] relative overflow-hidden transition-transform hover:-translate-y-1 hover:shadow-lg duration-300">
                        <p class="absolute left-[24px] top-[20px] text-[16px] text-gray-500 font-medium">Laporan Konten</p>
                        <h2 class="absolute left-[24px] top-[64px] text-[32px] font-bold text-[#000000]">{{ $totalLaporan ?? 0 }}</h2>
                        <div class="absolute right-[20px] top-[68px] w-[48px] h-[48px] bg-[#6155F5] opacity-10 rounded-[12px]"></div>
                        <svg class="absolute right-[20px] top-[68px] w-[48px] h-[48px] text-[#6155F5] p-[10px]" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
                    </div>

                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-[24px] mt-[24px] flex-1">
                    
                    <div class="lg:col-span-4 bg-[#FFFFFF] border border-[#D7D7D7] rounded-[16px] p-[24px] relative overflow-y-auto max-h-[600px] shadow-sm">
                        <h3 class="text-[16px] font-semibold text-[#000000] mb-[24px] sticky top-0 bg-white z-20 pb-2 border-b border-gray-100">Aktivitas Terbaru</h3>
                        
                        <div class="relative pl-[8px]">
                            <div class="absolute left-[17px] top-[10px] bottom-[10px] w-[2px] bg-gray-100 z-0"></div>
                            
                            <div class="space-y-[24px] relative z-10 pt-2">
                                @forelse($aktivitasTerbaru ?? [] as $act)
                                <div class="flex items-start gap-[16px]">
                                    <div class="w-[20px] h-[20px] bg-white border-[5px] border-[#6155F5] rounded-full flex-shrink-0 mt-[2px] shadow-sm"></div>
                                    <div class="font-['Inter']">
                                        <p class="text-[14px] leading-[20px] font-semibold text-gray-800 mb-[4px]">{{ $act->pesan }}</p>
                                        <p class="text-[12px] font-medium text-gray-400">{{ $act->waktu }}</p>
                                    </div>
                                </div>
                                @empty
                                <div class="flex flex-col items-center justify-center py-8">
                                    <p class="text-sm text-gray-400 italic">Belum ada aktivitas terekam.</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-8 flex flex-col gap-[24px]">
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-[24px]">
                            
                            <div class="h-[240px] bg-[#FFFFFF] border border-[#D7D7D7] rounded-[16px] p-[20px] relative flex flex-col items-center justify-center shadow-sm">
                                <h3 class="text-[15px] font-semibold text-[#000000] absolute left-[20px] top-[16px]">Distribusi Jenis Konten</h3>
                                <div class="relative w-[120px] h-[120px] mt-[20px]">
                                    <div class="w-full h-full rounded-full transition-all duration-500 shadow-inner" style="background: conic-gradient({{ $pieDistribusi ?? '#8979FF 0% 100%' }});"></div>
                                </div>
                                <div class="flex gap-[12px] mt-[20px] font-['Inter'] text-[12px] font-medium text-gray-600">
                                    <div class="flex items-center gap-[6px]"><span class="w-[10px] h-[10px] rounded-[3px] bg-[#8979FF]"></span> Materi Biasa</div>
                                    <div class="flex items-center gap-[6px]"><span class="w-[10px] h-[10px] rounded-[3px] bg-[#FF928A]"></span> Soal AI</div>
                                </div>
                            </div>

                            <div class="h-[240px] bg-[#FFFFFF] border border-[#D7D7D7] rounded-[16px] p-[20px] relative flex flex-col items-center justify-center shadow-sm">
                                <h3 class="text-[15px] font-semibold text-[#000000] absolute left-[20px] top-[16px]">Status Laporan</h3>
                                <div class="relative w-[120px] h-[120px] mt-[20px]">
                                    <div class="w-full h-full rounded-full flex items-center justify-center transition-all duration-500 shadow-inner" style="background: conic-gradient({{ $pieStatusLaporan ?? '#E5E5E5 0% 100%' }});">
                                        <div class="w-[64px] h-[64px] bg-white rounded-full shadow-sm"></div>
                                    </div>
                                </div>
                                <div class="flex gap-[12px] mt-[20px] font-['Inter'] text-[12px] font-medium text-gray-600">
                                    <div class="flex items-center gap-[6px]"><span class="w-[10px] h-[10px] rounded-[3px] bg-[#8979FF]"></span> Proses</div>
                                    <div class="flex items-center gap-[6px]"><span class="w-[10px] h-[10px] rounded-[3px] bg-[#FF928A]"></span> Selesai</div>
                                    <div class="flex items-center gap-[6px]"><span class="w-[10px] h-[10px] rounded-[3px] bg-[#3CC3DF]"></span> Batal</div>
                                </div>
                            </div>
                        </div>

                        <div class="w-full flex-1 min-h-[280px] bg-[#FFFFFF] border border-[#D7D7D7] rounded-[16px] p-[24px] relative shadow-sm flex flex-col">
                            <h3 class="text-[15px] font-semibold text-[#000000] mb-[20px]">Jumlah Upload Konten per Bulan</h3>
                            
                            <div class="flex-1 relative font-['Roboto'] text-[11px] text-gray-400 flex mt-2">
                                <div class="w-[30px] flex flex-col justify-between text-right pr-[8px] pb-[20px]">
                                    <span>Max</span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span>0</span>
                                </div>
                                
                                <div class="flex-1 border-l border-b border-dashed border-[#CCCCCC] relative mb-[20px] flex items-end justify-between px-[2%]">
                                    <div class="absolute inset-0 flex flex-col justify-between z-0">
                                        <div class="w-full border-b border-dashed border-[#E5E5E5] h-1/4"></div>
                                        <div class="w-full border-b border-dashed border-[#E5E5E5] h-1/4"></div>
                                        <div class="w-full border-b border-dashed border-[#E5E5E5] h-1/4"></div>
                                        <div class="w-full h-1/4"></div>
                                    </div>

                                    @if(isset($chartHeights))
                                        @foreach($chartHeights as $height)
                                        <div class="relative w-[5%] sm:w-[6%] h-full flex items-end justify-center z-10 group">
                                            <div class="w-full bg-[#6155F5] opacity-20 rounded-t-[4px] transition-all duration-500 group-hover:opacity-40" 
                                                 style="height: {{ $height > 0 ? $height : 1 }}%;"></div>
                                            <div class="absolute w-[8px] h-[8px] bg-white border-[2px] border-[#6155F5] rounded-full shadow-md" 
                                                 style="bottom: {{ $height }}%; margin-bottom: -4px;"></div>
                                        </div>
                                        @endforeach
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-300">Data belum tersedia</div>
                                    @endif
                                </div>

                                <div class="absolute bottom-0 left-[30px] right-0 flex justify-between px-[2%] text-[10px]">
                                    <span class="w-[5%] text-center">Jan</span>
                                    <span class="w-[5%] text-center">Feb</span>
                                    <span class="w-[5%] text-center">Mar</span>
                                    <span class="w-[5%] text-center">Apr</span>
                                    <span class="w-[5%] text-center">Mei</span>
                                    <span class="w-[5%] text-center">Jun</span>
                                    <span class="w-[5%] text-center">Jul</span>
                                    <span class="w-[5%] text-center">Ags</span>
                                    <span class="w-[5%] text-center">Sep</span>
                                    <span class="w-[5%] text-center">Okt</span>
                                    <span class="w-[5%] text-center">Nov</span>
                                    <span class="w-[5%] text-center">Des</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </main>
    </div>
</x-layout.app>