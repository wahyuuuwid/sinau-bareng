<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ 'Sinau Bareng' }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
    html {
        scroll-behavior: smooth;
    }
</style>
<body class="bg-gray-50 font-sans antialiased">

    <x-layout.navbar />

    <main class="pt-32 pb-16">
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
            <div class="flex flex-col lg:flex-row items-center gap-24">
                <div class="flex-1 text-center lg:text-left">
                    <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight">
                        Bank Soal <span class="text-primary-200">Terlengkap</span>
                        <br>Untuk Ujianmu
                    </h1>
                    <p class="mt-6 text-lg text-gray-600 max-w-2xl lg:mx-0 mx-auto">
                        Sinau Bareng adalah platform berbagi materi kuliah dan bank soal yang divalidasi oleh dosen. Mahasiswa dapat belajar, berbagi, dan membuat soal latihan otomatis menggunakan AI.
                    </p>
                    <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="/register" class="bg-primary-200 text-white px-8 py-4 rounded-xl hover:bg-primary-300 transition font-semibold text-lg shadow-lg shadow-primary-200/50 text-center">
                            Mulai Belajar
                        </a>
                        <a href="/login" class="border-2 border-gray-300 text-gray-700 px-8 py-4 rounded-xl hover:border-primary-200 hover:text-primary-200 transition font-semibold text-lg text-center">
                            Generate Soal AI
                        </a>
                    </div>
                </div>
                <div class="flex-1">
                    <img src="{{ asset('images/hero1.png') }}" alt="Hero Illustration" class="w-[70%] max-w-lg mx-auto">
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