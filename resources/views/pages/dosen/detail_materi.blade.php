<x-layout.app title="Detail Validasi Materi">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@400;500;600;700&display=swap');
    </style>

    <div class="min-h-screen bg-[#ECECEC] font-['Poppins'] text-[#000000] flex w-full overflow-x-hidden">
        
        <x-layout.sidebar_dosen />

        <main class="flex-1 relative pt-[32px] px-[24px] pb-[40px] min-w-0 flex flex-col">
            
            <x-layout.navbar_dosen>
                <h1 class="text-[22px] leading-[30px] font-semibold text-[#000000] m-0" style="font-family: 'Poppins', sans-serif;">
                    Detail Validasi Materi
                </h1>
            </x-layout.navbar_dosen>

            <div class="w-full flex flex-col flex-1 mt-4">
                
                {{-- Breadcrumb --}}
                <nav class="text-sm font-medium text-gray-500 mb-6">
                    <a href="{{ route('dosen.dashboard') }}" class="hover:text-[#6155F5]">Dashboard</a> > 
                    <a href="{{ route('dosen.validasi') }}" class="hover:text-[#6155F5]">Validasi Materi</a> > 
                    <span class="text-gray-800 font-semibold">Detail</span>
                </nav>

                <div class="bg-[#FFFFFF] border border-[#D7D7D7] rounded-[16px] p-[32px] relative shadow-sm flex flex-col">
                    
                    {{-- 1. Informasi Singkat --}}
                    <div class="flex justify-between items-start border-b border-gray-200 pb-6 mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $materi->judul_materi }}</h2>
                            <div class="flex gap-4 text-sm font-medium text-gray-500">
                                <span class="bg-indigo-50 text-indigo-700 px-3 py-1 rounded-md uppercase text-xs">{{ $materi->mataKuliah->nama_mk }}</span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    {{ $materi->user->username ?? 'Unknown' }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    {{ $materi->created_at->format('d M Y') }}
                                </span>
                            </div>
                        </div>
                        <div>
                            @if($materi->status == 'pending')
                                <span class="bg-[#FFF4E5] text-[#FF9800] border border-[#FF9800]/20 px-4 py-2 rounded-[8px] text-sm font-bold">Status: Pending</span>
                            @elseif($materi->status == 'approved')
                                <span class="bg-[#E8F5E9] text-[#4CAF50] border border-[#4CAF50]/20 px-4 py-2 rounded-[8px] text-sm font-bold">Status: Approved</span>
                            @else
                                <span class="bg-[#FFEBEE] text-[#F44336] border border-[#F44336]/20 px-4 py-2 rounded-[8px] text-sm font-bold">Status: Rejected</span>
                            @endif
                        </div>
                    </div>

                    {{-- 2. Preview Dokumen (PDF) --}}
                    <div class="mb-8">
                        <h3 class="text-sm font-bold text-gray-700 mb-3">Preview Dokumen:</h3>
                        <div class="w-full h-[600px] border-2 border-dashed border-gray-300 rounded-xl overflow-hidden bg-gray-50 flex items-center justify-center relative">
                            {{-- Gunakan iframe untuk merender PDF bawaan browser --}}
                            <iframe src="{{ asset('storage/' . $materi->file_path) }}" class="w-full h-full" title="Preview PDF"></iframe>
                            
                            {{-- Tombol fallback jika iframe tidak didukung --}}
                            <a href="{{ asset('storage/' . $materi->file_path) }}" target="_blank" class="absolute bottom-4 right-4 bg-white border border-gray-300 px-4 py-2 rounded-lg shadow-sm text-sm font-bold hover:bg-gray-50 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                Buka di Tab Baru
                            </a>
                        </div>
                    </div>

                    {{-- 3. Form Validasi & Feedback --}}
                    <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#6155F5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Tindakan Validasi
                        </h3>
                        
                        <form action="{{ route('dosen.materi.update', $materi->id) }}" method="POST" class="flex flex-col gap-4">
                            @csrf
                            @method('PATCH')
                            
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Pesan Tambahan / Alasan Penolakan (Wajib jika menolak)</label>
                                <textarea name="pesan" rows="3" placeholder="Tulis catatan, masukan, atau alasan mengapa materi ditolak..." class="w-full bg-white border border-gray-300 p-4 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#6155F5] focus:border-transparent transition-all"></textarea>
                            </div>

                            <div class="flex justify-end gap-3 mt-2">
                                <a href="{{ route('dosen.validasi') }}" class="px-6 py-2.5 bg-white border border-gray-300 text-gray-700 font-bold rounded-[8px] hover:bg-gray-50 transition-all text-sm">Batal</a>
                                
                                {{-- Tombol Tolak mengirimkan value 'rejected' --}}
                                <button type="submit" name="status" value="rejected" class="px-6 py-2.5 bg-[#FFEBEE] border border-[#F44336]/30 text-[#F44336] font-bold rounded-[8px] hover:bg-[#FFCDD2] transition-all text-sm flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    Tolak Materi
                                </button>
                                
                                {{-- Tombol Terima mengirimkan value 'approved' --}}
                                <button type="submit" name="status" value="approved" class="px-8 py-2.5 bg-[#6155F5] text-white font-bold rounded-[8px] hover:bg-[#4e44d4] shadow-md transition-all text-sm flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Terima Materi
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </main>
    </div>
</x-layout.app>