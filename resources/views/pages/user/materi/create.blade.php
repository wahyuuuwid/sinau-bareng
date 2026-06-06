<x-layout.app_user title="Unggah Materi - Sinau Bareng" class="bg-[#E5E5E5]">
    <main class="flex-1">
        <h1 class="text-3xl font-bold text-black mb-10">Materi > Unggah Materi</h1>

        {{-- CSS Custom untuk Tom Select agar Premium --}}
        <style>
            .ts-wrapper.single .ts-control {
                background-color: #ffffff;
                border: 1px solid transparent;
                border-radius: 0.5rem;
                padding: 0.75rem 1rem;
                font-weight: 600;
                color: #4b5563;
                box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
                transition: all 0.2s;
            }
            .ts-wrapper.single.focus .ts-control {
                border-color: #6155F5;
                box-shadow: 0 0 0 3px rgba(97, 85, 245, 0.15);
            }
            .ts-wrapper.single .ts-control::after {
                border-color: #6155F5 transparent transparent transparent;
                right: 15px;
            }
            .ts-wrapper.single.input-active .ts-control::after {
                border-color: transparent transparent #6155F5 transparent;
            }
            .ts-dropdown {
                border-radius: 0.5rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                border: 1px solid #f3f4f6;
                margin-top: 4px;
            }
            .ts-dropdown .active {
                background-color: #6155F5;
                color: #ffffff;
            }
        </style>

        {{-- Error Validation Alert --}}
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-xl mb-4 text-sm font-bold flex items-start gap-2 shadow-md">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('materi.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
            @csrf

            <div class="max-w-4xl space-y-6">
                {{-- FILE UPLOAD SECTION --}}
                <div class="bg-white p-8 rounded-2xl shadow-sm flex gap-8 items-center border border-gray-100">
                    <div class="text-center">
                        <label class="block bg-gray-200 px-10 py-2 rounded-lg font-bold cursor-pointer hover:bg-gray-300 transition-colors">
                            Upload File
                            <input type="file" name="file_materi" id="file_materi" class="hidden" accept=".pdf,.docx,.txt" required>
                        </label>
                        <span class="text-[10px] text-red-500 font-bold mt-2 block uppercase">pdf/docx/txt maks 20 MB</span>
                        <span id="upload_error" class="text-[11px] text-red-600 font-bold mt-2 block hidden max-w-[200px] leading-tight text-left"></span>
                    </div>
                    
                    <div id="file_preview" class="hidden items-center gap-3 border-2 border-dashed border-[#6155F5] rounded-xl p-3 pr-10 relative bg-indigo-50">
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

                {{-- FORM INPUT SECTION --}}
                <div class="space-y-4">
                    {{-- DROPDOWN MATA KULIAH --}}
                    <div class="flex items-center gap-4">
                        <label class="w-40 font-bold text-sm text-gray-700">Mata Kuliah<span class="text-red-500">*</span> :</label>
                        <div class="flex-1">
                            <select name="mata_kuliah_id" id="mata_kuliah_id" required>
                                <option value=""></option>
                                @foreach($listMataKuliah as $mk)
                                    <option value="{{ $mk->id }}">{{ $mk->nama_mk }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- DROPDOWN DOSEN PENGAMPU --}}
                    <div class="flex items-center gap-4">
                        <label class="w-40 font-bold text-sm text-gray-700">Dosen Pengampu<span class="text-red-500">*</span> :</label>
                        <div class="flex-1">
                            <select name="dosen_id" id="dosen_id" required>
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    
                    {{-- INPUT JUDUL MATERI --}}
                    <div class="flex items-center gap-4">
                        <label class="w-40 font-bold text-sm text-gray-700">Judul Materi<span class="text-red-500">*</span> :</label>
                        <input type="text" name="judul_materi" placeholder="Contoh: 02 Store Management atau Modul Praktikum" required
                            class="flex-1 bg-white p-3 rounded-lg shadow-sm border border-transparent focus:border-[#6155F5] outline-none font-semibold text-gray-600 transition-all">
                    </div>

                    {{-- TEXTAREA DESKRIPSI --}}
                    <div class="flex items-start gap-4">
                        <label class="w-40 font-bold text-sm mt-3 text-gray-700">Deskripsi <span class="text-xs text-gray-400 font-normal">(opsional)</span> :</label>
                        <textarea name="deskripsi" placeholder="Tambahkan deskripsi singkat mengenai materi ini..."
                            class="flex-1 bg-white p-4 rounded-lg shadow-sm border border-transparent focus:border-[#6155F5] outline-none font-semibold text-gray-600 h-32 transition-all"></textarea>
                    </div>
                </div>

                {{-- BUTTON SUBMIT --}}
                <button type="submit" class="w-full bg-[#6155F5] text-white py-4 rounded-2xl font-bold flex items-center justify-center gap-3 shadow-lg hover:bg-[#4f44d8] transition-all active:scale-[0.98]">
                    Kirim
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </button>
            </div>
        </form>
    </main>
</x-layout.app_user>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- DATA FROM BACKEND ---
        const listMataKuliah = @json($listMataKuliah);

        // --- TOM SELECT INITIALIZATION ---
        const mkSelect = new TomSelect('#mata_kuliah_id', {
            create: false,
            placeholder: 'Cari & Pilih Mata Kuliah...',
            allowEmptyOption: false
        });

        const dosenSelect = new TomSelect('#dosen_id', {
            create: false,
            placeholder: 'Pilih Dosen Pengampu...',
            valueField: 'value',
            labelField: 'text',
            searchField: ['text'],
            allowEmptyOption: false
        });

        // Dynamic Filtering Dosen based on Mata Kuliah selection
        mkSelect.on('change', function(mkId) {
            dosenSelect.clear();
            dosenSelect.clearOptions();
            
            if (mkId) {
                const selectedMk = listMataKuliah.find(mk => mk.id == mkId);
                if (selectedMk && selectedMk.dosens) {
                    const options = selectedMk.dosens.map(dosen => ({
                        value: dosen.id,
                        text: dosen.username
                    }));
                    dosenSelect.addOptions(options);
                }
            }
        });

        // --- FILE PREVIEW LOGIC ---
        const fileInput = document.getElementById('file_materi');
        const filePreview = document.getElementById('file_preview');
        const fileNameDisplay = document.getElementById('file_name');
        const fileSizeDisplay = document.getElementById('file_size');
        const removeBtn = document.getElementById('remove_file');
        const uploadError = document.getElementById('upload_error');

        fileInput.addEventListener('change', function() {
            uploadError.classList.add('hidden');
            uploadError.innerText = '';

            if (this.files && this.files[0]) {
                const file = this.files[0];
                const maxSizeBytes = 20 * 1024 * 1024; // 20MB limit
                if (file.size > maxSizeBytes) {
                    uploadError.innerText = 'Ukuran file (' + (file.size / (1024 * 1024)).toFixed(2) + ' MB) melebihi batas upload server (20 MB). Harap unggah file yang lebih kecil.';
                    uploadError.classList.remove('hidden');
                    fileInput.value = ""; 
                    filePreview.classList.add('hidden');
                    return;
                }

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
            uploadError.classList.add('hidden');
            uploadError.innerText = '';
        });

        // Foolproof submit validation
        const uploadForm = document.getElementById('uploadForm');
        uploadForm.addEventListener('submit', function(e) {
            if (fileInput.files && fileInput.files[0]) {
                const file = fileInput.files[0];
                const maxSizeBytes = 20 * 1024 * 1024; // 20MB
                if (file.size > maxSizeBytes) {
                    e.preventDefault();
                    uploadError.innerText = 'Ukuran file (' + (file.size / (1024 * 1024)).toFixed(2) + ' MB) melebihi batas upload server (20 MB). Pengiriman dibatalkan!';
                    uploadError.classList.remove('hidden');
                    return false;
                }
            }
        });
    });
</script>