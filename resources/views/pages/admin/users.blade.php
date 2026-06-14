<x-layout.app_admin title="Kelola Pengguna">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@400;500;600&display=swap');
    </style>

    <div class=" bg-[#ECECEC] font-['Poppins'] text-[#000000] flex w-full overflow-x-hidden">
        

        <main class="flex-1 relative pt-[16px] px-[24px]">

            <div class="w-full flex flex-col flex-1">
                
                <div class="flex justify-between items-center mb-[24px]">
                    <div class="flex items-center gap-4">
                        <h1 class="text-[22px] leading-[30px] font-semibold text-[#000000]">Kelola Pengguna</h1>
                        
                        <div class="flex items-center gap-2 bg-white border border-[#D7D7D7] px-[16px] py-[8px] rounded-[14px] shadow-sm">
                            <span class="text-[13px] text-gray-400 font-medium uppercase tracking-wider">Status:</span>
                            <span class="text-[15px] font-bold text-[#6155F5]">{{ $totalUsers ?? \App\Models\User::count() }} Pengguna</span>
                        </div>
                    </div>
                    
                    <button onclick="toggleModal('modal-add')" class="bg-[#6155F5] text-white px-[24px] py-[12px] rounded-[16px] font-semibold text-[14px] flex items-center gap-[10px] shadow-lg shadow-indigo-100 hover:bg-[#5246e5] hover:-translate-y-0.5 transition-all duration-300">
                        <div class="bg-white/20 p-1 rounded-lg">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                        </div>
                        Tambah Pengguna
                    </button>
                </div>

                {{-- Notifikasi Sukses --}}
                @if(session('success'))
                    <div class="mb-[20px] p-[16px] bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-[16px] text-[14px] font-medium flex items-center gap-3 shadow-sm">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Notifikasi Error (Jika email sudah terdaftar / validasi gagal) --}}
                @if ($errors->any())
                    <div class="mb-[20px] p-[16px] bg-red-50 border border-red-100 text-red-600 rounded-[16px] text-[13px] font-medium shadow-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="bg-[#FFFFFF] border border-[#D7D7D7] rounded-[20px] shadow-sm overflow-hidden flex flex-col">

    <div class="overflow-x-auto">

        <table class="w-full text-left border-collapse whitespace-nowrap">

            <thead class="bg-gray-50 border-b border-gray-100 sticky top-0 z-10">
                <tr>
                    <th class="px-[24px] py-[20px] text-[13px] font-bold text-gray-400 uppercase tracking-widest w-[80px]">
                        No
                    </th>
                    <th class="px-[24px] py-[20px] text-[13px] font-bold text-gray-400 uppercase tracking-widest">
                        Nama Pengguna
                    </th>
                    <th class="px-[24px] py-[20px] text-[13px] font-bold text-gray-400 uppercase tracking-widest">
                        Email Address
                    </th>
                    <th class="px-[24px] py-[20px] text-[13px] font-bold text-gray-400 uppercase tracking-widest">
                        System Role
                    </th>
                    <th class="px-[24px] py-[20px] text-[13px] font-bold text-gray-400 uppercase tracking-widest text-center w-[120px]">
                        Actions
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                @foreach($users as $index => $user)
                <tr class="hover:bg-[#F9F9FC] transition-colors duration-200 group">

                    <td class="px-[24px] py-[14px] text-[14px] font-medium text-gray-400">
                       {{ sprintf('%02d', $users->firstItem() + $index) }}
                    </td>

                    <td class="px-[24px] py-[14px]">
                        <span class="text-[15px] font-semibold text-gray-800 group-hover:text-[#6155F5] transition-colors">
                            {{ $user->username }}
                        </span>
                    </td>

                    <td class="px-[24px] py-[14px] text-[14px] text-gray-500 font-['Inter']">
                        {{ $user->email }}
                    </td>

                    <td class="px-[24px] py-[14px]">
                        <span class="px-[16px] py-[6px] rounded-full text-[11px] font-bold uppercase tracking-widest border
                            {{ $user->role == 'admin'
                                ? 'bg-purple-50 text-purple-600 border-purple-100'
                                : ($user->role == 'dosen'
                                    ? 'bg-blue-50 text-blue-600 border-blue-100'
                                    : 'bg-emerald-50 text-emerald-600 border-emerald-100') }}">
                            {{ $user->role }}
                        </span>
                    </td>

                    <td class="px-[24px] py-[14px]">
                        <div class="flex justify-center gap-[8px]">
                            <button
                                 onclick="editUser(
        '{{ $user->id }}',
        '{{ $user->username }}',
        '{{ $user->email }}',
        '{{ $user->role }}'
    )"
                                class="p-[10px] text-gray-400 hover:text-[#6155F5] hover:bg-indigo-50 rounded-[12px] transition-all">
                                <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                            </button>

                            <button type="button"
                                onclick="openDeleteModal('{{ $user->id }}')"
                                class="p-[10px] text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-[12px] transition-all">
                                <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>

        </table>

       @if ($users->hasPages())
<div class="flex items-center justify-between px-6 py-4 border-t border-gray-100 bg-white">

    <p class="text-sm text-gray-500">
        Menampilkan {{ $users->firstItem() }}
        - {{ $users->lastItem() }}
        dari {{ $users->total() }} pengguna
    </p>

    <div class="flex items-center gap-2">

        {{-- Previous --}}
        @if ($users->onFirstPage())
            <span class="w-10 h-10 flex items-center justify-center bg-gray-100 text-gray-300 rounded-xl cursor-not-allowed">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 19l-7-7 7-7"/>
                </svg>
            </span>
        @else
            <a href="{{ $users->previousPageUrl() }}"
               class="w-10 h-10 flex items-center justify-center bg-white border border-gray-200 rounded-xl hover:bg-gray-50 hover:border-[#6155F5] hover:text-[#6155F5] transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
        @endif

        {{-- Page Numbers --}}
        @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)

            @if ($page == $users->currentPage())
                <span class="w-10 h-10 flex items-center justify-center bg-[#6155F5] text-white rounded-xl font-semibold shadow-md">
                    {{ $page }}
                </span>
            @else
                <a href="{{ $url }}"
                   class="w-10 h-10 flex items-center justify-center bg-white border border-gray-200 rounded-xl hover:bg-gray-50 hover:border-[#6155F5] hover:text-[#6155F5] transition-all">
                    {{ $page }}
                </a>
            @endif

        @endforeach

        {{-- Next --}}
        @if ($users->hasMorePages())
            <a href="{{ $users->nextPageUrl() }}"
               class="w-10 h-10 flex items-center justify-center bg-white border border-gray-200 rounded-xl hover:bg-gray-50 hover:border-[#6155F5] hover:text-[#6155F5] transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        @else
            <span class="w-10 h-10 flex items-center justify-center bg-gray-100 text-gray-300 rounded-xl cursor-not-allowed">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5l7 7-7 7"/>
                </svg>
            </span>
        @endif

    </div>

</div>
@endif

        @if(count($users) == 0)
        <div class="flex flex-col items-center justify-center py-[60px] text-center">
            <div class="w-[80px] h-[80px] bg-gray-50 rounded-full flex items-center justify-center text-gray-300 mb-4">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                    </path>
                </svg>
            </div>

            <p class="text-[16px] text-gray-500 font-medium">
                Belum ada data pengguna
            </p>

            <p class="text-[14px] text-gray-400 mt-1">
                Silakan tambahkan pengguna baru.
            </p>
        </div>
        @endif

    </div>
