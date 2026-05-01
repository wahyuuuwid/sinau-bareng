<x-layout.app_user title="Unggah Materi - Sinau Bareng" class="bg-[#E5E5E5]">
    <style>
        /* Slicing UI: Menyamakan Tom Select dengan input Judul/Deskripsi */
        .ts-control {
            border: none !important;
            padding: 12px !important; /* Menyesuaikan p-3 */
            border-radius: 0.5rem !important; /* Menyesuaikan rounded-lg */
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important; /* Menyesuaikan shadow-sm */
            font-weight: 600 !important; /* Menyesuaikan font-semibold */
            color: #4b5563 !important; /* Menyesuaikan text-gray-600 */
        }

        .ts-wrapper.focus .ts-control {
            outline: none !important;
            box-shadow: 0 0 0 2px #6155F5 !important; /* Menyesuaikan focus:border-[#6155F5] */
        }

        .ts-control input::placeholder {
            color: #9ca3af !important; /* Menyesuaikan placeholder gray-400 */
            font-weight: 600 !important;
        }

        /* Menghilangkan border default pembungkus */
        .ts-wrapper .ts-control {
            border: 1px solid transparent !important;
        }
    </style>

    <main class="flex-1">
        <h1 class="text-3xl font-bold text-black mb-10">Materi > Unggah Materi</h1>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-3 rounded-lg mb-4 text-sm font-bold">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>⚠ {{ $error }}</li>
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
                        <div class="flex-1">
                            <select name="mata_kuliah_id" id="mata_kuliah_id" required placeholder="Cari Mata Kuliah...">
                                <option value="" disabled selected>Cari Mata Kuliah...</option>
                                @foreach($mataKuliah as $mk)
                                    <option value="{{ $mk->id }}">{{ $mk->nama_mk }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- DROPDOWN DOSEN PENGAMPU --}}
                    <div class="flex items-center gap-4">
                        <label class="w-40 font-bold text-sm text-gray-700">Dosen Pengampu<span class="text-red-500">*</span> :</label>
                        <div class="flex-1">
                            <select name="dosen_id" id="dosen_id" required placeholder="Pilih Mata Kuliah terlebih dahulu">
                                <option value="" disabled selected>Pilih Mata Kuliah terlebih dahulu</option>
                            </select>
                        </div>
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

                <!-- <button type="button" onclick="window.location.href='/student/dashboard'"
                class="mt-12 bg-white px-8 py-2 rounded-lg shadow-sm flex items-center gap-3 font-bold text-sm hover:bg-gray-50 transition-all border border-gray-100 text-gray-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali
                </button> -->
            </div>
        </form>
    </main>
</x-layout.app_user>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tsMK = new TomSelect("#mata_kuliah_id", {
            create: false,
            sortField: { field: "text", direction: "asc" }
        });

        const tsDosen = new TomSelect("#dosen_id", {
            create: false,
            sortField: { field: "text", direction: "asc" }
        });
        tsDosen.disable();

        // --- FILE PREVIEW LOGIC ---
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

        // --- DEPENDENT DROPDOWN ---
        tsMK.on('change', function(value) {
            if (!value) return;

            tsDosen.clear();
            tsDosen.clearOptions();
            tsDosen.setTextboxValue('Sedang mencari dosen...');

            fetch(`/get-dosen/${value}`)
                .then(response => response.json())
                .then(data => {
                    tsDosen.clearOptions();
                    if(data.length > 0) {
                        data.forEach(dosen => {
                            tsDosen.addOption({value: dosen.id, text: dosen.username});
                        });
                        tsDosen.enable();
                        tsDosen.setTextboxValue('');
                    } else {
                        tsDosen.disable();
                        tsDosen.setTextboxValue('Belum ada dosen untuk MK ini');
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });
</script>