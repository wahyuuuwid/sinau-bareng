@extends($layout)

@section('content')
<div class="fixed top-0 left-64 right-0 bottom-0 bg-gray-50 overflow-y-auto z-20">
    <div class="p-8 w-full min-h-full">
        
        <div class="bg-white rounded-2xl p-4 mb-8 flex justify-between items-center shadow-sm border border-gray-100">
            <div class="relative w-96">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 font-bold" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </span>
                <input type="text" placeholder="Search" class="w-full bg-gray-50 border-none rounded-xl pl-12 pr-4 py-2 focus:ring-2 focus:ring-blue-400 outline-none">
            </div>

            <div class="flex items-center gap-6">
                <button class="text-gray-400 hover:text-blue-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </button>
                
                <div class="flex items-center gap-3 px-4 py-2 bg-blue-600 rounded-2xl shadow-md cursor-default">
                    <div class="text-right leading-tight">
                        <p class="font-bold text-white">{{ auth()->user()->username }}</p>
                        <p class="text-[10px] font-medium text-blue-200 uppercase tracking-wider">{{ auth()->user()->role }}</p>
                    </div>
                    <div class="relative">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->username) }}&background=ffffff&color=2563eb" class="w-10 h-10 rounded-full border border-blue-400 shadow-sm">
                    </div>
                </div>
            </div>
        </div>
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Pengaturan Profil</h1>

        <div class="space-y-4 mb-6">
            @if(session('success'))
            <div class="flex items-center p-4 bg-blue-600 text-white rounded-2xl shadow-md border border-blue-400">
                <div class="bg-blue-500 p-2 rounded-lg mr-3">
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

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 pb-10">
            
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 flex flex-col items-center h-fit">
                <div class="relative mb-4">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->username) }}&background=2563eb&color=fff" class="w-32 h-32 rounded-full border-4 border-blue-50 shadow-md">
                    <div class="absolute bottom-1 right-1 w-6 h-6 bg-green-500 border-4 border-white rounded-full"></div>
                </div>
                <h2 class="text-xl font-bold text-gray-800">{{ auth()->user()->username }}</h2>
                <p class="text-blue-600 font-medium uppercase text-xs tracking-widest mt-1">{{ auth()->user()->role }}</p>
            </div>

            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-6">Informasi Dasar</h3>
                    
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-2">Username</label>
                                <input type="text" name="username" value="{{ auth()->user()->username }}" class="w-full bg-gray-50 border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-2">Email Aktif</label>
                                <input type="email" name="email" value="{{ auth()->user()->email }}" class="w-full bg-gray-50 border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                            </div>
                        </div>
                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menyimpan perubahan profil ini?')" class="mt-6 bg-blue-600 text-white font-bold px-8 py-3 rounded-xl hover:bg-blue-700 shadow-blue-200 shadow-lg transition-all">
                            Simpan Perubahan
                        </button>
                    </form>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-6">Keamanan Akun</h3>
                    
                    <form action="{{ route('profile.password') }}" method="POST">
                        @csrf @method('PUT')
                        <div class="space-y-4">
                            <input type="password" name="current_password" placeholder="Password Saat Ini" class="w-full bg-gray-50 border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <input type="password" name="new_password" placeholder="Password Baru" class="w-full bg-gray-50 border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">
                                <input type="password" name="new_password_confirmation" placeholder="Konfirmasi Password Baru" class="w-full bg-gray-50 border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">
                            </div>
                        </div>
                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin mengubah password Anda?')" class="mt-6 bg-gray-800 text-white font-bold px-8 py-3 rounded-xl hover:bg-black transition-all">
                            Update Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection