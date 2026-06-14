<x-layout.app_admin title="Moderasi Konten">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@400;500;600&display=swap');
    </style>

    <div class="bg-[#ECECEC] font-['Poppins'] text-[#000000] flex w-full overflow-x-hidden" x-data="{
    showModal: false,
    showDeleteModal: false,
    selected: null,
    deleteUrl: '',
    isEdit: false,

    openModal(data) {
        this.selected = data;
        this.showModal = true;
        this.isEdit = false;
    },

    closeModal() {
        this.showModal = false;
        this.selected = null;
        this.isEdit = false;
    },

    enableEdit() {
        this.isEdit = true;
    },

    openDelete(url) {
        this.deleteUrl = url;
        this.showDeleteModal = true;
    },

    closeDelete() {
        this.showDeleteModal = false;
        this.deleteUrl = '';
    },

    isPdf(file) {
        return file && file.endsWith('.pdf');
    },

    isOffice(file) {
        return file && (
            file.endsWith('.doc') ||
            file.endsWith('.docx') ||
            file.endsWith('.ppt') ||
            file.endsWith('.pptx') ||
            file.endsWith('.txt')
        );
    }
}">
        
        <main class="flex-1 relative pt-[32px] px-[24px] min-w-0 flex flex-col">
            
            <div class="w-full flex flex-col flex-1">
                
                <div class="flex justify-between items-center mb-[24px]">
                    <div class="flex items-center gap-4">
                        <h1 class="text-[22px] leading-[30px] font-semibold text-[#000000]">Moderasi Konten</h1>
                        
                        <div class="flex items-center gap-2 bg-white border border-[#D7D7D7] px-[16px] py-[8px] rounded-[14px] shadow-sm">
                           <span class="text-[13px] text-gray-400 font-medium uppercase tracking-wider">Total:</span>
<span class="text-[15px] font-bold text-[#6155F5]">
    {{ $kontens->total() }} Konten
</span>
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
                                    <th class="px-[24px] py-[20px] text-[13px] font-bold text-gray-400 uppercase tracking-widest text-center">Status</th>
                                    <th class="px-[24px] py-[20px] text-[13px] font-bold text-gray-400 uppercase tracking-widest text-center">Aksi</th>
                                </tr>
                            </thead>
                            
                            <tbody class="divide-y divide-gray-100">
                                @forelse($kontens as $index => $konten)
                                <tr class="hover:bg-[#F9F9FC] transition-colors duration-200 group">
                                    <td class="px-[24px] py-[18px] text-[14px] font-medium text-gray-400">
                                       {{ sprintf('%02d', $kontens->firstItem() + $index) }}
                                    </td>
                                    <td class="px-[24px] py-[18px]">
                                        <div class="flex flex-col">
                                            <span class="text-[15px] font-semibold text-gray-800">{{ $konten->judul_materi }}</span>
                                            <!-- <span class="text-[12px] text-gray-400 italic">ID: #{{ $konten->id }}</span> -->
                                        </div>
                                    </td>
                                    <td class="px-[24px] py-[18px] text-[14px] text-gray-600 font-medium">
                                        {{ $konten->user->username ?? 'Anonim' }}
                                    </td>
                                    <td class="px-[24px] py-[18px] text-[13px] text-gray-500 font-['Inter']">
                                        {{ $konten->created_at->format('d M Y') }}
                                    </td>

                                     <td class="px-[24px] py-[18px] text-center">
                                        @if($konten->status === 'pending')
                                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-amber-50 text-amber-600 rounded-full text-xs font-bold border border-amber-100">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                                Pending
                                            </span>
                                        @elseif($konten->status === 'approved')
                                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-xs font-bold border border-emerald-100">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                Published
                                            </span>
                                        @elseif($konten->status === 'rejected')
                                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-red-50 text-red-600 rounded-full text-xs font-bold border border-red-100">
                                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                                Rejected
                                            </span>
                                        @endif
                                    </td>
                                    
                                    <td class="px-[24px] py-[18px]">
                                        <div class="flex justify-center gap-[10px]">
                                            {{-- Tombol Lihat/Detail --}}
                                           <button
    type="button"
    @click="openModal({
        id: '{{ $konten->id }}',
        mata_kuliah_id: '{{ $konten->mataKuliah->nama_mk ?? 'N/A' }}',
        dosen_id: '{{ $konten->dosen->username ?? 'Anonim' }}',
        user_id: '{{ $konten->user->username ?? 'Anonim' }}',
        judul_materi: '{{ addslashes($konten->judul_materi) }}',
        deskripsi: '{{ addslashes($konten->deskripsi) }}',
        rating: '{{ $konten->rating }}',
        file_path: '{{ $konten->file_path }}',
        tahun: '{{ $konten->tahun }}',
        status: '{{ $konten->status }}',
        created_at: '{{ $konten->created_at->format("d M Y") }}'
    })"
    class="px-4 py-2 bg-indigo-50 text-[#6155F5] rounded-xl text-xs font-bold hover:bg-indigo-100 transition-all"
