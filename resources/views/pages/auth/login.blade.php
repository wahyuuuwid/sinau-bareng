<x-layout.app title="Login - Sinau Bareng">

    @push('styles')
    <style>
        .input-login {
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .input-login:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79,70,229,0.10);
        }
        .btn-masuk {
            transition: background 0.2s, transform 0.15s, box-shadow 0.15s;
        }
        .btn-masuk:hover {
            background: #4338ca;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(79,70,229,0.25);
        }
        .btn-masuk:active {
            transform: translateY(0);
        }
        @media (prefers-reduced-motion: reduce) {
            .btn-masuk { transition: none; }
        }
    </style>
    @endpush

    <div class="min-h-screen bg-gray-50 flex items-center justify-center p-6">

        <div class="w-full max-w-4xl bg-white rounded-3xl shadow-md border border-gray-200 overflow-hidden flex min-h-[560px]">

            {{-- ===== PANEL KIRI: Branding ===== --}}
            <div class="hidden md:flex w-[44%] bg-indigo-600 flex-col justify-between p-12 relative overflow-hidden">

                {{-- Ornamen titik-titik --}}
                <div class="absolute top-0 right-0 w-48 h-48 opacity-10"
                     style="background-image: radial-gradient(circle, white 1.5px, transparent 1.5px); background-size: 16px 16px;">
                </div>
                <div class="absolute bottom-0 left-0 w-40 h-40 opacity-10"
                     style="background-image: radial-gradient(circle, white 1.5px, transparent 1.5px); background-size: 16px 16px;">
                </div>

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
                    <p class="text-indigo-300 text-xs font-semibold uppercase tracking-widest mb-4">Platform Belajar Mahasiswa</p>
                    <h2 class="text-white text-3xl font-bold leading-snug">
                        Satu tempat<br>untuk semua<br>materi kuliahmu.
                    </h2>
                    <p class="text-indigo-200 text-sm mt-4 leading-relaxed max-w-xs">
                        Unggah, temukan, dan nilai materi terbaik bersama teman sekampus.
                    </p>
                </div>

                {{-- Feature highlights --}}
                <div class="relative z-10 space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-white text-xs font-semibold">Upload Materi</p>
                            <p class="text-indigo-300 text-[11px]">Bagikan file, PDF, atau catatan kuliah</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-white text-xs font-semibold">Rating & Ulasan</p>
                            <p class="text-indigo-300 text-[11px]">Nilai kualitas materi dari sesama mahasiswa</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-white text-xs font-semibold">Pantau Progressmu</p>
                            <p class="text-indigo-300 text-[11px]">Lihat statistik materi yang kamu unggah</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===== PANEL KANAN: Form ===== --}}
            <div class="flex-1 flex flex-col justify-center px-10 py-14 lg:px-16">

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
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-gray-900">Selamat datang kembali</h1>
                    <p class="text-gray-400 text-sm mt-1">Masuk untuk melanjutkan belajar.</p>
                </div>

                {{-- Error: kredensial salah --}}
                @if(session('error'))
                    <div class="mb-5 flex items-center gap-3 bg-red-50 border border-red-100 text-red-600 rounded-2xl px-4 py-3 text-sm font-medium">
                        <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Error: validasi --}}
                @if($errors->any())
                    <div class="mb-5 bg-orange-50 border border-orange-100 text-orange-600 rounded-2xl px-4 py-3 text-xs font-semibold">
                        <ul class="list-disc list-inside space-y-0.5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Form --}}
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

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
                            class="input-login w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-300 @error('email') border-red-300 bg-red-50 @enderror"
                        >
                        @error('email')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label for="password" class="text-sm font-semibold text-gray-700">Kata Sandi</label>
                            <a href="{{ route('password.request') }}" class="text-xs text-indigo-500 font-medium hover:text-indigo-700 transition-colors">
                                Lupa kata sandi?
                            </a>
                        </div>
                        <div class="relative">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Masukkan kata sandi"
                                required
                                autocomplete="current-password"
                                class="input-login w-full px-4 py-3 pr-11 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-300 @error('password') border-red-300 bg-red-50 @enderror"
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

                    {{-- Remember me --}}
                    <!-- <div class="flex items-center gap-2.5">
                        <input type="checkbox" id="remember" name="remember"
                            class="w-4 h-4 rounded border-gray-300 accent-indigo-600">
                        <label for="remember" class="text-sm text-gray-500 cursor-pointer select-none">
                            Ingat saya
                        </label>
                    </div> -->

                    {{-- Submit --}}
                    <button type="submit"
                        class="btn-masuk w-full py-3 bg-indigo-600 text-white text-sm font-semibold rounded-xl">
                        Masuk
                    </button>
                </form>

                {{-- Register --}}
                <p class="text-center text-sm text-gray-400 mt-8">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-indigo-600 font-semibold hover:underline">Daftar sekarang</a>
                </p>

            </div>
        </div>

    </div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eye-icon');

    toggleBtn.addEventListener('click', function () {
        const isPassword = passwordInput.type === 'password';

        passwordInput.type = isPassword ? 'text' : 'password';

        this.classList.toggle('text-indigo-500');

        eyeIcon.innerHTML = isPassword
            ? `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`
            : `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            `;
    });
});
</script>

</x-layout.app>