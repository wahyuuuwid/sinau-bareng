<!DOCTYPE html>
<html lang="id">
<head>
    <script src="https://cdn.tailwindcss.com"></script> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Sinau Bareng' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="{{ $attributes->get('class', 'bg-gray-50 text-gray-800') }}">

    {{ $slot }}

    <div id="logoutModal" class="fixed inset-0 z-[999] hidden items-center justify-center bg-black/50 backdrop-blur-sm px-4 transition-opacity">
        <div class="bg-white rounded-2xl p-6 max-w-sm w-full shadow-2xl text-center transform transition-all scale-100">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-4">
                <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            
            <h3 class="text-xl font-bold text-gray-900 mb-2">Konfirmasi Logout</h3>
            <p class="text-gray-500 text-sm mb-6">Apakah anda yakin mau logout dari akun anda?</p>

            <div class="flex gap-4">
                <button type="button" onclick="closeLogoutModal()" class="flex-1 px-4 py-2.5 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition-colors">
                    Batal
                </button>
                
                <button type="button" onclick="document.getElementById('logout-form').submit();" class="flex-1 px-4 py-2.5 bg-red-600 text-white font-bold rounded-xl hover:bg-red-700 shadow-lg shadow-red-200 transition-all">
                    Yakin
                </button>
            </div>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>

    <script>
        // Mencegah action default dari tombol pembuka dan menampilkan modal
        function openLogoutModal(event) {
            if(event) {
                event.preventDefault(); 
            }
            const modal = document.getElementById('logoutModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        // Menyembunyikan modal
        function closeLogoutModal() {
            const modal = document.getElementById('logoutModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Klik di luar area modal untuk menutupnya
        window.onclick = function(event) {
            const modal = document.getElementById('logoutModal');
            if (event.target === modal) {
                closeLogoutModal();
            }
        }
    </script>
</body>
</html>