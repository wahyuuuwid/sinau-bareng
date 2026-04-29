<x-layout.app_user title="Unggah Materi - Sinau Bareng" class="bg-[#E5E5E5]">
    <main class="flex-1">
        <h1 class="text-3xl font-bold text-black mb-10">Materi > Unggah Materi</h1>

        @if ($errors->has('file_materi'))
            <div class="bg-red-500 text-white p-3 rounded-lg mb-4 text-sm font-bold">
                ⚠ Wah kegedean, size filenya terlalu besar! {{ $errors->first('file_materi') }}
            </div>
        @endif

        <form action="{{ route('materi.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
            @csrf

            <div class="max-w-4xl space-y-6">
                <div class="bg-white p-8 rounded-2xl shadow-sm flex gap-8 items-center border border-gray-100">
                    <div class="text-center">
                        <label class="block bg-gray-200 px-10 py-2 rounded-lg font-bold cursor-pointer hover:bg-gray-300 transition-colors">
                            Upload File
                            <input type="file" name="file_materi" id="file_materi" class="hidden" accept=".pdf,.docx,.txt" required>
                        </label>
                        <span class="text-[10px] text-red-500 font-bold mt-2 block uppercase">pdf/docx/txt maks 20 MB</span>
                    </div>
                    
                    <div id="file_preview" class="hidden flex items-center gap-3 border-2 border-dashed border-[#6155F5] rounded-xl p-3 pr-10 relative bg-indigo-50">
                        <div class="bg-red-500 text-white p-2 rounded-lg font-bold text-xs shadow-sm">FILE</div>
                        <div class="flex flex-col">
                            <span id="file_name" class="text-sm font-bold text-gray-800 truncate max-w-[200px]">Nama_File.pdf</span>
                            <span id="file_size" class="text-[10px] text-gray-500 font-medium">0 KB</span>
                        </div>
                        <button type="button" id="remove_file" class="absolute -top-2 -right-2 bg-black text-white rounded-full w-6 h-6 flex items-center justify-center text-[10px] hover:bg-red-600 transition-all shadow-md">
                            ✕
                        </button>
                    </div>
                </div>

                <div class="space-y-4">
                    {{-- DROPDOWN MATA KULIAH --}}
                    <div class="flex items-center gap-4">
                        <label class="w-40 font-bold text-sm text-gray-700">Mata Kuliah<span class="text-red-500">*</span> :</label>
                        <select name="mata_kuliah_id" id="mata_kuliah_id" required
                            class="flex-1 bg-white p-3 rounded-lg shadow-sm border border-transparent focus:border-[#6155F5] outline-none font-semibold text-gray-600 transition-all cursor-pointer">
                            <option value="" disabled selected>Pilih Mata Kuliah</option>
                            @if(isset($mataKuliah) && $mataKuliah->count() > 0)
                                @foreach($mataKuliah as $mk)
                                    <option value="{{ $mk->id }}">{{ $mk->nama_mk }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    {{-- DROPDOWN DOSEN PENGAMPU --}}
                    <div class="flex items-center gap-4">
                        <label class="w-40 font-bold text-sm text-gray-700">Dosen Pengampu<span class="text-red-500">*</span> :</label>
                        <select name="dosen_id" id="dosen_id" required disabled
                            class="flex-1 bg-gray-100 p-3 rounded-lg shadow-sm border border-transparent focus:border-[#6155F5] outline-none font-semibold text-gray-500 transition-all cursor-not-allowed">
                            <option value="" disabled selected>Pilih Mata Kuliah terlebih dahulu</option>
                        </select>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <label class="w-40 font-bold text-sm text-gray-700">Judul Materi<span class="text-red-500">*</span> :</label>
                        <input type="text" name="judul_materi" placeholder="Contoh: 02 Store Management" required
                            class="flex-1 bg-white p-3 rounded-lg shadow-sm border border-transparent focus:border-[#6155F5] outline-none font-semibold text-gray-600 transition-all">
                    </div>

                    <div class="flex items-start gap-4">
                        <label class="w-40 font-bold text-sm mt-3 text-gray-700">Deskripsi <span class="text-xs text-gray-400 font-normal">(opsional)</span> :</label>
                        <textarea name="deskripsi" placeholder="Tambahkan deskripsi singkat mengenai materi ini..."
                            class="flex-1 bg-white p-4 rounded-lg shadow-sm border border-transparent focus:border-[#6155F5] outline-none font-semibold text-gray-600 h-32 transition-all"></textarea>
                    </div>
                </div>

                <button type="submit" class="w-full bg-[#6155F5] text-white py-4 rounded-2xl font-bold flex items-center justify-center gap-3 shadow-lg hover:bg-[#4f44d8] transition-all active:scale-[0.98]">
                    Kirim
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </button>

                <button type="button" onclick="window.location.href='/materi/saya'"
                class="mt-12 bg-white px-8 py-2 rounded-lg shadow-sm flex items-center gap-3 font-bold text-sm hover:bg-gray-50 transition-all border border-gray-100 text-gray-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali
                </button>
            </div>
        </form>
    </main>
</x-layout.app_user>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // === LOGIKA FILE PREVIEW ===
        const fileInput = document.getElementById('file_materi');
        const filePreview = document.getElementById('file_preview');
        const fileNameDisplay = document.getElementById('file_name');
        const fileSizeDisplay = document.getElementById('file_size');
        const removeBtn = document.getElementById('remove_file');

        fileInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const file = this.files[0];
                fileNameDisplay.innerText = file.name;
                const sizeInKb = (file.size / 1024).toFixed(1);
                fileSizeDisplay.innerText = sizeInKb > 1024 ? (sizeInKb / 1024).toFixed(1) + ' MB' : sizeInKb + ' KB';
                filePreview.classList.remove('hidden');
                filePreview.classList.add('flex');
            }
        });

        removeBtn.addEventListener('click', function() {
            fileInput.value = ""; 
            filePreview.classList.add('hidden');
            filePreview.classList.remove('flex');
        });

        // === LOGIKA DEPENDENT DROPDOWN (Mata Kuliah -> Dosen) ===
        const mkSelect = document.getElementById('mata_kuliah_id');
        const dosenSelect = document.getElementById('dosen_id');

        mkSelect.addEventListener('change', function() {
            const mkId = this.value;

            // Bikin tampilan loading dulu
            dosenSelect.innerHTML = '<option value="" disabled selected>Sedang mencari dosen...</option>';
            dosenSelect.disabled = true;
            dosenSelect.classList.add('bg-gray-100', 'cursor-not-allowed');
            dosenSelect.classList.remove('bg-white', 'cursor-pointer');

            // Ambil data dari API
            fetch(`/get-dosen/${mkId}`)
                .then(response => response.json())
                .then(data => {
                    dosenSelect.innerHTML = '<option value="" disabled selected>-- Pilih Dosen --</option>';
                    
                    if(data.length > 0) {
                        data.forEach(dosen => {
                            // Masukin nama dosen ke dropdown
                            dosenSelect.innerHTML += `<option value="${dosen.id}">${dosen.username}</option>`; 
                        });
                        // Buka dropdown
                        dosenSelect.disabled = false;
                        dosenSelect.classList.remove('bg-gray-100', 'cursor-not-allowed');
                        dosenSelect.classList.add('bg-white', 'cursor-pointer');
                    } else {
                        dosenSelect.innerHTML = '<option value="" disabled selected>Belum ada dosen untuk MK ini</option>';
                    }
                })
                .catch(error => {
                    console.error('Error fetching dosen:', error);
                    dosenSelect.innerHTML = '<option value="" disabled selected>Gagal memuat data dosen</option>';
                });
        });
    });
</script>