>
    Tinjau
</button>
                                            {{-- Tombol Hapus/Tolak --}}
                                           <button
    @click="openDelete('{{ route('admin.moderation.delete', $konten->id) }}')"
    class="px-4 py-2 bg-red-50 text-red-600 rounded-xl text-xs font-bold hover:bg-red-100 transition-all"
>
    Hapus
</button>
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
                    @if ($kontens->hasPages())
<div class="flex items-center justify-between px-6 py-4 border-t border-gray-100 bg-white">

    <p class="text-sm text-gray-500">
        Menampilkan {{ $kontens->firstItem() }}
        - {{ $kontens->lastItem() }}
        dari {{ $kontens->total() }} konten
    </p>

    <div class="flex items-center gap-2">

        {{-- Previous --}}
        @if ($kontens->onFirstPage())
            <span class="w-10 h-10 flex items-center justify-center bg-gray-100 text-gray-300 rounded-xl cursor-not-allowed">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 19l-7-7 7-7"/>
                </svg>
            </span>
        @else
            <a href="{{ $kontens->previousPageUrl() }}"
               class="w-10 h-10 flex items-center justify-center bg-white border border-gray-200 rounded-xl hover:bg-gray-50 hover:border-[#6155F5] hover:text-[#6155F5] transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
        @endif

        {{-- Page Numbers --}}
        @foreach ($kontens->getUrlRange(1, $kontens->lastPage()) as $page => $url)

            @if ($page == $kontens->currentPage())
                <span class="w-10 h-10 flex items-center justify-center bg-[#6155F5] text-white rounded-xl font-semibold shadow-md">
                    {{ $page }}
                </span>
            @else
                <a href="{{ $url }}"
                   class="w-10 h-10 flex items-center justify-center bg-white border border-gray-200 rounded-xl hover:bg-gray-50 hover:border-[#6155F5] hover:text-[#6155F5] transition-all">
                    {{ $page }}
                </a>
            @endif

        @endforeach

        {{-- Next --}}
        @if ($kontens->hasMorePages())
            <a href="{{ $kontens->nextPageUrl() }}"
               class="w-10 h-10 flex items-center justify-center bg-white border border-gray-200 rounded-xl hover:bg-gray-50 hover:border-[#6155F5] hover:text-[#6155F5] transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        @else
            <span class="w-10 h-10 flex items-center justify-center bg-gray-100 text-gray-300 rounded-xl cursor-not-allowed">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5l7 7-7 7"/>
                </svg>
            </span>
        @endif

    </div>

</div>
@endif
                </div>

            </div>

            <!-- MODAL -->
