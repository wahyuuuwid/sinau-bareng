<x-layout.app title="Admin Dashboard" class="bg-[#F4F4F4]">
    <div class="flex">
        <x-layout.sidebar_admin />

        <main class="flex-1 p-8">

        
            <x-layout.navbar_admin />

            <h2 class="text-xl font-bold text-gray-800 mb-6">Dashboard</h2>

            <div class="grid grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-8 rounded-2xl flex justify-between items-center shadow-sm">
                    <div>
                        <p class="text-gray-500 font-medium mb-1">Total Pengguna</p>
                        <p class="text-3xl font-bold">245</p>
                    </div>
                    <div class="bg-indigo-100 p-3 rounded-xl text-indigo-600">
                        <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/></svg>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl flex justify-between items-center shadow-sm">
                    <div>
                        <p class="text-gray-500 font-medium mb-1">Total Materi</p>
                        <p class="text-3xl font-bold">10</p>
                    </div>
                    <div class="bg-indigo-600 p-3 rounded-xl text-white">
                        <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 20 20"><path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/></svg>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl flex justify-between items-center shadow-sm">
                    <div>
                        <p class="text-gray-500 font-medium mb-1">Laporan Konten</p>
                        <p class="text-3xl font-bold">23</p>
                    </div>
                    <div class="bg-blue-600 p-3 rounded-xl text-white">
                        <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 20 20"><path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/></svg>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-4 bg-white p-6 rounded-2xl shadow-sm">
                    <h3 class="font-bold mb-6">Aktivitas Terbaru</h3>
                    <div class="space-y-6 relative before:absolute before:left-[11px] before:top-2 before:bottom-2 before:w-[2px] before:bg-gray-100">
                        @foreach(range(1, 5) as $i)
                        <div class="flex gap-4 relative">
                            <div class="w-6 h-6 rounded-full bg-white border-4 border-indigo-600 z-10"></div>
                            <div>
                                <p class="text-sm font-bold text-gray-800">Konten "Aljabar" dilaporkan</p>
                                <p class="text-xs text-gray-400">5 menit lalu</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-span-8 grid grid-cols-2 gap-6">
                    <div class="bg-white p-6 rounded-2xl shadow-sm text-center">
                        <h3 class="font-bold mb-4 text-left">Distribusi Jenis Konten</h3>
                        <div class="h-48 flex items-center justify-center bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
                            [ Grafik Pie Chart ]
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm text-center">
                        <h3 class="font-bold mb-4 text-left">Status Laporan Konten</h3>
                        <div class="h-48 flex items-center justify-center bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
                            [ Grafik Donut Chart ]
                        </div>
                    </div>
                    <div class="col-span-2 bg-white p-6 rounded-2xl shadow-sm">
                        <h3 class="font-bold mb-4">Jumlah Upload Konten per Bulan</h3>
                        <div class="h-64 flex items-center justify-center bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
                            [ Grafik Line Chart ]
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-layout.app>