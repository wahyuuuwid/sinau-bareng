
<x-layout.app title="Daftar Akun">
    <div class="min-h-screen bg-[#6155f5] flex items-center justify-center p-6">

        <div class="bg-[#f3f3f3] rounded-[45px] flex overflow-hidden shadow-xl w-full max-w-4xl">

            <div class="w-full md:w-1/2 p-12 lg:p-16">
                
                <h1 class="text-4xl font-bold text-center text-gray-800 mb-10 drop-shadow-md">
                    Daftar
                </h1>

                @if(session('error'))
                    <p class="text-red-500 mb-4 text-center text-sm font-medium">{{ session('error') }}</p>
                @endif

                <form method="POST" action="/register" class="space-y-4">
                    @csrf

                    <x-form.input 
                        label="Nama Lengkap" 
                        name="username" 
                        placeholder="Masukan Nama Lengkap Anda ..." 
                    />

                    <x-form.input 
                        label="Email" 
                        name="email" 
                        type="email" 
                        placeholder="Masukan Email Anda ..." 
                    />

                    <x-form.input 
                        label="Buat Kata Sandi" 
                        name="password" 
                        type="password" 
                        placeholder="Masukan Kata Sandi ..." 
                    />

                    <x-form.input 
                        label="Konfirmasi Kata Sandi" 
                        name="password_confirmation" 
                        type="password" 
                        placeholder="Masukan Kata Sandi ..." 
                    />

                    <button type="submit"
                        class="w-full py-3 mt-4 rounded-2xl text-white font-semibold bg-gradient-to-r from-indigo-500 to-purple-500 shadow-lg hover:opacity-90 transition transform hover:scale-[1.02]">
                        Daftar
                    </button>

                    <p class="text-center text-sm text-gray-600 mt-6 font-medium">
                        Sudah memiliki Akun ?
                        <a href="/login" class="text-indigo-600 font-bold hover:underline">Masuk</a>
                    </p>
                </form>
            </div>

            <div class="hidden md:block w-1/2 bg-[#d9d9d9]">
                </div>

        </div>
    </div>
</x-layout.app>