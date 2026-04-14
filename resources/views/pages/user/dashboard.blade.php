<x-layout.app title="Dashboard Mahasiswa" class="bg-[#E5E5E5]">
    <div class="flex">
        <x-layout.sidebar_user />

        <main class="flex-1 p-12">
            <div class="flex justify-between items-start mb-10">
                <div>
                    <h1 class="text-2xl font-medium text-gray-800">Dashboard</h1>
                    <h2 class="text-3xl font-bold text-black mt-2">Selamat Datang, {{ Auth::user()->username }}! 👋</h2>
                </div>
                <button class="p-2 text-black"><svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg></button>
            </div>

            <div class="bg-white p-8 rounded-[30px] shadow-sm mb-10 border border-gray-100 text-left">
                <h3 class="text-2xl font-bold mb-4 text-center">Materi Populer Minggu Ini</h3>
                <ul class="inline-block text-left space-y-2">
                    @forelse($materiTerbaru as $materi)
                        <li class="flex items-center gap-3 text-indigo-600 font-medium">
                            <span class="w-2 h-2 bg-indigo-600 rounded-full"></span> {{ Str::limit($materi->judul_materi, 20) }}
                        </li>
                    @empty
                        <li class="text-gray-400 italic text-sm">Belum ada materi diunggah</li>
                    @endforelse
                </ul>
            </div>

            <div class="grid grid-cols-2 gap-10">
                <div class="bg-white p-10 rounded-[40px] shadow-sm text-center">
                    <p class="text-2xl font-bold text-black mb-2">Total Materi</p>
                    <p class="text-4xl font-bold text-indigo-500">{{ $totalMateri }}</p>
                </div>

                <div class="bg-white p-10 rounded-[40px] shadow-sm text-center">
                    <p class="text-2xl font-bold text-black mb-2">Total Soal</p>
                    <p class="text-4xl font-bold text-green-500">Belum di coding</p>
                </div>

                <div class="bg-white p-10 rounded-[40px] shadow-sm text-center">
                    <p class="text-2xl font-bold text-black mb-2">Penilaian</p>
                    <p class="text-4xl font-bold text-yellow-500">Belum di coding</p>
                </div>

                <div class="bg-white p-10 rounded-[40px] shadow-sm text-center">
                    <p class="text-2xl font-bold text-black mb-2">Laporan Saya</p>
                    <p class="text-4xl font-bold text-red-500">Belum di coding</p>
                </div>
            </div>
        </main>
    </div>
</x-layout.app>