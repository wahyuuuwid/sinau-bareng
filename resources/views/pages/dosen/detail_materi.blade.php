@extends('components.layout.app')

@section('content')
<div class="flex min-h-screen bg-[#F4F4F4]">
    <x-layout.sidebar_dosen />

    <main class="flex-1 p-8">
        <x-layout.navbar_dosen />

        <nav class="text-sm font-medium text-gray-500 mb-6">
            Dashboard > Validasi Materi > <span class="text-gray-800">Detail</span>
        </nav>

        <div class="bg-white rounded-2xl shadow-sm p-10 border-2 border-[#3B82F6]">
            <h3 class="text-xl font-bold text-gray-800 mb-8 border-b pb-4">Detail Materi</h3>

            <form action="{{ route('dosen.materi.update', $materi->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-2 gap-x-12 gap-y-6">
                    {{-- Judul --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2 italic">Judul Materi</label>
                        <input type="text" value="{{ $materi->judul_materi }}" disabled class="w-full bg-gray-50 border border-gray-300 p-3 rounded-lg text-gray-500 font-medium">
                    </div>

                    {{-- Mata Kuliah --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2 italic">Mata Kuliah</label>
                        <input type="text" value="{{ $materi->mataKuliah->nama_mk }}" disabled class="w-full bg-gray-50 border border-gray-300 p-3 rounded-lg text-gray-500 font-medium">
                    </div>

                    {{-- Jenis Konten --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2 italic">Jenis Konten</label>
                        <input type="text" value="Materi" disabled class="w-full bg-gray-50 border border-gray-300 p-3 rounded-lg text-gray-500 font-medium">
                    </div>

                    {{-- Uploader --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2 italic">Nama Uploader</label>
                        <input type="text" value="{{ $materi->user->username }}" disabled class="w-full bg-gray-50 border border-gray-300 p-3 rounded-lg text-gray-500 font-medium">
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2 italic text-[#6155F5]">Status</label>
                        <select name="status" class="w-full bg-white border-2 border-[#6155F5] p-3 rounded-lg font-bold text-gray-700 focus:outline-none cursor-pointer">
                            <option value="pending" {{ $materi->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ $materi->status == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ $materi->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>

                    {{-- Tanggal --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2 italic">Tanggal Upload</label>
                        <input type="text" value="{{ $materi->created_at->format('d/m/Y') }}" disabled class="w-full bg-gray-50 border border-gray-300 p-3 rounded-lg text-gray-500 font-medium">
                    </div>

                    {{-- File Materi --}}
                    <div class="col-span-2 flex items-end gap-4 mt-4">
                        <div class="flex-1">
                            <label class="block text-sm font-bold text-gray-700 mb-2 italic">File Materi</label>
                            <input type="text" value="{{ basename($materi->file_path) }}" disabled class="w-full bg-gray-50 border border-gray-300 p-3 rounded-lg text-gray-500 font-medium italic">
                        </div>
                        <a href="{{ asset('storage/' . $materi->file_path) }}" target="_blank" class="px-6 py-3 bg-gray-200 text-gray-700 font-bold rounded-full hover:bg-gray-300 transition-all">Preview</a>
                        <a href="{{ asset('storage/' . $materi->file_path) }}" download class="px-6 py-3 bg-gray-200 text-gray-700 font-bold rounded-full hover:bg-gray-300 transition-all">Download</a>
                    </div>
                </div>

                <div class="flex justify-end gap-4 mt-12">
                    <a href="{{ route('dosen.validasi') }}" class="px-10 py-2.5 bg-gray-200 text-gray-700 font-bold rounded-full hover:bg-gray-300 transition-all">Kembali</a>
                    <button type="submit" class="px-10 py-2.5 bg-[#6155F5] text-white font-bold rounded-full hover:bg-[#4e44d4] shadow-md transition-all">Simpan</button>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection