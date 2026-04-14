
<x-layout.app title="Login">
    <div class="min-h-screen bg-gradient-to-r from-indigo-500 to-purple-500 flex items-center justify-center p-4">
        
        <div class="bg-white rounded-[40px] flex overflow-hidden shadow-2xl w-full max-w-4xl">
            
            <div class="w-full md:w-[58%] p-12 lg:p-20 bg-[#f8f9fa]">
                <h1 class="text-4xl font-bold text-center text-[#2d2d2d] mb-10">Masuk</h1>

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    
                    <x-form.input label="Nama Lengkap /Email" name="email" type="email" />

                    <div class="relative">
                        <div class="flex justify-between mb-2 px-1">
                            <label class="text-sm font-semibold text-gray-700">Kata Sandi</label>
                            <a href="{{ route('password.request') }}" class="text-xs font-semibold text-indigo-600 hover:underline">
                                Lupa Kata Sandi ?
                            </a>
                        </div>
                        <div class="relative">
                            <input type="password" name="password" id="password" 
                                class="w-full px-5 py-4 bg-[#ececec] border-none rounded-xl focus:ring-2 focus:ring-indigo-400 outline-none transition-all">
                            
                            <div class="absolute inset-y-0 right-4 flex items-center text-gray-400 cursor-pointer" id="togglePassword">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <button type="submit" 
                            class="w-full py-4 text-white font-bold rounded-xl shadow-lg bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 transition-all duration-200 mt-4">
                        Masuk
                    </button>
                </form>

                <p class="text-center mt-10 text-sm font-medium text-gray-600">
                    Belum memiliki Akun ? <a href="/register" class="text-indigo-600 font-bold hover:underline">Daftar</a>
                </p>
            </div>

            <div class="hidden md:block w-[42%] bg-[#d9d9d9]">
                </div>

        </div>
    </div>

    @push('scripts')
    <script>
        // Script toggle password tetap di sini agar jalan
        document.getElementById('togglePassword').addEventListener('click', function () {
            const pwd = document.getElementById('password');
            pwd.type = pwd.type === 'password' ? 'text' : 'password';
        });
    </script>
    @endpush
</x-layout.app>