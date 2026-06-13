@props(['title' => 'Sinau Bareng'])

<x-layout.app :title="$title">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
    </style>

    {{-- Pembungkus layar penuh, mencegah scroll ganda --}}
    <div class="flex h-screen bg-[#ECECEC] overflow-hidden">
        
        {{-- SIDEBAR: Tetap di kiri --}}
        <x-layout.sidebar_user /> 

        {{-- KONTEN SEBELAH KANAN (Navbar + Main Content) --}}
        {{-- min-w-0 sangat penting agar konten panjang tidak merusak layout --}}
        <div class="flex-1 flex flex-col min-w-0 relative">
            
            {{-- NAVBAR: Ditumpuk di paling atas --}}
            <div class="z-20 w-full relative">
                <x-layout.navbar_user /> 
            </div>

            {{-- AREA KONTEN UTAMA: Bebas di-scroll --}}
            <main class="flex-1 overflow-y-auto min-h-0 bg-[#ECECEC] pt-[24px]">
                
                {{-- Pembatas lebar agar rapi dan tidak melenceng --}}
                <div class="px-8 w-full max-w-7xl mx-auto pb-[40px]">
                    {{ $slot }}
                </div>
                
            </main>

        </div>
    </div>
</x-layout.app>