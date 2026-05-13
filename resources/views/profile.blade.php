<x-layout.app title="Profil Saya">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
    </style>

    <div class="flex h-screen bg-[#F4F7FE] overflow-hidden">
        
        {{-- SIDEBAR MAHASISWA --}}
        <x-layout.sidebar_user /> 

        <main class="flex-1 flex flex-col overflow-y-auto">
            
            {{-- PEMBATAS DIPERBESAR MENJADI max-w-7xl AGAR LEBIH LEBAR & PAS --}}
            <div class="p-8 w-full max-w-7xl mx-auto">
                
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">Pengaturan Profil</h1>
                    <p class="text-gray-500 text-sm mt-1">Kelola informasi akun dan tingkatkan keamanan Anda.</p>
                </div>

                {{-- NOTIFIKASI SUKSES --}}
                @if(session('success'))
                    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-xl text-sm font-semibold flex items-center gap-3 shadow-sm">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        {{ session('success') }}
                    </div>
                @endif

                {{-- NOTIFIKASI ERROR (Opsional, sangat berguna jika validasi gagal) --}}
                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-100 text-red-600 rounded-xl text-sm font-medium shadow-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- GRID 2 KOLOM (INFORMASI DASAR & KEAMANAN) --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
                    
                    {{-- KOTAK KIRI: INFORMASI DASAR --}}
                    <div class="bg-white border border-gray-100 rounded-[20px] shadow-sm p-8 h-fit">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-12 h-12 bg-indigo-50 text-[#6155F5] rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">Informasi Dasar</h3>
                                <p class="text-xs text-gray-400 font-medium">Username dan email akun Anda.</p>
                            </div>
                        </div>

                        <form action="{{ route('student.profile.update') }}" method="POST" class="space-y-6">
                            @csrf
                            @method('PUT')
                            
                            <div>
                                <label class="block text-sm font-bold text-gray-600 mb-2">Nama Pengguna</label>
                                <input type="text" name="username" value="{{ old('username', auth()->user()->username) }}" required
                                        class="w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-[#6155F5] transition-all text-sm font-medium text-gray-800">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-bold text-gray-600 mb-2">Alamat Email</label>
                                <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required
                                        class="w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-[#6155F5] transition-all text-sm font-medium text-gray-800">
                            </div>

                            <div class="flex justify-end pt-2">
                                <button type="submit" class="bg-[#6155F5] text-white px-6 py-3 rounded-xl font-bold text-sm shadow-md shadow-indigo-100 hover:bg-[#5246e5] active:scale-[0.98] transition-all">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- KOTAK KANAN: KEAMANAN --}}
                    <div class="bg-white border border-gray-100 rounded-[20px] shadow-sm p-8 h-fit">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-12 h-12 bg-red-50 text-red-500 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">Keamanan Akun</h3>
                                <p class="text-xs text-gray-400 font-medium">Pembaruan kata sandi akun.</p>
                            </div>
                        </div>

                        <form action="{{ route('student.profile.password') }}" method="POST" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <div>
                                <label class="block text-sm font-bold text-gray-600 mb-2">Sandi Saat Ini</label>
                                <input type="password" name="current_password" required placeholder="••••••••"
                                        class="w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-[#6155F5] transition-all text-sm placeholder-gray-400 text-gray-800">
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-bold text-gray-600 mb-2">Sandi Baru</label>
                                    <input type="password" name="password" required placeholder="Min. 6 karakter"
                                            class="w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-[#6155F5] transition-all text-sm placeholder-gray-400 text-gray-800">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-600 mb-2">Konfirmasi</label>
                                    <input type="password" name="password_confirmation" required placeholder="Ulangi sandi"
                                            class="w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-[#6155F5] transition-all text-sm placeholder-gray-400 text-gray-800">
                                </div>
                            </div>

                            <div class="flex justify-end pt-2">
                                <button type="submit" class="bg-gray-800 text-white px-6 py-3 rounded-xl font-bold text-sm shadow-md hover:bg-black active:scale-[0.98] transition-all">
                                    Update Kata Sandi
                                </button>
                            </div>
                        </form>
                    </div>

                </div>

                {{-- KOTAK ZONA BAHAYA: HAPUS AKUN --}}
                <div class="mt-8 bg-white border border-red-100 rounded-[20px] shadow-sm p-8">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-red-50 text-red-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-red-600">Zona Bahaya: Hapus Akun</h3>
                            <p class="text-xs text-gray-400 font-medium">Tindakan ini bersifat permanen.</p>
                        </div>
                    </div>
                    
                    <p class="text-sm text-gray-600 mb-6 font-medium">Sekali Anda menghapus akun Anda, semua data materi, riwayat pembelajaran, dan akses ke sistem akan dihapus secara permanen. Harap pastikan Anda benar-benar ingin melakukan ini.</p>
                    
                    <button type="button" onclick="openDeleteModal()" class="bg-red-50 text-red-600 border border-red-200 px-6 py-3 rounded-xl font-bold text-sm hover:bg-red-600 hover:text-white active:scale-[0.98] transition-all">
                        Hapus Akun Saya
                    </button>
                </div>

                {{-- ========================================== --}}
                {{-- MODAL (MINI WINDOW) KONFIRMASI HAPUS AKUN  --}}
                {{-- ========================================== --}}
                <div id="deleteModal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-gray-900/60 backdrop-blur-sm transition-opacity">
                    <div class="bg-white rounded-[24px] w-full max-w-md p-8 shadow-2xl transform transition-all text-center mx-4">
                        
                        {{-- Ikon Peringatan --}}
                        <div class="w-20 h-20 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 mb-2">Hapus Akun Permanen?</h3>
                        <p class="text-sm text-gray-500 mb-8 font-medium">Anda akan kehilangan seluruh akses ke aplikasi. Data tidak dapat dipulihkan setelah dihapus.</p>

                        <div class="flex gap-4 justify-center">
                            {{-- Tombol Batal --}}
                            <button type="button" onclick="closeDeleteModal()" class="flex-1 py-3 bg-gray-100 text-gray-700 rounded-xl font-bold text-sm hover:bg-gray-200 transition-all">
                                Batal
                            </button>

                            {{-- Form Hapus Akun yang Sesungguhnya --}}
                            <form action="{{ route('student.profile.delete') }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full py-3 bg-red-600 text-white rounded-xl font-bold text-sm hover:bg-red-700 shadow-lg shadow-red-200 transition-all">
                                    Ya, Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- SCRIPT PENGENDALI MODAL --}}
                <script>
                    function openDeleteModal() {
                        const modal = document.getElementById('deleteModal');
                        modal.classList.remove('hidden');
                        modal.classList.add('flex');
                    }

                    function closeDeleteModal() {
                        const modal = document.getElementById('deleteModal');
                        modal.classList.add('hidden');
                        modal.classList.remove('flex');
                    }

                    // Tutup modal jika user klik area gelap di luar kotak putih
                    window.onclick = function(event) {
                        const modal = document.getElementById('deleteModal');
                        if (event.target == modal) {
                            closeDeleteModal();
                        }
                    }
                </script>

            </div>
        </main>
    </div>
</x-layout.app>