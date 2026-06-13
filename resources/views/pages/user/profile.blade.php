@extends($layout)

@section('content')
<div class="fixed top-0 left-64 right-0 bottom-0 bg-gray-50 overflow-y-auto z-20">
    <div class="p-8 w-full min-h-full">
        
        {{-- HEADER TOP BAR PREMIUM (ANTI-REDUNDAN & CLEAN) --}}
        <div class="bg-white rounded-2xl p-5 mb-8 flex justify-between items-center shadow-sm border border-gray-100">
            
            {{-- Bagian Kiri: Breadcrumbs Penunjuk Halaman (Gantiin Search) --}}
            <div class="flex flex-col text-left">
                <span class="text-[10px] uppercase tracking-widest text-gray-400 font-bold mb-0.5">Sistem Informasi</span>
                <h2 class="text-sm font-bold text-gray-800 flex items-center gap-2">
                    <span class="text-gray-400 font-medium">Dashboard</span> 
                    <span class="text-gray-300 font-normal">/</span> 
                    <span class="text-[#6155F5]">Pengaturan Profil</span>
                </h2>
            </div>

            {{-- Bagian Kanan: Status Identitas Minimalis (Card Numpuk & Lonceng Dibuang) --}}
            <div class="flex items-center gap-3 bg-gray-50/80 border border-gray-100 px-4 py-2 rounded-2xl">
                <div class="text-right leading-tight">
                    <p class="font-black text-gray-800 text-sm">{{ auth()->user()->username }}</p>
                    <p class="text-[9px] font-bold text-[#6155F5] uppercase tracking-widest mt-0.5">{{ auth()->user()->role }}</p>
                </div>
                <div class="w-px h-6 bg-gray-200 mx-1"></div>
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->username) }}&background=6155F5&color=fff" class="w-8 h-8 rounded-full shadow-sm border border-indigo-100">
            </div>

        </div>

        <h1 class="text-2xl font-bold text-gray-800 mb-6">Pengaturan Profil</h1>

        {{-- STATUS ALERTS --}}
        <div class="space-y-4 mb-6">
            @if(session('success'))
            <div class="flex items-center p-4 bg-[#6155F5] text-white rounded-2xl shadow-md border border-indigo-400">
                <div class="bg-[#4f44d8] p-2 rounded-lg mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <span class="font-bold">{{ session('success') }}</span>
            </div>
            @endif

            @if($errors->any() || session('error'))
            <div class="flex items-center p-4 bg-red-600 text-white rounded-2xl shadow-md border border-red-400">
                <div class="bg-red-500 p-2 rounded-lg mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <ul class="font-bold list-disc list-inside">
                    @if(session('error')) <li>{{ session('error') }}</li> @endif
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>

        {{-- MAIN SECTION CONTAINER --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 pb-10">
            
            {{-- KARTU AVATAR USER UTAMA --}}
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 flex flex-col items-center h-fit">
                <div class="relative mb-4">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->username) }}&background=6155F5&color=fff" class="w-32 h-32 rounded-full border-4 border-indigo-50 shadow-md">
                    <div class="absolute bottom-1 right-1 w-6 h-6 bg-green-500 border-4 border-white rounded-full"></div>
                </div>
                <h2 class="text-xl font-bold text-gray-800">{{ auth()->user()->username }}</h2>
                <p class="text-[#6155F5] font-semibold uppercase text-xs tracking-widest mt-1">{{ auth()->user()->role }}</p>
            </div>

            {{-- KOTAK FORM ISIAN --}}
            <div class="lg:col-span-2 space-y-8">
                {{-- FORM INFORMASI DASAR --}}
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-6">Informasi Dasar</h3>
                    
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf @method('PATCH')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-2">Username</label>
                                <input type="text" name="username" value="{{ auth()->user()->username }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#6155F5] border-transparent outline-none transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-2">Email Aktif</label>
                                <input type="email" name="email" value="{{ auth()->user()->email }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#6155F5] border-transparent outline-none transition-all">
                            </div>
                        </div>
                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menyimpan perubahan profil ini?')" class="mt-6 bg-[#6155F5] text-white font-bold px-8 py-3 rounded-xl hover:bg-[#4f44d8] shadow-indigo-100 shadow-lg transition-all transform active:scale-95">
                            Simpan Perubahan
                        </button>
                    </form>
                </div>

                {{-- FORM KEAMANAN AKUN (PASSWORD) --}}
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-6">Keamanan Akun</h3>
                    
                    <form action="{{ route('profile.password') }}" method="POST">
                        @csrf @method('PUT')
                        <div class="space-y-4">
                            <input type="password" name="current_password" placeholder="Password Saat Ini" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#6155F5] border-transparent outline-none transition-all">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <input type="password" name="new_password" placeholder="Password Baru" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#6155F5] border-transparent outline-none transition-all">
                                <input type="password" name="new_password_confirmation" placeholder="Konfirmasi Password Baru" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#6155F5] border-transparent outline-none transition-all">
                            </div>
                        </div>
                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin mengubah password Anda?')" class="mt-6 bg-slate-800 text-white font-bold px-8 py-3 rounded-xl hover:bg-slate-900 shadow-lg transition-all transform active:scale-95">
                            Update Password
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection