<x-layout.app_user title="Dashboard Mahasiswa" class="bg-[#E5E5E5]">
    <main>
        
        {{-- NAVBAR DENGAN SAPAAN SEJAJAR LONCENG --}}
        <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        </style>

        <main>
            
            {{-- NAVBAR DENGAN SAPAAN SEJAJAR LONCENG --}}
            <x-layout.navbar_user>
                {{-- 2. GUNAKAN STYLE INLINE UNTUK MEMAKSA FONT POPPINS --}}
                <h1 class="text-[30px] leading-[30px] font-semibold text-[#000000]" style="font-family: 'Poppins', sans-serif;">
                    Selamat datang, {{ Auth::user()->username }} 👋
                </h1>
            </x-layout.navbar_user>

        {{-- Section: Materi Populer (Prioritas Rating & Views) --}}
        <div class="bg-white p-10 rounded-[30px] shadow-sm mb-10 border border-gray-100">
            <h3 class="text-2xl font-bold mb-6 text-center text-gray-800">Materi Populer Minggu Ini</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @forelse($materiPopuler as $materi)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl hover:bg-indigo-50 transition-colors border border-gray-100">
                        <div class="flex items-center gap-3">
                            <span class="w-3 h-3 bg-indigo-600 rounded-full"></span>
                            <span class="font-bold text-gray-700">{{ Str::limit($materi->judul_materi, 30) }}</span>
                        </div>
                        
                        {{-- Menampilkan Badge Rating Rata-rata --}}
                        <div class="flex items-center gap-1 bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-black">
                            {{ number_format($materi->ratings_avg_nilai ?? 0, 1) }}
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 text-center py-4 text-gray-400 italic text-sm">
                        Belum ada materi populer minggu ini.
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Statistik Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            {{-- Card: Total Materi --}}
            <div class="bg-white p-10 rounded-[40px] shadow-sm text-center border border-gray-50 flex flex-col items-center justify-center">
                <p class="text-2xl font-bold text-gray-600 mb-2">Total Materi</p>
                <p class="text-6xl font-black text-indigo-600">{{ $totalMateri }}</p>
                <p class="text-sm text-gray-400 mt-2 font-medium">Materi yang kamu unggah</p>
            </div>

            {{-- Card: Penilaian (Average Rating User) --}}
            <div class="bg-white p-10 rounded-[40px] shadow-sm text-center border border-gray-50 flex flex-col items-center justify-center">
                <p class="text-2xl font-bold text-gray-600 mb-2">Penilaian</p>
                <div class="flex items-center gap-3">
                    <p class="text-6xl font-black text-yellow-500">
                        {{ $averageRating > 0 ? number_format($averageRating, 1) : '0' }}
                    </p>
                    <svg class="w-12 h-12 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </div>
                <p class="text-sm text-gray-400 mt-2 font-medium">Rata-rata dari semua materi kamu</p>
            </div>
        </div>
    </main>
</x-layout.app_user>