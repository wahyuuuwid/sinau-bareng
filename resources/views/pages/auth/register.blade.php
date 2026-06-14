<x-layout.app title="Daftar Akun - Sinau Bareng">

    @push('styles')
    <style>
        .input-register {
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .input-register:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79,70,229,0.10);
        }
        .btn-daftar {
            transition: background 0.2s, transform 0.15s, box-shadow 0.15s;
        }
        .btn-daftar:hover {
            background: #4338ca;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(79,70,229,0.25);
        }
        .btn-daftar:active {
            transform: translateY(0);
        }
        @media (prefers-reduced-motion: reduce) {
            .btn-daftar { transition: none; }
        }
    </style>
    @endpush

    <div class="min-h-screen bg-gray-50 flex items-center justify-center p-6">

        <div class="w-full max-w-4xl bg-white rounded-3xl shadow-md border border-gray-200 overflow-hidden flex min-h-[600px]">

            {{-- ===== PANEL KIRI: Branding ===== --}}
            <div class="hidden md:flex w-[44%] bg-indigo-600 flex-col justify-between p-12 relative overflow-hidden">

                {{-- Ornamen titik-titik --}}
                <div class="absolute top-0 right-0 w-48 h-48 opacity-10"
                     style="background-image: radial-gradient(circle, white 1.5px, transparent 1.5px); background-size: 16px 16px;"></div>
                <div class="absolute bottom-0 left-0 w-40 h-40 opacity-10"
                     style="background-image: radial-gradient(circle, white 1.5px, transparent 1.5px); background-size: 16px 16px;"></div>

                {{-- Brand --}}
                <div class="relative z-10">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 bg-white/15 rounded-xl flex items-center justify-center">
                            <img src="{{ asset('logo.png') }}" alt="Sinau Bareng Logo" class="w-6 h-6">
                        </div>
                        <span class="text-white font-bold text-base tracking-tight">Sinau Bareng</span>
                    </div>
                </div>

                {{-- Tagline --}}
                <div class="relative z-10">
                    <p class="text-indigo-300 text-xs font-semibold uppercase tracking-widest mb-4">Mulai perjalananmu</p>
                    <h2 class="text-white text-3xl font-bold leading-snug">
                        Gabung dan mulai<br>belajar bersama<br>ribuan mahasiswa.
                    </h2>
                    <p class="text-indigo-200 text-sm mt-4 leading-relaxed max-w-xs">
                        Daftar gratis dan akses ratusan materi kuliah yang dikurasi oleh mahasiswa terbaik.
                    </p>
                </div>

                {{-- Steps ringkas --}}
                <div class="relative z-10 space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 bg-white/15 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white text-[10px] font-bold">1</span>
                        </div>
                        <p class="text-indigo-200 text-xs">Buat akun dengan email kamu</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 bg-white/15 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white text-[10px] font-bold">2</span>
                        </div>
                        <p class="text-indigo-200 text-xs">Jelajahi & unggah materi kuliah</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 bg-white/15 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white text-[10px] font-bold">3</span>
                        </div>
                        <p class="text-indigo-200 text-xs">Beri rating & bantu teman belajar</p>
                    </div>
                </div>
            </div>

            {{-- ===== PANEL KANAN: Form ===== --}}
            <div class="flex-1 flex flex-col justify-center px-10 py-12 lg:px-16">

                {{-- Mobile brand --}}
                <div class="flex items-center gap-2 mb-8 md:hidden">
                    <div class="w-7 h-7 bg-indigo-600 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                        </svg>
                    </div>
                    <span class="text-indigo-700 font-bold text-sm">Sinau Bareng</span>
                </div>

                {{-- Heading --}}
                <div class="mb-7">
                    <h1 class="text-2xl font-bold text-gray-900">Buat akun baru</h1>
                    <p class="text-gray-400 text-sm mt-1">Gratis, cepat, dan mudah.</p>
                </div>

                {{-- Error validasi --}}
                @if($errors->any())
                    <div class="mb-5 bg-red-50 border border-red-100 text-red-600 rounded-2xl px-4 py-3 text-xs font-semibold">
                        <p class="font-bold text-sm mb-1">Ada kesalahan:</p>
                        <ul class="list-disc list-inside space-y-0.5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Error session --}}
                @if(session('error'))
                    <div class="mb-5 flex items-center gap-3 bg-red-50 border border-red-100 text-red-600 rounded-2xl px-4 py-3 text-sm font-medium">
                        <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Form --}}
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    {{-- Nama Lengkap --}}
                    <div>
                        <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                        <input
                            type="text"
                            id="username"
                            name="username"
                            value="{{ old('username') }}"
                            placeholder="Nama lengkap kamu"
                            required
                            autocomplete="name"
                            class="input-register w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-300 @error('username') border-red-300 bg-red-50 @enderror"
                        >
                        @error('username')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="nama@email.com"
                            required
                            autocomplete="email"
                            class="input-register w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-300 @error('email') border-red-300 bg-red-50 @enderror"
                        >
                        @error('email')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password & Konfirmasi (2 kolom) --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        {{-- Buat Kata Sandi --}}
                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Buat Kata Sandi</label>
                            <div class="relative">
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    placeholder="Min. 6 karakter"
                                    required
                                    autocomplete="new-password"
                                    class="input-register w-full px-4 py-3 pr-11 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-300 @error('password') border-red-300 bg-red-50 @enderror"
                                >
                                <button type="button" id="togglePassword"
                                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-300 hover:text-indigo-500 transition-colors">
                                    <svg id="eye-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Konfirmasi Kata Sandi --}}
                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Kata Sandi</label>
                            <div class="relative">
                                <input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    placeholder="Ulangi kata sandi"
                                    required
                                    autocomplete="new-password"
                                    class="input-register w-full px-4 py-3 pr-11 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-300"
                                >
                                <button type="button" id="toggleConfirm"
                                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-300 hover:text-indigo-500 transition-colors">
                                    <svg id="eye-icon-confirm" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="btn-daftar w-full py-3 mt-1 bg-indigo-600 text-white text-sm font-semibold rounded-xl">
                        Buat Akun
                    </button>
                </form>

                {{-- Link login --}}
                <p class="text-center text-sm text-gray-400 mt-7">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:underline">Masuk</a>
                </p>

            </div>
        </div>
    </div>

    <script>
        function makeToggle(btnId, inputId, iconId) {
            const btn   = document.getElementById(btnId);
            const input = document.getElementById(inputId);
            const icon  = document.getElementById(iconId);

            const iconShow = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            `;
            const iconHide = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
            `;

            btn.addEventListener('click', function () {
                const hidden  = input.type === 'password';
                input.type    = hidden ? 'text' : 'password';
                icon.innerHTML = hidden ? iconHide : iconShow;
            });
        }

        makeToggle('togglePassword', 'password', 'eye-icon');
        makeToggle('toggleConfirm', 'password_confirmation', 'eye-icon-confirm');
    </script>

</x-layout.app>