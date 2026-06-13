<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ 'Sinau Bareng - Platform Belajar & Bank Soal AI' }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans antialiased overflow-x-hidden selection:bg-[#6155F5] selection:text-white">

    {{-- NAVBAR UTAMA (Sudah Membawa Fitur Smooth Scroll) --}}
    <x-layout.navbar />

    {{-- 1. HERO SECTION --}}
    <main id="hero" class="relative pt-36 pb-20 lg:pt-48 lg:pb-32">
        {{-- Background blobs dekoratif --}}
        <div class="absolute top-0 right-0 -z-10 w-[600px] h-[600px] bg-indigo-200/40 rounded-full blur-3xl opacity-70 pointer-events-none"></div>
        <div class="absolute top-40 left-[-100px] -z-10 w-[400px] h-[400px] bg-purple-200/30 rounded-full blur-3xl opacity-60 pointer-events-none"></div>

        <section class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
            <div class="flex flex-col lg:flex-row items-center gap-16 lg:gap-24">
                {{-- Kiri: Teks & CTA --}}
                <div class="flex-1 text-center lg:text-left order-2 lg:order-1">
                    <div class="inline-flex items-center gap-2 bg-indigo-50 border border-indigo-100 text-[#6155F5] px-4 py-1.5 rounded-full text-xs font-bold mb-6 animate-pulse">
                        ✨ Cerdas Belajar Bersama AI
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 leading-[1.15] tracking-tight">
                        Bank Soal <span class="text-[#6155F5] bg-gradient-to-r from-[#6155F5] to-indigo-600 bg-clip-text text-transparent">Terlengkap</span>
                        <br>Untuk Hasil Ujian Maksimal
                    </h1>
                    
                    <p class="mt-6 text-base sm:text-lg text-slate-600 leading-relaxed max-w-2xl lg:mx-0 mx-auto font-medium">
                        Sinau Bareng adalah platform kolaboratif pintar untuk berbagi materi belajar dan bank soal yang tervalidasi. Siapkan dirimu menghadapi ujian dengan ringkasan materi kustom dan sistem <span class="text-slate-900 font-bold">Generate Soal Otomatis berbasis AI</span>.
                    </p>
                    
                    <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="/register" class="bg-[#6155F5] text-white px-8 py-4 rounded-2xl hover:bg-[#4f44d8] hover:shadow-indigo-500/30 transition-all duration-300 font-bold text-lg shadow-xl shadow-[#6155F5]/20 text-center transform active:scale-95">
                            Mulai Belajar Sekarang
                        </a>
                        <a href="#fitur" class="bg-white border-2 border-slate-200 text-slate-700 px-8 py-4 rounded-2xl hover:border-[#6155F5] hover:text-[#6155F5] transition-all duration-300 font-bold text-lg text-center shadow-sm transform active:scale-95 flex items-center justify-center gap-2">
                            <span>Pelajari Fitur</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7m14-6l-7 7-7-7"/></svg>
                        </a>
                    </div>
                </div>

                {{-- Kanan: Gambar Ilustrasi --}}
                <div class="flex-1 order-1 lg:order-2 w-full flex justify-center">
                    <div class="relative group">
                        <div class="absolute inset-0 bg-gradient-to-tr from-[#6155F5]/20 to-purple-500/10 rounded-full blur-2xl group-hover:scale-105 transition-transform duration-500"></div>
                        <img src="{{ asset('images/hero1.png') }}" alt="Hero Illustration" class="w-[85%] sm:w-[70%] max-w-md mx-auto relative drop-shadow-2xl hover:translate-y-[-8px] transition-transform duration-500">
                    </div>
                </div>
            </div>
        </section>

        {{-- 2. SECTION FITUR UTAMA --}}
        <section id="fitur" class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 pt-28 lg:pt-40">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-xs font-bold uppercase tracking-widest text-[#6155F5] mb-3">Mengapa Sinau Bareng?</h2>
                <p class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">Solusi Ekosistem Belajar Digital yang Fleksibel & Terintegrasi</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-3xl shadow-md border border-slate-100 hover:border-[#6155F5]/30 hover:shadow-xl hover:translate-y-[-5px] transition-all duration-300 flex flex-col text-left">
                    <div class="w-12 h-12 bg-indigo-50 text-[#6155F5] rounded-2xl flex items-center justify-center text-xl font-bold mb-6 shadow-sm">📚</div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Materi Kustom Tanpa Batas</h3>
                    <p class="text-sm font-semibold text-slate-500 leading-relaxed flex-1">
                        Unggah materi pelajaran apa pun secara bebas tanpa terikat master data kaku. Platform global yang mendukung segala ruang lingkup studi.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-md border border-slate-100 hover:border-[#6155F5]/30 hover:shadow-xl hover:translate-y-[-5px] transition-all duration-300 flex flex-col text-left">
                    <div class="w-12 h-12 bg-indigo-50 text-[#6155F5] rounded-2xl flex items-center justify-center text-xl font-bold mb-6 shadow-sm">🛡️</div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Validasi & Rating Komunitas</h3>
                    <p class="text-sm font-semibold text-slate-500 leading-relaxed flex-1">
                        Materi kuliah diverifikasi oleh dosen pengampu dan dilengkapi sistem ulasan rating kumulatif rata-rata dari rekan mahasiswa untuk menjaga akurasi data.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-md border border-slate-100 hover:border-[#6155F5]/30 hover:shadow-xl hover:translate-y-[-5px] transition-all duration-300 flex flex-col text-left">
                    <div class="w-12 h-12 bg-indigo-50 text-[#6155F5] rounded-2xl flex items-center justify-center text-xl font-bold mb-6 shadow-sm">🤖</div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Kuis Latihan Berbasis AI</h3>
                    <p class="text-sm font-semibold text-slate-500 leading-relaxed flex-1">
                        Uji pemahaman belajarmu secara kilat! Konversikan dokumen rangkuman pelajaran menjadi kuis soal interaktif otomatis menggunakan kecerdasan buatan.
                    </p>
                </div>
            </div>
        </section>

        {{-- 3. SECTION CARA KERJA (HOW IT WORKS) --}}
        <section id="alur" class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 pt-28 lg:pt-40">
            <div class="bg-gradient-to-br from-[#6155F5] to-indigo-800 rounded-[40px] text-white p-12 lg:p-20 shadow-xl relative overflow-hidden">
                <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
                
                <div class="text-center max-w-2xl mx-auto mb-16 relative z-10">
                    <h2 class="text-xs font-bold uppercase tracking-widest text-indigo-200 mb-3">Sederhana & Efisien</h2>
                    <p class="text-3xl font-extrabold tracking-tight">3 Langkah Mudah Mulai Sinau</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative z-10">
                    <div class="text-center space-y-4">
                        <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center text-lg font-black mx-auto">1</div>
                        <h4 class="text-xl font-bold">Unggah Materi</h4>
                        <p class="text-sm text-indigo-100 font-medium leading-relaxed">Ketik nama pelajaran secara custom dan upload file rangkuman PDF/Docx milikmu.</p>
                    </div>
                    <div class="text-center space-y-4">
                        <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center text-lg font-black mx-auto">2</div>
                        <h4 class="text-xl font-bold">Validasi Dosen</h4>
                        <p class="text-sm text-indigo-100 font-medium leading-relaxed">Tim dosen pengampu memverifikasi kualitas dokumen untuk memastikan keaslian bank soal.</p>
                    </div>
                    <div class="text-center space-y-4">
                        <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center text-lg font-black mx-auto">3</div>
                        <h4 class="text-xl font-bold">Belajar Bareng AI</h4>
                        <p class="text-sm text-indigo-100 font-medium leading-relaxed">Gunakan generator AI untuk membuat simulasi kuis interaktif kapan saja secara bebas.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- 4. SECTION STATISTIK KEUNGGULAN (STATS SECTION) --}}
        <section id="statistik" class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 pt-28 lg:pt-40 pb-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="space-y-6 text-left">
                    <h2 class="text-xs font-bold uppercase tracking-widest text-[#6155F5]">Performa & Skalabilitas</h2>
                    <p class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">Mendukung Pembelajaran Kolaboratif Skala Besar</p>
                    <p class="text-base text-slate-500 font-medium leading-relaxed">
                        Kami percaya bahwa belajar bersama jauh lebih menyenangkan dan efektif. Melalui pengumpulan data yang terdesentralisasi, Sinau Bareng siap menjadi wadah pertukaran ilmu yang kredibel di lingkungan kampus.
                    </p>
                </div>
                
                <div class="grid grid-cols-2 gap-6">
                    <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm text-center">
                        <p class="text-4xl font-black text-[#6155F5]">100%</p>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mt-2">Custom Input</p>
                    </div>
                    <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm text-center">
                        <p class="text-4xl font-black text-[#6155F5]">Instant</p>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mt-2">AI Generation</p>
                    </div>
                    <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm text-center">
                        <p class="text-4xl font-black text-[#6155F5]">Verified</p>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mt-2">Oleh Dosen</p>
                    </div>
                    <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm text-center">
                        <p class="text-4xl font-black text-[#6155F5]">∞ Unlimited</p>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mt-2">Akses Pelajaran</p>
                    </div>
                </div>
            </div>
        </section>
        <section id="tentang" class="py-20 bg-gray-50 dark:bg-gray-800">
    <div class="container mx-auto px-6 md:px-12">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-white mb-4">
                Tentang Sinau Bareng
            </h2>
            <div class="w-16 h-1 bg-blue-600 mx-auto rounded"></div>
        </div>

        <div class="flex flex-col md:flex-row items-center gap-10">
            <div class="md:w-1/2">
                <img src="{{ asset('images/LogoTentang.png') }}" alt="Ilustrasi Sinau Bareng" class="w-full max-w-md mx-auto rounded-xl shadow-lg transform hover:-translate-y-2 transition duration-300">
            </div>

            <div class="md:w-1/2 text-gray-600 dark:text-gray-300 space-y-5">
                <p class="text-lg leading-relaxed">
                    <strong>Sinau Bareng</strong> adalah platform manajemen pembelajaran interaktif yang dirancang untuk menjembatani mahasiswa dan dosen dalam satu ekosistem belajar yang efisien.
                </p>
                <p class="text-lg leading-relaxed">
                    Kami menyediakan kemudahan dalam membagikan, mengakses, dan memvalidasi materi perkuliahan. Dilengkapi dengan sistem rating untuk memastikan kualitas materi yang dibagikan selalu relevan dan mudah dipahami.
                </p>
                <div class="pt-4">
                    <a href="#fitur" class="inline-block px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-full shadow-md transition duration-300 ease-in-out">
                        Jelajahi Fitur Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
    </main>

    <x-layout.footer />

</body>
</html>