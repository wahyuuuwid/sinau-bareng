<x-layout.app title="Daftar Akun">
    <div class="min-h-screen bg-[#6155f5] flex items-center justify-center p-6">

        <div class="bg-[#f3f3f3] rounded-[45px] flex overflow-hidden shadow-xl w-full max-w-4xl">

            <div class="w-full md:w-1/2 p-12 lg:p-16">
                
                <h1 class="text-4xl font-bold text-center text-gray-800 mb-10 drop-shadow-md">
                    Daftar
                </h1>

                {{-- 🔥 ALERT ERROR GLOBAL: Muncul kalau ada validasi yang gagal (misal password kurang dari 6 karakter) --}}
                @if ($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-xl mb-6 shadow-sm animate-pulse">
                        <div class="flex items-center mb-1">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-bold text-sm">Ada kesalahan pendaftaran:</span>
                        </div>
                        <ul class="list-disc list-inside text-xs font-semibold ml-7">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Pesan error manual dari session (jika ada) --}}
                @if(session('error'))
                    <p class="text-red-500 mb-4 text-center text-sm font-medium">{{ session('error') }}</p>
                @endif

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <x-form.input 
                        label="Nama Lengkap" 
                        name="username" 
                        placeholder="Masukan Nama Lengkap Anda ..." 
                        value="{{ old('username') }}"
                    />

                    <x-form.input 
                        label="Email" 
                        name="email" 
                        type="email" 
                        placeholder="Masukan Email Anda ..." 
                        value="{{ old('email') }}"
                    />

                    <x-form.input 
                        label="Buat Kata Sandi" 
                        name="password" 
                        type="password" 
                        placeholder="Minimal 6 karakter ..." 
                    />

                    <x-form.input 
                        label="Konfirmasi Kata Sandi" 
                        name="password_confirmation" 
                        type="password" 
                        placeholder="Ulangi Kata Sandi ..." 
                    />

                    <button type="submit"
                        class="w-full py-4 mt-4 rounded-2xl text-white font-bold bg-gradient-to-r from-indigo-500 to-purple-500 shadow-lg hover:opacity-90 transition transform hover:scale-[1.02] active:scale-[0.98]">
                        Daftar
                    </button>

                    <p class="text-center text-sm text-gray-600 mt-6 font-medium">
                        Sudah memiliki Akun ?
                        <a href="{{ route('login') }}" class="text-indigo-600 font-bold hover:underline">Masuk</a>
                    </p>
                </form>
            </div>

            {{-- Sisi Kanan: Dekorasi --}}
            <div class="hidden md:block w-1/2 bg-[#d9d9d9]">
                {{-- Bisa lo kasih image atau ilustrasi di sini --}}
            </div>

        </div>
    </div>
</x-layout.app>