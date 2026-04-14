<x-layout.app title="Lupa Kata Sandi">
    <div class="min-h-screen bg-gradient-to-r from-indigo-500 to-purple-500 flex items-center justify-center p-4">
        <div class="bg-white rounded-[40px] flex overflow-hidden shadow-2xl w-full max-w-lg">
            
            <div class="w-full p-12 lg:p-16 bg-[#f8f9fa]">
                <h1 class="text-3xl font-bold text-center text-[#2d2d2d] mb-6">Lupa Sandi?</h1>
                <p class="text-gray-500 text-center mb-10 text-sm">
                    Jangan panik! Masukkan email kamu di bawah, nanti kami kirimkan link untuk atur ulang kata sandinya.
                </p>

                @if (session('status'))
                    <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6 text-sm font-medium">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf
                    <x-form.input label="Alamat Email" name="email" type="email" placeholder="contoh@mail.com" />

                    <button type="submit" class="w-full py-4 text-white font-bold rounded-xl shadow-lg bg-indigo-600 hover:bg-indigo-700 transition-all duration-200">
                        Kirim Link Reset
                    </button>
                </form>

                <div class="mt-8 text-center">
                    <a href="/login" class="text-indigo-600 font-bold hover:underline text-sm">
                        ← Kembali ke Login
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-layout.app>