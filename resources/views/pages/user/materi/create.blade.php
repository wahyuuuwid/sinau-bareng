<x-layout.app_user title="Upload Materi - Sinau Bareng" class="bg-slate-100">
    <main class="max-w-7xl mx-auto py-2 px-4">

        <div class="mb-8">
            <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
                <span>Materi</span>
                <span>/</span>
                <span class="font-semibold text-[#6155F5]">
                    Upload Materi
                </span>
            </div>

            <h1 class="text-3xl font-bold text-slate-900">
                Upload Materi Pembelajaran
            </h1>

            <p class="text-slate-500 mt-2">
                Bagikan materi kuliah kepada mahasiswa dengan mudah dan cepat.
            </p>
        </div>

        {{-- ERROR --}}
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 rounded-2xl p-4 mb-6">
                <div class="font-semibold mb-2">
                    Terjadi Kesalahan
                </div>

                <ul class="list-disc list-inside space-y-1 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('materi.store') }}"
            method="POST"
            enctype="multipart/form-data"
            id="uploadForm">

            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

                {{-- KOLOM KIRI --}}
                <div class="lg:col-span-2">

                    <div
                        class="bg-white rounded-3xl border border-slate-200 shadow-sm p-8 sticky top-6">

                        <h2 class="text-lg font-bold mb-6">
                            File Materi
                        </h2>

                        <label
                            for="file_materi"
                            class="cursor-pointer block border-2 border-dashed border-[#6155F5]/30 rounded-3xl p-10 text-center hover:border-[#6155F5] hover:bg-indigo-50 transition-all">

                            <div
                                class="w-20 h-20 mx-auto rounded-2xl bg-[#6155F5]/10 flex items-center justify-center text-4xl mb-4">
                                📄
                            </div>

                            <h3 class="font-bold text-lg text-slate-800">
                                Upload File Materi
                            </h3>

                            <p class="text-slate-500 mt-2">
                                Klik untuk memilih file
                            </p>

                            <span
                                class="inline-block mt-4 text-xs bg-slate-100 px-3 py-2 rounded-xl text-slate-500">
                                PDF • DOCX • TXT • Maks 20 MB
                            </span>

                            <input
                                type="file"
                                id="file_materi"
                                name="file_materi"
                                class="hidden"
                                accept=".pdf,.doc,.docx,.txt"
                                required>
                        </label>

                        {{-- FILE PREVIEW --}}
                        <div
                            id="file_preview"
                            class="hidden mt-6 bg-indigo-50 border border-indigo-200 rounded-2xl p-4">

                            <div class="flex items-center gap-4">

                                <div
                                    id="file_icon"
                                    class="w-12 h-12 bg-[#6155F5] text-white rounded-xl flex items-center justify-center text-lg">
                                    📄
                                </div>

                                <div class="flex-1">
                                    <div
                                        id="file_name"
                                        class="font-semibold text-slate-800 break-all">
                                    </div>

                                    <div
                                        id="file_size"
                                        class="text-sm text-slate-500">
                                    </div>
                                </div>

                                <button
                                    type="button"
                                    id="remove_file"
                                    class="text-red-500 hover:text-red-700 font-semibold">
                                    Hapus
                                </button>

                            </div>

                        </div>

                        <div
                            id="upload_error"
                            class="hidden mt-4 text-sm text-red-600 font-medium">
                        </div>

                    </div>

                </div>

                {{-- KOLOM KANAN --}}
                <div class="lg:col-span-3">

                    <div
                        class="bg-white rounded-3xl border border-slate-200 shadow-sm p-8">

                        <h2 class="text-lg font-bold mb-6">
                            Informasi Materi
                        </h2>

                        <div class="space-y-5">

                            {{-- MATA KULIAH --}}
                            <div>
                                <label class="block mb-2 font-semibold text-slate-700">
                                    Mata Kuliah
                                    <span class="text-red-500">*</span>
                                </label>

                                <select
                                    name="mata_kuliah_id"
                                    id="mata_kuliah_id"
                                    required>

                                    <option value=""></option>

                                    @foreach($listMataKuliah as $mk)
                                        <option value="{{ $mk->id }}">
                                            {{ $mk->nama_mk }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>

                            {{-- DOSEN --}}
                            <div>
                                <label class="block mb-2 font-semibold text-slate-700">
                                    Dosen Pengampu
                                    <span class="text-red-500">*</span>
                                </label>

                                <select
                                    name="dosen_id"
                                    id="dosen_id"
                                    required>
                                    <option value=""></option>
                                </select>
                            </div>

                            {{-- JUDUL --}}
                            <div>
                                <label class="block mb-2 font-semibold text-slate-700">
                                    Judul Materi
                                    <span class="text-red-500">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="judul_materi"
                                    name="judul_materi"
                                    required
                                    placeholder="Contoh: Modul Praktikum Basis Data"
                                    class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:ring-4 focus:ring-[#6155F5]/10 focus:border-[#6155F5] outline-none">
                            </div>

                            {{-- DESKRIPSI --}}
                            <div>
                                <label class="block mb-2 font-semibold text-slate-700">
                                    Deskripsi
                                </label>

                                <textarea
                                    name="deskripsi"
                                    rows="6"
                                    placeholder="Tambahkan deskripsi singkat..."
                                    class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:ring-4 focus:ring-[#6155F5]/10 focus:border-[#6155F5] outline-none"></textarea>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- BUTTON --}}
            <div class="mt-8">
                <button
                    type="submit"
                    class="w-full bg-[#6155F5] hover:bg-[#4f44d8] text-white py-4 rounded-2xl font-bold shadow-lg shadow-indigo-200 transition-all">

                    Simpan Materi
                </button>
            </div>

        </form>

    </main>
</x-layout.app_user>

<style>
.ts-wrapper.single .ts-control {
    border-radius: 12px !important;
    border: 1px solid #e2e8f0 !important;
    min-height: 48px;
    padding: 10px 14px;
    box-shadow: none;
}

.ts-wrapper.focus .ts-control {
    border-color: #6155F5 !important;
    box-shadow: 0 0 0 4px rgba(97,85,245,.1) !important;
}

.ts-dropdown {
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #e2e8f0;
}

.ts-dropdown .active {
    background: #6155F5 !important;
    color: white !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {

    const listMataKuliah = @json($listMataKuliah);

    const mkSelect = new TomSelect('#mata_kuliah_id', {
        create: false,
        placeholder: 'Pilih Mata Kuliah'
    });

    const dosenSelect = new TomSelect('#dosen_id', {
        create: false,
        placeholder: 'Pilih Dosen Pengampu',
        valueField: 'value',
        labelField: 'text',
        searchField: ['text']
    });

    mkSelect.on('change', function(mkId) {

        dosenSelect.clear();
        dosenSelect.clearOptions();

        const selectedMk = listMataKuliah.find(
            mk => mk.id == mkId
        );

        if (selectedMk && selectedMk.dosens) {

            dosenSelect.addOptions(
                selectedMk.dosens.map(dosen => ({
                    value: dosen.id,
                    text: dosen.username
                }))
            );
        }
    });

    const fileInput = document.getElementById('file_materi');
    const filePreview = document.getElementById('file_preview');
    const fileName = document.getElementById('file_name');
    const fileSize = document.getElementById('file_size');
    const removeBtn = document.getElementById('remove_file');
    const uploadError = document.getElementById('upload_error');
    const judulInput = document.getElementById('judul_materi');
    const fileIcon = document.getElementById('file_icon');

    fileInput.addEventListener('change', function() {

        uploadError.classList.add('hidden');

        if (!this.files.length) return;

        const file = this.files[0];

        if (file.size > 20 * 1024 * 1024) {

            uploadError.innerHTML =
                'Ukuran file melebihi batas 20 MB';

            uploadError.classList.remove('hidden');

            this.value = '';

            return;
        }

        fileName.innerHTML = file.name;

        fileSize.innerHTML =
            (file.size / 1024 / 1024).toFixed(2) + ' MB';

        const extension =
            file.name.split('.').pop().toLowerCase();

        if (extension === 'pdf') {
            fileIcon.innerHTML = '📕';
        } else if (
            extension === 'doc' ||
            extension === 'docx'
        ) {
            fileIcon.innerHTML = '📘';
        } else {
            fileIcon.innerHTML = '📄';
        }

        if (!judulInput.value) {
            judulInput.value =
                file.name.replace(/\.[^/.]+$/, "");
        }

        filePreview.classList.remove('hidden');
    });

    removeBtn.addEventListener('click', () => {

        fileInput.value = '';

        filePreview.classList.add('hidden');

        uploadError.classList.add('hidden');
    });

});
</script>