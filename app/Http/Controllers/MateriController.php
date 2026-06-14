<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\User;
use App\Models\Rating;
use App\Models\MataKuliah;
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
        // Inisialisasi Query: Eager loading mataKuliah, dosen, dan user pengupload
        $query = Materi::with(['mataKuliah', 'dosen', 'user'])->where('user_id', Auth::id());

        // Search Judul Materi
        if ($request->filled('cari')) {
            $query->where('judul_materi', 'like', '%' . $request->cari . '%');
        }

        // Filter Mata Kuliah
        if ($request->filled('mata_kuliah_id')) {
            $query->where('mata_kuliah_id', $request->mata_kuliah_id);
        }

        // Filter Dosen
        if ($request->filled('dosen_id')) {
            $query->where('dosen_id', $request->dosen_id);
        }

        // Filter Tahun
        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        $materis = $query->latest()->get();

        // Data Dropdown Filter
        $listMataKuliah = MataKuliah::all();
        $listDosen = User::where('role', 'dosen')->get();
        $listTahun = Materi::where('user_id', Auth::id())
            ->select('tahun')
            ->distinct()
            ->pluck('tahun');

        return view('pages.user.materi.mine', compact(
            'materis', 
            'listMataKuliah', 
            'listDosen',
            'listTahun'
        ));
    }

    /**
     * Form upload materi
     */
    public function create()
    {
        // Mengirimkan daftar Mata Kuliah beserta Dosen yang mengampunya (dosen_mata_kuliah)
        $listMataKuliah = MataKuliah::with('dosens')->get();
        return view('pages.user.materi.create', compact('listMataKuliah'));
    }

    /**
     * Simpan materi
     */
    public function store(Request $request)
    {
        // Defensive Validation: Memastikan mata kuliah, dosen, dan judul diisi dengan benar
        $validated = $request->validate([
            'mata_kuliah_id' => ['required', 'exists:mata_kuliahs,id'],
            'dosen_id'       => ['required', 'exists:users,id'],
            'judul_materi'   => ['required', 'string', 'max:255'],
            'file_materi'    => ['required', 'file', 'mimes:pdf,docx,txt', 'max:20480'],
        ]);

        $file = $request->file('file_materi');

        // Clean file name menggunakan string helper Laravel
        $fileName = Str::slug($validated['judul_materi']) . '_' .
                    pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '_' .
                    time() . '.' . $file->getClientOriginalExtension();

        $path = $file->storeAs('materi', $fileName, 'public');

        Materi::create([
            'mata_kuliah_id' => $validated['mata_kuliah_id'],
            'dosen_id'       => $validated['dosen_id'],
            'judul_materi'   => $validated['judul_materi'],
            'file_path'      => $path,
            'tahun'          => now()->year,
            'user_id'        => Auth::id(),
            'deskripsi'      => $request->deskripsi,
        ]);

        return redirect('/student/materi/saya')
            ->with('success', 'Materi berhasil diunggah!');
    }

    /**
     * Search + Filter semua materi (Halaman Utama)
     */
    public function cari(Request $request)
{
    $query = Materi::query()
        ->with(['mataKuliah', 'dosen', 'user'])
        ->where('user_id', '!=', Auth::id())
        ->where('status', 'approved');

    // Search berdasarkan Judul Materi
    if ($request->filled('cari')) {
        $query->where('judul_materi', 'like', '%' . $request->cari . '%');
    }

    // Filter berdasarkan Mata Kuliah
    if ($request->filled('mata_kuliah_id')) {
        $query->where('mata_kuliah_id', $request->mata_kuliah_id);
    }

    // Filter berdasarkan Dosen
    if ($request->filled('dosen_id')) {
        $query->where('dosen_id', $request->dosen_id);
    }

    // Filter berdasarkan Tahun
    if ($request->filled('tahun')) {
        $query->where('tahun', $request->tahun);
    }

    $materis = $query->latest()->get();

    $listMataKuliah = MataKuliah::all();
    $listDosen = User::where('role', 'dosen')->get();
    $listTahun = Materi::select('tahun')->distinct()->pluck('tahun');

    return view('pages.user.materi.index', compact(
        'materis',
        'listMataKuliah',
        'listDosen',
        'listTahun'
    ));
}

    /**
     * Rating Materi
     */
    public function rate(Request $request, int $id)
{
    $request->validate(['nilai' => 'required|integer|min:1|max:5']);

    $materi = \App\Models\Materi::findOrFail($id);

    if ($materi->user_id === Auth::id()) {
        return back()->with('error', 'Wkwk gak boleh dong rating materi buatan sendiri! Harus objektif.');
    }

    Rating::updateOrCreate(
        ['materi_id' => $id, 'user_id' => Auth::id()],
        ['nilai' => $request->nilai]
    );

    return back()->with('success', 'Terima kasih atas penilaiannya!');
}
}