</div>

            </div>
        </main>
    </div>

    {{-- MODAL TAMBAH PENGGUNA --}}
    <div id="modal-add" class="fixed inset-0 z-[100] hidden items-center justify-center bg-gray-900/40 backdrop-blur-sm px-4 transition-opacity">
        <div class="bg-white rounded-[24px] w-full max-w-[480px] p-[32px] shadow-2xl">
            
            <div class="flex justify-between items-center mb-[24px]">
                <h3 class="text-[20px] font-bold text-gray-800">Tambah Pengguna Baru</h3>
                <button onclick="toggleModal('modal-add')" class="text-gray-400 hover:text-gray-600 bg-gray-50 hover:bg-gray-100 rounded-full p-2 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            {{-- FORM DENGAN STYLING YANG SUDAH DISESUAIKAN --}}
            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-[16px]">
                @csrf 
                
                <div>
                    <label class="block text-[13px] font-semibold text-gray-700 mb-[8px]">Nama Pengguna</label>
                    <input type="text" name="username" required placeholder="Masukkan nama lengkap..." 
                           class="w-full px-[16px] py-[12px] bg-[#F9F9FC] border border-[#D7D7D7] rounded-[12px] outline-none focus:ring-2 focus:ring-[#6155F5] focus:border-[#6155F5] transition-all text-[14px]">
                </div>

                <div>
                    <label class="block text-[13px] font-semibold text-gray-700 mb-[8px]">Email Address</label>
                    <input type="email" name="email" required placeholder="nama@email.com" 
                           class="w-full px-[16px] py-[12px] bg-[#F9F9FC] border border-[#D7D7D7] rounded-[12px] outline-none focus:ring-2 focus:ring-[#6155F5] focus:border-[#6155F5] transition-all text-[14px]">
                </div>

                <div>
                    <label class="block text-[13px] font-semibold text-gray-700 mb-[8px]">Kata Sandi</label>
                    <input type="password" name="password" required placeholder="Minimal 6 karakter" 
                           class="w-full px-[16px] py-[12px] bg-[#F9F9FC] border border-[#D7D7D7] rounded-[12px] outline-none focus:ring-2 focus:ring-[#6155F5] focus:border-[#6155F5] transition-all text-[14px]">
                </div>

                <div>
                    <label class="block text-[13px] font-semibold text-gray-700 mb-[8px]">System Role</label>
                    <select name="role" required class="w-full px-[16px] py-[12px] bg-[#F9F9FC] border border-[#D7D7D7] rounded-[12px] outline-none focus:ring-2 focus:ring-[#6155F5] focus:border-[#6155F5] transition-all text-[14px]"> 
                        <option value="user">Mahasiswa (User)</option>
                        <option value="dosen">Dosen</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div class="flex gap-[12px] pt-[16px]">
                    <button type="button" onclick="toggleModal('modal-add')" class="flex-1 py-[12px] bg-gray-100 text-gray-600 rounded-[12px] font-semibold hover:bg-gray-200 transition-colors">Batal</button>
                    <button type="submit" class="flex-1 py-[12px] bg-[#6155F5] text-white rounded-[12px] font-semibold hover:bg-[#5246e5] shadow-lg shadow-indigo-100 transition-all">Simpan Pengguna</button>
                </div>
            </form>

        </div>
    </div>

    <div id="modal-edit"
    class="fixed inset-0 z-[100] hidden items-center justify-center bg-gray-900/40 backdrop-blur-sm px-4 transition-opacity">

    <div class="bg-white rounded-[24px] w-full max-w-[480px] p-[32px] shadow-2xl">

        <div class="flex justify-between items-center mb-[24px]">
            <h3 class="text-[20px] font-bold text-gray-800">
                Edit Pengguna
            </h3>

            <button onclick="closeEditModal()"
                class="text-gray-400 hover:text-gray-600 bg-gray-50 hover:bg-gray-100 rounded-full p-2 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <form id="form-edit-user" method="POST" class="space-y-[16px]">
            @csrf
            @method('PUT')

            <input type="hidden" id="edit_user_id">

            <div>
                <label class="block text-[13px] font-semibold text-gray-700 mb-[8px]">
                    Nama Pengguna
                </label>

                <input
                    type="text"
                    name="username"
                    id="edit_username"
                    required
                    placeholder="Masukkan nama lengkap..."
                    class="w-full px-[16px] py-[12px] bg-[#F9F9FC] border border-[#D7D7D7] rounded-[12px] outline-none focus:ring-2 focus:ring-[#6155F5] focus:border-[#6155F5] transition-all text-[14px]">
            </div>

            <div>
                <label class="block text-[13px] font-semibold text-gray-700 mb-[8px]">
                    Email Address
                </label>

                <input
                    type="email"
                    name="email"
                    id="edit_email"
                    required
                    placeholder="nama@email.com"
                    class="w-full px-[16px] py-[12px] bg-[#F9F9FC] border border-[#D7D7D7] rounded-[12px] outline-none focus:ring-2 focus:ring-[#6155F5] focus:border-[#6155F5] transition-all text-[14px]">
            </div>

            <div>
                <label class="block text-[13px] font-semibold text-gray-700 mb-[8px]">
                    Kata Sandi Baru
                </label>

                <input
                    type="password"
                    name="password"
                    placeholder="Kosongkan jika tidak diubah"
                    class="w-full px-[16px] py-[12px] bg-[#F9F9FC] border border-[#D7D7D7] rounded-[12px] outline-none focus:ring-2 focus:ring-[#6155F5] focus:border-[#6155F5] transition-all text-[14px]">
            </div>

            <div>
                <label class="block text-[13px] font-semibold text-gray-700 mb-[8px]">
                    System Role
                </label>

                <select
                    name="role"
                    id="edit_role"
                    class="w-full px-[16px] py-[12px] bg-[#F9F9FC] border border-[#D7D7D7] rounded-[12px] outline-none focus:ring-2 focus:ring-[#6155F5] focus:border-[#6155F5] transition-all text-[14px]">

                    <option value="user">Mahasiswa (User)</option>
                    <option value="dosen">Dosen</option>
                    <option value="admin">Admin</option>

                </select>
            </div>

            <div class="flex gap-[12px] pt-[16px]">
                <button
                    type="button"
                    onclick="closeEditModal()"
                    class="flex-1 py-[12px] bg-gray-100 text-gray-600 rounded-[12px] font-semibold hover:bg-gray-200 transition-colors">

                    Batal

                </button>

                <button
                    type="submit"
                    class="flex-1 py-[12px] bg-[#6155F5] text-white rounded-[12px] font-semibold hover:bg-[#5246e5] shadow-lg shadow-indigo-100 transition-all">

                    Simpan Perubahan

                </button>
            </div>

        </form>

    </div>
