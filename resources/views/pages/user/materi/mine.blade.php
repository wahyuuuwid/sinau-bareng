<x-layout.app_user title="Materi Saya">
    
    {{-- Header Halaman --}}
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-[26px] font-bold text-gray-900">Materi Saya</h1>
            <p class="text-gray-500 text-[14px] mt-1 font-medium">Kelola semua materi yang telah Anda unggah di sini.</p>
        </div>
        <a href="{{ route('materi.create') }}" class="bg-[#6155F5] text-white px-6 py-3 rounded-2xl font-bold text-sm shadow-lg shadow-indigo-100 hover:bg-[#5246e5] transition-all flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Unggah Materi Baru
        </a>
    </div>

    {{-- Pesan Sukses/Error --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-600 rounded-2xl text-sm font-bold">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabel Data --}}
    <div class="bg-white border border-[#D7D7D7] rounded-[24px] overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-5 text-[11px] font-bold text-gray-400 uppercase tracking-widest">Detail Materi</th>
                        <th class="px-6 py-5 text-[11px] font-bold text-gray-400 uppercase tracking-widest text-center">Mata Kuliah</th>
                        <th class="px-6 py-5 text-[11px] font-bold text-gray-400 uppercase tracking-widest text-center">Rating</th>
                        <th class="px-6 py-5 text-[11px] font-bold text-gray-400 uppercase tracking-widest text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($materis as $materi)
                        <tr class="hover:bg-gray-50/50 transition-all group">
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-indigo-50 text-[#6155F5] rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-800 line-clamp-1">{{ $materi->judul }}</p>
                                        <p class="text-[10px] text-gray-400 mt-0.5 italic">Diupload {{ $materi->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="px-3 py-1 bg-indigo-50 text-[#6155F5] rounded-lg text-[10px] font-bold uppercase">
                                    {{ $materi->mata_kuliah }}
                                </span>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <div class="flex items-center justify-center gap-1 text-amber-400">
                                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    <span class="text-sm font-bold text-gray-700">{{ $materi->rating ?? '0' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex justify-center gap-3">
                                    {{-- Lihat Detail --}}
                                    <a href="{{ route('materi.show', $materi->id) }}" class="p-2 text-indigo-500 hover:bg-indigo-50 rounded-lg transition-all" title="Detail">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>

                                    {{-- Hapus (Destroy) --}}
                                    <form action="{{ route('materi.destroy', $materi->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus materi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-all" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 bg-gray-50 text-gray-300 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                    </div>
                                    <p class="text-gray-400 font-medium italic text-sm">Belum ada materi yang Anda unggah.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-layout.app_user>