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
                    <div class="prose max-w-none text-gray-800 font-medium">
                        <div class="bg-indigo-50 p-6 rounded-2xl border border-indigo-100 whitespace-pre-wrap">
                            {{ session('hasil_soal') }}
                        </div>
                    </div>
                @elseif(session('error'))
                    <div class="flex items-center justify-center h-full text-red-500 font-bold">
                        {{ session('error') }}
                    </div>
                @else
                    <div class="flex items-center justify-center h-full text-center">
                        <div>
                            <div class="text-gray-300 mb-4">
                                <svg class="w-20 h-20 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0012 18.75c-1.03 0-1.9-.4-2.593-1.003l-.548-.547z"></path>
                                </svg>
                            </div>
                            <p class="text-gray-400 font-medium">Belum ada soal yang digenerate. Mulai dengan pilih file dan klik Generate!</p>
                        </div>
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