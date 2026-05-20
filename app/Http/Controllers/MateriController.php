<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\User;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MateriController extends Controller
{
    /**
     * Materi milik user
     */
    public function myMateri(Request $request)
    {
        // Inisialisasi Query: Eager loading hanya ke user pengupload
        $query = Materi::with('user')->where('user_id', Auth::id());

        // Search Judul Materi
        if ($request->filled('cari')) {
            $query->where('judul_materi', 'like', '%' . $request->cari . '%');
        }

        // Filter Pelajaran (Menggunakan string custom)
        if ($request->filled('pelajaran')) {
            $query->where('pelajaran', $request->pelajaran);
        }

        // Filter Tahun
        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        $materis = $query->latest()->get();

        // Data Dropdown: Ambil teks pelajaran unik yang PERNAH di-upload oleh user ini
        $listPelajaran = Materi::where('user_id', Auth::id())
            ->select('pelajaran')
            ->distinct()
            ->pluck('pelajaran');

        $listTahun = Materi::where('user_id', Auth::id())
            ->select('tahun')
            ->distinct()
            ->pluck('tahun');

        return view('pages.user.materi.mine', compact(
            'materis', 
            'listPelajaran', 
            'listTahun'
        ));
    }

    /**
     * Form upload materi
     */
    public function create()
    {
        // Tidak perlu melempar data Master Mata Kuliah lagi karena sekarang input teks bebas
        return view('pages.user.materi.create');
    }

    /**
     * Simpan materi
     */
    public function store(Request $request)
    {
        // Defensive Validation: Memastikan pelajaran dan judul diisi dengan benar
        $validated = $request->validate([
            'pelajaran'    => ['required', 'string', 'max:255'],
            'judul_materi' => ['required', 'string', 'max:255'],
            'file_materi'  => ['required', 'file', 'mimes:pdf,docx,txt', 'max:20480'],
        ]);

        $file = $request->file('file_materi');

        // Clean file name menggunakan string helper Laravel
        $fileName = Str::slug($validated['judul_materi']) . '_' .
                    pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '_' .
                    time() . '.' . $file->getClientOriginalExtension();

        $path = $file->storeAs('materi', $fileName, 'public');

        Materi::create([
            'pelajaran'    => $validated['pelajaran'],
            'judul_materi' => $validated['judul_materi'],
            'file_path'    => $path,
            'tahun'        => now()->year,
            'user_id'      => Auth::id(),
            'deskripsi'    => $request->deskripsi,
        ]);

        return redirect('/student/materi/saya')
            ->with('success', 'Materi berhasil diunggah!');
    }

    /**
     * Search + Filter semua materi (Halaman Utama)
     */
    public function cari(Request $request)
    {
        $query = Materi::query()->with('user');

        // Search berdasarkan Judul Materi
        if ($request->filled('cari')) {
            $query->where('judul_materi', 'like', '%' . $request->cari . '%');
        }

        // Filter berdasarkan Pelajaran (Teks kustom)
        if ($request->filled('pelajaran')) {
            $query->where('pelajaran', $request->pelajaran);
        }

        // Filter berdasarkan Tahun
        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        $materis = $query->latest()->get();

        // Ambil data unik untuk dropdown filter dari apa yang ada di database
        $listPelajaran = Materi::select('pelajaran')->distinct()->pluck('pelajaran');
        $listTahun = Materi::select('tahun')->distinct()->pluck('tahun');

        return view('pages.user.materi.index', compact(
            'materis',
            'listPelajaran',
            'listTahun'
        ));
    }

    /**
     * Rating Materi
     */
    public function rate(Request $request, int $id)
    {
        $request->validate(['nilai' => 'required|integer|min:1|max:5']);
        
        Rating::updateOrCreate(
            ['materi_id' => $id, 'user_id' => Auth::id()],
            ['nilai' => $request->nilai]
        );

        return back()->with('success', 'Terima kasih atas penilaiannya!');
    }
}