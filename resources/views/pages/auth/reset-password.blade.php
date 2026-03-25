<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Ulang Sandi - SinauBareng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500">

    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="bg-white p-8 rounded-3xl shadow-2xl w-full max-w-md transform transition-all hover:scale-[1.01]">
            
            <div class="text-center mb-8">
                <h2 class="text-3xl font-extrabold text-gray-800 tracking-tight">Atur Ulang Sandi</h2>
                <p class="text-gray-500 mt-2">Buat kata sandi baru yang kuat untuk akun kamu.</p>
            </div>

            <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
                @csrf
                
                {{-- Token Rahasia --}}
                <input type="hidden" name="token" value="{{ $token }}">

                {{-- Input Email (Readonly) --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat Email</label>
                    <input type="email" name="email" value="{{ $email ?? old('email') }}" 
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-400 cursor-not-allowed focus:outline-none" 
                        readonly>
                    @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                {{-- Input Password Baru --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1 text-gray-800">Kata Sandi Baru</label>
                    <input type="password" name="password" placeholder="Minimal 8 karakter"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-purple-400 focus:border-transparent transition-all outline-none"
                        required autofocus>
                    @error('password') <span class="text-red-500 text-xs mt-1 text-gray-800 font-medium">{{ $message }}</span> @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1 text-gray-800">Ulangi Kata Sandi</label>
                    <input type="password" name="password_confirmation" placeholder="Konfirmasi sandi baru"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-purple-400 focus:border-transparent transition-all outline-none"
                        required>
                </div>

                <button type="submit" 
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-indigo-200 transition-all active:scale-95">
                    Update Kata Sandi
                </button>

                <div class="text-center mt-6">
                    <a href="/login" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium transition-colors">
                        &larr; Kembali ke halaman Login
                    </a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>