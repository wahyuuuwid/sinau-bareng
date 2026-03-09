<header class="fixed top-0 left-0 w-full bg-white/80 backdrop-blur-md border-b border-gray-300 z-50 ">
  <div class="max-w-7xl mx-auto px-4 py-2">
    <div class="flex items-center justify-between h-16 mx-3 md:mx-0">

      <div class="flex items-center gap-16">
        <a href="/" class="inline-flex items-center">
            <img src="{{ asset('images/logo.png') }}" alt="Sinau Bareng Logo" class="h-18 w-18 mr-2" />
        </a>

      </div>

      <div class="hidden md:flex flex-1 max-w-md mx-8">
        <div class="relative w-full">
          <input 
            type="text" 
            placeholder="Cari soal atau materi..." 
            class="w-full px-4 py-2 pl-10 pr-12 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-100 focus:border-transparent"
          />
          <x-heroicon-o-magnifying-glass class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" />
          <button class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-primary-200 text-white px-3 py-1 rounded-md text-sm hover:bg-primary-300 transition">
            Cari
          </button>
        </div>
      </div>

      <div class="hidden md:flex items-center gap-4">
        <div class="relative group">
          <button class="flex items-center gap-1 text-gray-700 hover:text-primary-200 transition px-3 py-2">
            <span>Explore</span>
            <x-heroicon-o-chevron-down class="w-4 h-4" />
          </button>
          <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-100/50 hover:text-primary-200">Bank Soal</a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-100/50 hover:text-primary-200">Materi</a>
            <!-- <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-100/50 hover:text-primary-200">Tryout</a> -->
            
            
          </div>
        </div>

        <a href="#" class="text-gray-700 hover:text-primary-200 transition px-3 py-2">AI Tools</a>
        <!-- <a href="#" class="text-gray-700 hover:text-primary-200 transition px-3 py-2">Upload materi</a> -->
        <a href="#" class="text-gray-700 hover:text-primary-200 transition px-3 py-2">Tentang</a>

        <div class="h-6 w-px bg-gray-300 mx-2"></div>

        <a href="/login" class="text-gray-700 hover:text-primary-200 transition px-3 py-2 font-medium">Masuk</a>
        <a href="/register" class="bg-primary-200 text-white px-4 py-2 rounded-lg hover:bg-primary-300 transition font-medium">
          Daftar Gratis
        </a>
      </div>

      <button
        id="menu-btn"
        class="md:hidden flex items-center"
        aria-label="Toggle Menu"
        
      >
        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>

    </div>
  </div>

  <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-300">
    <div class="px-6 py-4 space-y-4">
      <div class="relative w-full">
        <input 
          type="text" 
          placeholder="Cari soal atau materi..." 
          class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
        <x-heroicon-o-magnifying-glass class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" />
      </div>

      <nav class="flex flex-col space-y-3">
        <a href="#" class="text-gray-700 hover:text-primary-200 transition py-2 font-medium">Explore</a>
        
        <div class="space-y-2">
          <div class="text-gray-900 font-semibold py-2">Bank Soal</div>
          <a href="#" class="block text-gray-600 hover:text-primary-200 transition pl-4 py-1">Matematika</a>
          <a href="#" class="block text-gray-600 hover:text-primary-200 transition pl-4 py-1">Fisika</a>
          <a href="#" class="block text-gray-600 hover:text-primary-200 transition pl-4 py-1">Kimia</a>
          <a href="#" class="block text-gray-600 hover:text-primary-200 transition pl-4 py-1">Biologi</a>
          <a href="#" class="block text-gray-600 hover:text-primary-200 transition pl-4 py-1">Semua Mata Pelajaran</a>
        </div>

        <a href="#" class="text-gray-700 hover:text-primary-200 transition py-2">Tryout</a>
        <a href="#" class="text-gray-700 hover:text-primary-200 transition py-2">Pembahasan</a>
        <a href="#" class="text-gray-700 hover:text-primary-200 transition py-2">Statistik Nilai</a>
        <a href="#" class="text-gray-700 hover:text-primary-200 transition py-2">Riwayat Ujian</a>
      </nav>

      <div class="border-t border-gray-200 my-4"></div>

      <div class="flex flex-col gap-3">
        <a href="/login" class="w-full text-center border border-primary-200 text-primary-200 px-4 py-3 rounded-lg hover:bg-blue-50 transition font-medium">
          Masuk
        </a>
        <a href="/register" class="w-full text-center bg-primary-200 text-white px-4 py-3 rounded-lg hover:bg-primary-300 transition font-medium">
          Daftar Gratis
        </a>
      </div>

      <div class="mt-4">
        <button class="w-full bg-black text-white px-4 py-3 rounded-lg hover:bg-gray-800 transition flex items-center justify-center">
          <img src="{{ asset('images/google-play.png') }}" alt="Play Store Logo" class="w-5 h-5 inline mr-2" /> 
          Download di Play Store
        </button>
      </div>
    </div>
  </div>

  @push('scripts')
  <script>
    const btn = document.getElementById("menu-btn");
    const menu = document.getElementById("mobile-menu");

    btn?.addEventListener("click", () => {
      menu?.classList.toggle("hidden");
    });

    document.addEventListener('click', (event) => {
      if (!btn?.contains(event.target) && !menu?.contains(event.target)) {
        menu?.classList.add('hidden');
      }
    });
  </script>
  @endpush
</header>