<!-- MODAL TINJAU MATERI -->
<div
    x-show="showModal"
    x-cloak
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-[999] flex items-center justify-center bg-black/50 backdrop-blur-md px-4 py-6"
>
    <div 
        x-show="showModal"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-4"
        class="bg-white w-full max-w-4xl rounded-3xl shadow-2xl relative overflow-hidden flex flex-col max-h-[90vh]"
        @click.away="closeModal()"
    >
        <!-- Header -->
        <div class="px-8 py-6 border-b border-gray-100 flex items-center justify-between bg-gradient-to-r from-gray-50 to-white">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-indigo-100 rounded-2xl flex items-center justify-center text-[#6155F5]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Tinjau Materi</h2>
                    <p class="text-sm text-gray-500 mt-0.5">ID: <span x-text="selected?.id" class="font-mono text-gray-400"></span></p>
                </div>
            </div>
            
            <!-- Status Badge -->
            <div x-show="selected?.status">
                <span 
                    x-show="selected?.status === 'pending'"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-amber-50 text-amber-700 rounded-full text-sm font-bold border border-amber-200 shadow-sm"
                >
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-amber-500"></span>
                    </span>
                    Menunggu Moderasi
                </span>
                <span 
                    x-show="selected?.status === 'published'"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-50 text-emerald-700 rounded-full text-sm font-bold border border-emerald-200 shadow-sm"
                >
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                    Published
                </span>
            </div>

            <button @click="closeModal()" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 p-2 rounded-xl transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Content -->
        <div class="overflow-y-auto p-8">
            
            <!-- VIEW MODE -->
            <div x-show="!isEdit" class="space-y-6">
                
                <!-- Main Info Grid -->
                <div class="grid grid-cols-12 gap-6">
                    
                    <!-- Left: Primary Info -->
                    <div class="col-span-8 space-y-6">
                        <!-- Judul -->
                        <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100">
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Judul Materi</p>
                            <h3 x-text="selected?.judul_materi" class="text-lg font-bold text-gray-900 leading-snug"></h3>
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Deskripsi</p>
                            <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100">
                                <p x-text="selected?.deskripsi || 'Tidak ada deskripsi'" 
                                   class="text-sm text-gray-600 leading-relaxed"
                                   :class="!selected?.deskripsi && 'italic text-gray-400'"></p>
                            </div>
                        </div>

                        <!-- File Preview -->
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">File Materi</p>
                            
                            <div class="border border-gray-200 rounded-2xl overflow-hidden bg-white shadow-sm">
                                <!-- File Info Bar -->
                                <div class="px-5 py-4 bg-gray-50 border-b border-gray-100 flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <!-- PDF Icon -->
                                        <div x-show="selected?.file_path?.endsWith('.pdf')" class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center text-red-600">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/></svg>
                                        </div>
                                        <!-- Office Icon -->
                                        <div x-show="!selected?.file_path?.endsWith('.pdf')" class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-800" x-text="selected?.file_path?.split('/').pop() || 'File tidak tersedia'"></p>
                                            <p class="text-xs text-gray-500" x-text="selected?.file_path?.endsWith('.pdf') ? 'PDF Document' : 'Office Document'"></p>
                                        </div>
                                    </div>
                                    <a :href="'/storage/' + selected?.file_path" 
                                       target="_blank"
                                       class="px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-xl text-xs font-bold hover:border-[#6155F5] hover:text-[#6155F5] transition-all flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                        </svg>
                                        Download
                                    </a>
                                </div>

                                <!-- Preview Area -->
                                <div class="p-4">
                                    <template x-if="selected?.file_path?.endsWith('.pdf')">
                                        <iframe :src="'/storage/' + selected?.file_path" class="w-full h-[500px] rounded-xl border border-gray-200"></iframe>
                                    </template>
                                    <template x-if="selected?.file_path && !selected?.file_path?.endsWith('.pdf')">
                                        <div class="h-[200px] flex flex-col items-center justify-center bg-gray-50 rounded-xl border border-dashed border-gray-300">
                                            <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-500 mb-3">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                            </div>
                                            <p class="text-sm font-medium text-gray-600">Preview tidak tersedia untuk file ini</p>
                                            <p class="text-xs text-gray-400 mt-1">Silakan download file untuk melihat konten</p>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Metadata Sidebar -->
                    <div class="col-span-4 space-y-4">
                        <!-- Meta Card -->
                        <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100 space-y-4">
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Informasi</p>
                            
                            <div class="space-y-3">
                                <div class="flex items-start gap-3">
                                    <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center text-gray-400 shadow-sm shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Pengunggah</p>
                                        <p class="text-sm font-semibold text-gray-800" x-text="selected?.user_id || 'Anonim'"></p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                    <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center text-gray-400 shadow-sm shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Mata Kuliah</p>
                                        <p class="text-sm font-semibold text-gray-800" x-text="selected?.mata_kuliah_id || '-'"></p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                    <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center text-gray-400 shadow-sm shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Dosen</p>
                                        <p class="text-sm font-semibold text-gray-800" x-text="selected?.dosen_id || '-'"></p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                    <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center text-gray-400 shadow-sm shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Tanggal Upload</p>
                                        <p class="text-sm font-semibold text-gray-800" x-text="selected?.created_at"></p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                    <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center text-gray-400 shadow-sm shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Tahun</p>
                                        <p class="text-sm font-semibold text-gray-800" x-text="selected?.tahun || '-'"></p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                    <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center text-gray-400 shadow-sm shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Rating</p>
                                        <div class="flex items-center gap-1">
                                            <p class="text-sm font-bold text-amber-500" x-text="selected?.rating || '0.0'"></p>
                                            <span class="text-xs text-gray-400">/ 5.0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions Sidebar -->
                        <div class="bg-indigo-50 rounded-2xl p-5 border border-indigo-100">
                            <p class="text-xs font-bold text-indigo-400 uppercase tracking-wider mb-3">Aksi Cepat</p>
                            <div class="space-y-2">
                               
                                <button 
                                    @click="enableEdit()"
                                    class="w-full py-3 bg-white border border-indigo-200 text-indigo-600 hover:bg-indigo-100 rounded-xl font-bold text-sm transition-all flex items-center justify-center gap-2"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit Data
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- EDIT MODE -->
            <form x-show="isEdit"
                  x-transition:enter="transition ease-out duration-200"
                  x-transition:enter-start="opacity-0"
                  x-transition:enter-end="opacity-100"
                  method="POST"
                  :action="'/admin/materi/' + selected?.id + '/update'"
                  class="space-y-6">

                @csrf
                @method('PUT')

                <div class="bg-indigo-50 rounded-2xl p-4 border border-indigo-100 mb-6">
                    <p class="text-sm font-semibold text-indigo-800 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Mode Edit Aktif
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-5">
                    <div class="col-span-2">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Judul Materi</label>
                        <input type="text" name="judul_materi" x-model="selected.judul_materi"
                            class="w-full border border-gray-200 p-3 rounded-xl focus:ring-2 focus:ring-[#6155F5] focus:border-transparent outline-none transition-all text-sm">
                    </div>

                    <!-- <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Mata Kuliah ID</label>
                        <input type="text" name="mata_kuliah_id" x-model="selected.mata_kuliah_id"
                            class="w-full border border-gray-200 p-3 rounded-xl focus:ring-2 focus:ring-[#6155F5] focus:border-transparent outline-none transition-all text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Dosen ID</label>
                        <input type="text" name="dosen_id" x-model="selected.dosen_id"
                            class="w-full border border-gray-200 p-3 rounded-xl focus:ring-2 focus:ring-[#6155F5] focus:border-transparent outline-none transition-all text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Tahun</label>
                        <input type="text" name="tahun" x-model="selected.tahun"
                            class="w-full border border-gray-200 p-3 rounded-xl focus:ring-2 focus:ring-[#6155F5] focus:border-transparent outline-none transition-all text-sm">
                    </div> -->

                    <div class="col-span-2">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Status</label>
                        <select name="status" x-model="selected.status"
                            class="w-full border border-gray-200 p-3 rounded-xl focus:ring-2 focus:ring-[#6155F5] focus:border-transparent outline-none transition-all text-sm bg-white">
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Deskripsi</label>
                        <textarea name="deskripsi" x-model="selected.deskripsi" rows="4"
                            class="w-full border border-gray-200 p-3 rounded-xl focus:ring-2 focus:ring-[#6155F5] focus:border-transparent outline-none transition-all text-sm resize-none"></textarea>
                    </div>
                </div>

                <div class="flex gap-3 justify-end pt-4 border-t border-gray-100">
                    <button type="button" @click="isEdit = false"
                        class="px-6 py-2.5 bg-gray-100 text-gray-600 rounded-xl font-semibold text-sm hover:bg-gray-200 transition-all">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-6 py-2.5 bg-[#6155F5] text-white rounded-xl font-semibold text-sm hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>

        </div>

        <!-- Footer Actions (View Mode Only) -->
        <div x-show="!isEdit" class="px-8 py-5 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">
            <button @click="closeModal()"
                class="px-6 py-2.5 bg-white border border-gray-200 text-gray-600 rounded-xl font-semibold text-sm hover:bg-gray-50 transition-all">
                Tutup
            </button>
            <button @click="enableEdit()"
                class="px-6 py-2.5 bg-[#6155F5] text-white rounded-xl font-semibold text-sm hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Data
            </button>
        </div>
    </div>
</div>

 <div
        x-show="showDeleteModal"
        x-cloak
        class="fixed inset-0 z-[999] flex items-center justify-center bg-black/40 backdrop-blur-sm px-4"
    >
        <div
            class="bg-white w-full max-w-sm rounded-2xl shadow-xl p-6 text-center relative"
            @click.away="closeDelete()"
        >

            <!-- Close -->
            <button
                @click="closeDelete()"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 text-xl"
            >
                ✕
            </button>

            <!-- Icon -->
            <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-5">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </div>

            <!-- Title -->
            <h3 class="text-lg font-bold text-gray-800 mb-2">
                Hapus Konten
            </h3>

            <!-- Desc -->
            <p class="text-sm text-gray-500 mb-6">
                Apakah Anda yakin ingin menghapus konten ini? Tindakan ini tidak dapat dibatalkan.
            </p>

            <!-- Button -->
            <div class="flex gap-3">
                <button
                    @click="closeDelete()"
                    class="flex-1 py-3 bg-gray-100 text-gray-600 rounded-xl font-semibold hover:bg-gray-200 transition"
                >
                    Batal
                </button>

                <form :action="deleteUrl" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="w-full py-3 bg-red-600 text-white rounded-xl font-semibold hover:bg-red-700 shadow-md transition"
                    >
                        Ya, Hapus
                    </button>
                </form>
            </div>

        </div>
    </div>


        </main>
    </div>
</x-layout.app_admin>