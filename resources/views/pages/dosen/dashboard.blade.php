<x-layout.app title="Dashboard Dosen" class="bg-[#F4F4F4]">
    <div class="flex">
        <x-layout.sidebar_dosen />

        <main class="flex-1 p-8">
            <x-layout.navbar_dosen />

            <h2 class="text-xl font-medium text-gray-800 mb-6 font-semibold">Selamat datang, Pak/Bu Dosen 👋</h2>

            <div class="grid grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-8 rounded-2xl flex justify-between items-center shadow-sm">
                    <div><p class="text-gray-700 font-semibold mb-1">Materi Menunggu Validasi</p><p class="text-3xl font-bold">8</p></div>
                    <div class="text-indigo-500"><svg class="h-10 w-10" fill="currentColor" viewBox="0 0 20 20"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/></svg></div>
                </div>
                <div class="bg-white p-8 rounded-2xl flex justify-between items-center shadow-sm">
                    <div><p class="text-gray-700 font-semibold mb-1">Soal AI Menunggu Validasi</p><p class="text-3xl font-bold">6</p></div>
                    <div class="text-indigo-600"><svg class="h-10 w-10" fill="currentColor" viewBox="0 0 20 20"><path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/></svg></div>
                </div>
                <div class="bg-white p-8 rounded-2xl flex justify-between items-center shadow-sm">
                    <div><p class="text-gray-700 font-semibold mb-1">Sudah Disetujui</p><p class="text-3xl font-bold">15</p></div>
                    <div class="text-blue-600"><svg class="h-10 w-10" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/></svg></div>
                </div>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm">
                <h3 class="font-bold text-gray-800 mb-6">Daftar validasi terbaru</h3>
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-indigo-600 text-white">
                            <th class="p-4 rounded-tl-xl text-center">No</th>
                            <th class="p-4">Judul Konten</th>
                            <th class="p-4">Jenis</th>
                            <th class="p-4">Uploader</th>
                            <th class="p-4">Mata Kuliah</th>
                            <th class="p-4">Status</th>
                            <th class="p-4 rounded-tr-xl">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @foreach(range(1, 5) as $no)
                        <tr class="{{ $no % 2 == 0 ? 'bg-gray-50' : '' }} border-b">
                            <td class="p-4 text-center">{{ $no }}</td>
                            <td class="p-4 font-medium">PBO - Inheritance.pdf</td>
                            <td class="p-4 text-gray-600">Materi</td>
                            <td class="p-4 text-gray-600">adalah pokoknya</td>
                            <td class="p-4 text-gray-600 font-bold uppercase">PBO</td>
                            <td class="p-4"><span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">Pending</span></td>
                            <td class="p-4 text-center"><button class="text-gray-500 hover:text-indigo-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg></button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</x-layout.app>