@php
    $title = "Generate Soal";
@endphp

@extends('components.layout.app')

@section('content')
<div class="flex min-h-screen bg-[#f3f4f6]">
    
    @include('components.layout.sidebar_user')

    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        
        <div class="p-8 h-full flex flex-col">
            <h1 class="text-4xl font-bold text-gray-800 mb-8">Generate Soal</h1>

            {{-- BOX HASIL GENERATE --}}
            <div class="flex-1 bg-white rounded-[32px] shadow-sm p-8 mb-6 border border-gray-100 overflow-y-auto">
                @if(session('hasil_soal'))
                    <div class="prose max-w-none">
                        {{-- INI CARA 1: Pakai Class Tailwind (Paling Rapi) --}}
                        <div class="bg-indigo-50 p-6 rounded-2xl border border-indigo-100 text-gray-800 font-medium whitespace-pre-line break-words text-left leading-relaxed">
                            {{ session('hasil_soal') }}
                        </div>
                    </div>
                @elseif(session('error'))
                    <div class="flex items-center justify-center h-full text-red-500 font-bold">
                        {{ session('error') }}
                    </div>
                @else
                    <div class="flex items-center justify-center h-full text-center">
                        {{-- ... (kode icon lampu/belom ada soal tetap di sini) ... --}}
                        <p class="text-gray-400 font-medium">Belum ada soal. Yuk, upload PDF materi kamu!</p>
                    </div>
                @endif
            </div>

            {{-- FORM INPUT --}}
            <form action="{{ route('soal.generate') }}" method="POST" enctype="multipart/form-data" id="formGenerate">
                @csrf
                <div class="flex items-end gap-4 bg-transparent">
                    
                    <div class="flex gap-3">
                        {{-- INPUT FILE --}}
                        <div class="bg-white p-4 rounded-3xl shadow-sm border border-gray-100 text-center min-w-[120px]">
                            <label class="cursor-pointer">
                                <span id="file_label" class="block bg-gray-100 text-gray-700 px-3 py-1.5 rounded-xl text-xs font-bold mb-1">Pilih File</span>
                                <span class="text-[9px] text-red-400 font-medium uppercase">pdf max 10MB</span>
                                <input type="file" name="file_materi" id="input_file" class="hidden" accept=".pdf" required>
                            </label>
                        </div>

                        {{-- CHECKBOX JENIS SOAL --}}
                        <div class="bg-white p-4 rounded-3xl shadow-sm border border-gray-100 min-w-[140px]">
                            <span class="block text-[10px] font-bold text-gray-500 mb-2 uppercase tracking-wider">Jenis Soal:</span>
                            <div class="text-[11px] space-y-1.5 font-semibold text-gray-700">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="jenis_soal[]" value="Pilihan Ganda" checked class="rounded text-indigo-600 focus:ring-indigo-500"> Pilihan Ganda
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="jenis_soal[]" value="Benar / Salah" class="rounded text-indigo-600 focus:ring-indigo-500"> Benar / Salah
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="jenis_soal[]" value="Isian Singkat" class="rounded text-indigo-600 focus:ring-indigo-500"> Isian Singkat
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- INPUT PERINTAH TAMBAHAN --}}
                    <div class="flex-1 flex items-center bg-white rounded-[28px] border border-gray-200 px-6 py-4 shadow-sm focus-within:border-indigo-300 transition-all">
                        <input type="text" name="perintah_tambahan" placeholder="Contoh: Buatkan 2 soal mengenai UI/UX..." class="flex-1 px-2 outline-none text-gray-700 placeholder-gray-400 font-medium bg-transparent">
                    </div>

                    {{-- BUTTON GENERATE --}}
                    <button type="submit" id="btnSubmit" class="bg-[#FFC107] hover:bg-[#FFB300] text-black font-extrabold px-10 py-5 rounded-[28px] flex items-center gap-3 shadow-lg transition-all active:scale-95 disabled:opacity-50">
                        <span id="btnText">Generate</span>
                        <svg id="iconFlash" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </button>

                </div>
            </form>
        </div>
    </div>
</div>

{{-- SCRIPT SEDERHANA BUAT UX --}}
<script>
    const fileInput = document.getElementById('input_file');
    const fileLabel = document.getElementById('file_label');
    const form = document.getElementById('formGenerate');
    const btnText = document.getElementById('btnText');
    const btnSubmit = document.getElementById('btnSubmit');

    // Menampilkan nama file kalau sudah dipilih
    fileInput.onchange = () => {
        if(fileInput.files.length > 0) {
            fileLabel.innerText = "File Siap!";
            fileLabel.classList.replace('bg-gray-100', 'bg-green-100');
            fileLabel.classList.add('text-green-700');
        }
    };

    // Animasi Loading pas diklik
    form.onsubmit = () => {
        btnText.innerText = "Mikir...";
        btnSubmit.disabled = true;
        btnSubmit.classList.add('animate-pulse');
    };
</script>
@endsection