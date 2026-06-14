<x-layout.app_admin title="Profil Admin">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@400;500;600&display=swap');
    </style>

    <div class="min-h-screen bg-[#ECECEC] font-['Poppins'] text-[#000000] flex w-full overflow-x-hidden">
        
        <main class="flex-1 relative pt-[32px] px-[24px] pb-[40px] min-w-0 flex flex-col">
            
            <div class="w-full flex flex-col flex-1 max-w-4xl">
                
                <div class="mb-[24px]">
                    <h1 class="text-[22px] leading-[30px] font-semibold text-[#000000]">Pengaturan Profil</h1>
                    <p class="text-gray-500 text-[14px]">Kelola informasi akun dan keamanan administrator Anda.</p>
                </div>

                {{-- NOTIFIKASI --}}
                @if(session('success'))
                    <div class="mb-[20px] p-[16px] bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-[16px] text-[14px] font-medium flex items-center gap-3 shadow-sm">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-[20px] p-[16px] bg-red-50 border border-red-100 text-red-600 rounded-[16px] text-[13px] font-medium shadow-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 gap-8">
                    
                    {{-- BAGIAN 1: INFORMASI PROFIL --}}
                    <div class="bg-[#FFFFFF] border border-[#D7D7D7] rounded-[20px] shadow-sm p-[32px]">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-12 h-12 bg-indigo-50 text-[#6155F5] rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-[18px] font-bold text-gray-800">Informasi Dasar</h3>
                                <p class="text-xs text-gray-400 font-medium">Perbarui username dan alamat email sistem Anda.</p>
                            </div>
                        </div>

                        <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-6">
                            @csrf
                            @method('PUT')
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-[13px] font-semibold text-gray-700 mb-[8px]">Username Admin</label>
                                    <input type="text" name="username" value="{{ old('username', auth()->user()->username) }}" required
                                           class="w-full px-[16px] py-[12px] bg-[#F9F9FC] border border-[#D7D7D7] rounded-[12px] outline-none focus:ring-2 focus:ring-[#6155F5] transition-all text-[14px] font-medium">
                                </div>
                                <div>
                                    <label class="block text-[13px] font-semibold text-gray-700 mb-[8px]">Email Address</label>
                                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required
                                           class="w-full px-[16px] py-[12px] bg-[#F9F9FC] border border-[#D7D7D7] rounded-[12px] outline-none focus:ring-2 focus:ring-[#6155F5] transition-all text-[14px] font-medium">
                                </div>
                            </div>

                            <div class="flex justify-end pt-4">
                                <button type="submit" class="bg-[#6155F5] text-white px-[32px] py-[12px] rounded-[14px] font-bold text-[14px] shadow-lg shadow-indigo-100 hover:bg-[#5246e5] transition-all">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- BAGIAN 2: KEAMANAN AKUN --}}
                    <div class="bg-[#FFFFFF] border border-[#D7D7D7] rounded-[20px] shadow-sm p-[32px]">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-12 h-12 bg-red-50 text-red-500 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-[18px] font-bold text-gray-800">Keamanan & Kata Sandi</h3>
                                <p class="text-xs text-gray-400 font-medium">Pastikan akun Anda menggunakan password yang kuat.</p>
                            </div>
                        </div>

                        <form action="{{ route('admin.profile.password') }}" method="POST" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label class="block text-[13px] font-semibold text-gray-700 mb-[8px]">Kata Sandi Saat Ini</label>
                                    <input type="password" name="current_password" required placeholder="••••••••"
                                           class="w-full px-[16px] py-[12px] bg-[#F9F9FC] border border-[#D7D7D7] rounded-[12px] outline-none focus:ring-2 focus:ring-red-400 transition-all text-[14px]">
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-[13px] font-semibold text-gray-700 mb-[8px]">Kata Sandi Baru</label>
                                        <input type="password" name="password" required placeholder="Minimal 6 karakter"
                                               class="w-full px-[16px] py-[12px] bg-[#F9F9FC] border border-[#D7D7D7] rounded-[12px] outline-none focus:ring-2 focus:ring-[#6155F5] transition-all text-[14px]">
                                    </div>
                                    <div>
                                        <label class="block text-[13px] font-semibold text-gray-700 mb-[8px]">Konfirmasi Sandi Baru</label>
                                        <input type="password" name="password_confirmation" required placeholder="Ulangi sandi baru"
                                               class="w-full px-[16px] py-[12px] bg-[#F9F9FC] border border-[#D7D7D7] rounded-[12px] outline-none focus:ring-2 focus:ring-[#6155F5] transition-all text-[14px]">
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end pt-4">
                                <button type="submit" class="bg-gray-800 text-white px-[32px] py-[12px] rounded-[14px] font-bold text-[14px] hover:bg-black transition-all">
                                    Perbarui Kata Sandi
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </main>
    </div>
</x-layout.app_admin>