</div>

    {{-- MODAL HAPUS (Tetap Sama) --}}
    <div id="modal-delete" class="fixed inset-0 z-[100] hidden items-center justify-center bg-gray-900/40 backdrop-blur-sm px-4 transition-opacity">
        <div class="bg-white rounded-[24px] w-full max-w-[400px] p-[32px] shadow-2xl text-center">
            
            <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </div>
            
            <h3 class="text-[20px] font-bold text-gray-800 mb-2">Hapus Pengguna</h3>
            <p class="text-[14px] text-gray-500 mb-8">Apakah Anda yakin ingin menghapus data pengguna ini? Tindakan ini tidak dapat dibatalkan.</p>
            
            <div class="flex gap-[12px]">
                <button type="button" onclick="closeDeleteModal()" class="flex-1 py-[12px] bg-gray-100 text-gray-600 rounded-[12px] font-semibold hover:bg-gray-200 transition-colors">Batal</button>
                <button type="button" onclick="submitDeleteUser()" class="flex-1 py-[12px] bg-red-600 text-white rounded-[12px] font-semibold hover:bg-red-700 shadow-lg shadow-red-100 transition-all">Ya, Hapus</button>
            </div>
        </div>
    </div>

    <form id="form-delete-user" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <script>
        // Logika Modal Tambah
        function toggleModal(id) {
            const modal = document.getElementById(id);
            modal.classList.toggle('hidden');
            modal.classList.toggle('flex');
        }

        // Logika Modal Hapus
        function openDeleteModal(userId) {
            const modal = document.getElementById('modal-delete');
            const form = document.getElementById('form-delete-user');
            
            form.action = `/admin/users/${userId}`;
            
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('modal-delete');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function submitDeleteUser() {
            document.getElementById('form-delete-user').submit();
        }

        // Menutup modal jika klik di luar area card (backdrop)
        window.onclick = function(event) {
            const modalAdd = document.getElementById('modal-add');
            const modalEdit = document.getElementById('modal-edit');
            const modalDelete = document.getElementById('modal-delete');
            
            if (event.target == modalAdd) {
                toggleModal('modal-add');
            }
            if (event.target == modalDelete) {
                closeDeleteModal();
            }
            if (event.target == modalEdit) {
                closeEditModal();
            }
        }

        function editUser(id, name, email, role) {

    document.getElementById('edit_user_id').value = id;
    document.getElementById('edit_username').value = name;
    document.getElementById('edit_email').value = email;
    document.getElementById('edit_role').value = role;

    document.getElementById('form-edit-user').action =
        `/admin/users/${id}`;

    const modal = document.getElementById('modal-edit');

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeEditModal() {
    const modal = document.getElementById('modal-edit');

    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
    </script>
</x-layout.app_>