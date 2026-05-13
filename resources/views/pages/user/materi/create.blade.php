<x-layout.app title="Materi > Unggah Materi">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
    </style>

    <div class="min-h-screen bg-[#ECECEC] font-['Inter'] flex w-full overflow-x-hidden">

        <x-layout.sidebar_user />

        <main class="flex-1 relative pt-[32px] px-[24px] pb-[40px] min-w-0 flex flex-col">
            
            <x-layout.navbar_user />

            <div class="flex-1 max-w-[800px] w-full mx-auto mt-[32px]">
                
                <h1 class="text-[28px] font-bold text-[#000000] mb-[32px]">Materi > Unggah Materi</h1>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-600 rounded-xl">
                        <ul class="list-disc pl-5 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('materi.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-8">
                    @csrf
                    
                    <div class="bg-white p-[32px] rounded-[16px] shadow-sm flex flex-col gap-4 border border-gray-200">
                        <div class="relative w-fit">
                            <input type="file" name="file_materi" id="file_materi" required accept=".pdf,.doc,.docx,.txt,.ppt,.pptx" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="updateFileName(this)">
                            <div class="bg-[#EAEAEA] hover:bg-[#DCDCDC] text-gray-800 font-semibold py-[12px] px-[24px] rounded-[8px] text-center transition-colors">
                                Upload File
                            </div>
                        </div>
                        <p id="file-name-display" class="text-[12px] font-bold text-[#FF0000] uppercase tracking-wide">
                            PDF/DOCX/TXT MAKS 20 MB
                        </p>
                    </div>

                    <div class="flex flex-col gap-6">
                        
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-2 md:gap-4 items-start">
                            <label for="mata_kuliah" class="md:col-span-3 text-[15px] font-bold text-gray-800 pt-3">
                                Mata Kuliah<span class="text-red-500">*</span> :
                            </label>
                            <div class="md:col-span-9">
                                <input type="text" name="mata_kuliah" id="mata_kuliah" required placeholder="Contoh: Sistem Operasi" value="{{ old('mata_kuliah') }}"
                                       class="w-full bg-white border border-gray-200 rounded-[12px] px-[16px] py-[14px] text-[14px] text-gray-700 outline-none focus:border-[#6155F5] focus:ring-2 focus:ring-indigo-100 transition-all shadow-sm">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-12 gap-2 md:gap-4 items-start">
                            <label for="judul" class="md:col-span-3 text-[15px] font-bold text-gray-800 pt-3">
                                Judul Materi<span class="text-red-500">*</span> :
                            </label>
                            <div class="md:col-span-9">
                                <input type="text" name="judul" id="judul" required placeholder="Contoh: 02 Store Management" value="{{ old('judul') }}"
                                       class="w-full bg-white border border-gray-200 rounded-[12px] px-[16px] py-[14px] text-[14px] text-gray-700 outline-none focus:border-[#6155F5] focus:ring-2 focus:ring-indigo-100 transition-all shadow-sm">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-12 gap-2 md:gap-4 items-start">
                            <label for="deskripsi" class="md:col-span-3 text-[15px] font-bold text-gray-800 pt-3">
                                Deskripsi <span class="text-gray-400 font-normal text-sm">(opsional)</span> :
                            </label>
                            <div class="md:col-span-9">
                                <textarea name="deskripsi" id="deskripsi" rows="5" placeholder="Tambahkan deskripsi singkat mengenai materi ini..."
                                          class="w-full bg-white border border-gray-200 rounded-[12px] px-[16px] py-[14px] text-[14px] text-gray-700 outline-none focus:border-[#6155F5] focus:ring-2 focus:ring-indigo-100 transition-all shadow-sm resize-y">{{ old('deskripsi') }}</textarea>
                            </div>
                        </div>

                    </div>

                    <div class="flex justify-end mt-4">
                        <button type="submit" class="bg-[#6155F5] hover:bg-indigo-700 text-white font-bold py-[14px] px-[32px] rounded-[12px] shadow-lg shadow-indigo-200 transition-all">
                            Unggah Materi
                        </button>
                    </div>

                </form>

            </div>
        </main>
    </div>

    <script>
        function updateFileName(input) {
            const displayElement = document.getElementById('file-name-display');
            if (input.files && input.files.length > 0) {
                displayElement.innerText = "File terpilih: " + input.files[0].name;
                displayElement.classList.remove('text-[#FF0000]');
                displayElement.classList.add('text-emerald-600');
            } else {
                displayElement.innerText = "PDF/DOCX/TXT MAKS 20 MB";
                displayElement.classList.remove('text-emerald-600');
                displayElement.classList.add('text-[#FF0000]');
            }
        }
    </script>

</x-layout.app>