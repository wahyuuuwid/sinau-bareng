<x-layout.app title="Materi - Sinau Bareng" class="bg-[#E5E5E5]">
    <div class="flex min-h-screen">
        
        <x-layout.sidebar_user />

        <main class="flex-1 p-15">
            
            <h1 class="text-4xl font-bold text-black mb-10">Materi</h1>

            <div class="flex flex-col gap-8 max-w-6xl">
                
                <a href="/materi/saya" class="group bg-[#6366f1] p-16 rounded-[30px] shadow-lg flex items-center justify-center gap-6 hover:bg-[#4f46e5] transition-all duration-300 transform hover:-translate-y-1">
                    <svg class="h-16 w-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <span class="text-4xl font-bold text-white tracking-wide">Materi Saya</span>
                </a>

                <a href="/materi/unggah" class="group bg-white p-16 rounded-[30px] shadow-lg flex items-center justify-center gap-6 border border-gray-100 hover:bg-gray-50 transition-all duration-300 transform hover:-translate-y-1">
                    <svg class="h-16 w-16 text-[#6366f1]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                    </svg>
                    <span class="text-4xl font-bold text-[#6366f1] tracking-wide">Unggah Materi</span>
                </a>

                <a href="/materi/cari" class="group bg-[#7275f3] p-16 rounded-[30px] shadow-lg flex items-center justify-center gap-6 hover:bg-[#6366f1] transition-all duration-300 transform hover:-translate-y-1">
                    <svg class="h-16 w-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <span class="text-4xl font-bold text-white tracking-wide">Cari & Unduh Materi</span>
                </a>

            </div>

        </main>
    </div>
</x-layout.app>