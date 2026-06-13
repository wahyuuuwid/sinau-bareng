<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; overflow: hidden; }
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #CCCCCC; border-radius: 10px; }
    </style>
</head>
<body class="bg-[#ECECEC]">
    <div class="flex h-screen w-full overflow-hidden">
        
        {{-- DNA SIDEBAR ASLI --}}
        <x-layout.sidebar_admin />

        {{-- AREA KANAN --}}
        <div class="flex-1 flex flex-col min-w-0">
            
            {{-- DNA NAVBAR ASLI --}}
            <div class="p-[24px] pb-0 shrink-0">
                <x-layout.navbar_admin />
            </div>

            {{-- KONTEN UTAMA --}}
            <main class="flex-1 overflow-y-auto custom-scrollbar p-[24px]">
                {{ $slot }}
            </main>

        </div>
    </div>
</body>
</html>