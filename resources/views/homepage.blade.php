<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ 'Sinau Bareng' }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
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
                        <a href="#tryout" class="border-2 border-gray-300 text-gray-700 px-8 py-4 rounded-xl hover:border-primary-200 hover:text-primary-200 transition font-semibold text-lg text-center">
                            Generate Soal AI
                        </a>
                    </div>
                </div>
                <div class="flex-1">
                    <img src="{{ asset('images/hero1.png') }}" alt="Hero Illustration" class="w-[70%] max-w-lg mx-auto">
                </div>
            </div>
        </section>
    </main>

    <x-layout.footer />

</body>
</html>