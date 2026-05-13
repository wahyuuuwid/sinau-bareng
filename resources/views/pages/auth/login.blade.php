<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sinau Bareng</title>
    {{-- Memastikan Tailwind CSS Termuat --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-r from-indigo-500 to-purple-500">

    <div class="min-h-screen flex items-center justify-center p-4">
        
        <div class="bg-white rounded-[40px] flex overflow-hidden shadow-2xl w-full max-w-4xl">
            
            {{-- Sisi Kiri: Form Login --}}
            <div class="w-full md:w-[58%] p-12 lg:p-20 bg-[#f8f9fa]">
                <h1 class="text-4xl font-bold text-center text-[#2d2d2d] mb-10">Masuk</h1>

                {{--ERROR kalau email/password salah --}}
                @if(session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-xl mb-6 shadow-sm flex items-center gap-3 animate-pulse">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm font-bold">{{ session('error') }}</span>
                    </div>
                @endif

                {{--ERROR VALIDASI --}}
                @if ($errors->any())
                    <div class="bg-orange-50 border-l-4 border-orange-400 text-orange-700 p-4 rounded-xl mb-6 shadow-sm">
                        <ul class="list-disc list-inside text-xs font-semibold">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    
                    {{-- Input Email (Diubah menjadi HTML standar agar lebih aman) --}}
                    <div>
                        <label class="block text-[13px] font-semibold text-gray-700 mb-2 px-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            placeholder="Masukan Email Anda..."
                            class="w-full px-5 py-4 bg-[#ececec] border-none rounded-xl focus:ring-2 focus:ring-indigo-400 outline-none transition-all font-semibold text-gray-600 placeholder:text-gray-400 placeholder:font-normal">
                    </div>

                    {{-- Input Password --}}
                    <div>
                        <div class="flex justify-between mb-2 px-1">
                            <label class="text-[13px] font-semibold text-gray-700">Kata Sandi</label>
                            <a href="{{ route('password.request') }}" class="text-xs font-semibold text-indigo-600 hover:underline">
                                Lupa Kata Sandi ?
                            </a>
                        </div>
                        <div class="relative">
                            <input type="password" name="password" id="password" required
                                placeholder="Masukan Kata Sandi..."
                                class="w-full px-5 py-4 bg-[#ececec] border-none rounded-xl focus:ring-2 focus:ring-indigo-400 outline-none transition-all font-semibold text-gray-600 placeholder:text-gray-400 placeholder:font-normal">
                            
                            <div class="absolute inset-y-0 right-4 flex items-center text-gray-400 cursor-pointer hover:text-indigo-500" id="togglePassword">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <button type="submit" 
                            class="w-full py-4 text-white font-bold rounded-xl shadow-lg bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 transition-all duration-200 active:scale-[0.98] mt-4">
                        Masuk
                    </button>
                </form>

                <p class="text-center mt-10 text-sm font-medium text-gray-600">
                    Belum memiliki Akun ? 
                    <a href="{{ route('register') }}" class="text-indigo-600 font-bold hover:underline">Daftar</a>
                </p>
            </div>

            {{-- Sisi Kanan: Dekorasi/Gambar --}}
            <div class="hidden md:block w-[42%] bg-[#d9d9d9]">
                {{-- Bisa diisi gambar pendukung --}}
            </div>

        </div>
    </div>

    <script>
        // Toggle Show/Hide Password
        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        toggleBtn.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Opsional: ganti warna icon pas aktif
            this.classList.toggle('text-indigo-500');
        });
    </script>
</body>
</html>