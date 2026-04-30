<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\MataKuliah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MateriController extends Controller
{
    /**
     *  Materi milik user
     */
    public function myMateri(Request $request)
{
    // Inisialisasi Query: Kunci hanya untuk materi milik user login
    $query = Materi::with(['mataKuliah', 'dosen'])
        ->where('user_id', Auth::id());

    // Filter & Search (Logika yang sama dengan fitur Cari)
    // Search Judul Materi
    if ($request->filled('cari')) {
        $query->where('judul_materi', 'like', '%' . $request->cari . '%');
    }

    // Filter Mata Kuliah
    if ($request->filled('matkul')) {
        $query->where('mata_kuliah_id', $request->matkul);
    }

    // Filter Dosen
    if ($request->filled('dosen')) {
        $query->where('dosen_id', $request->dosen);
    }

    // Filter Tahun
    if ($request->filled('tahun')) {
        $query->where('tahun', $request->tahun);
    }

    $materis = $query->latest()->get();

    // Data Dropdown: Hanya matkul/dosen yang pernah lo upload
    $listMatkul = MataKuliah::whereIn('id', function($q) {
        $q->select('mata_kuliah_id')->from('materis')->where('user_id', Auth::id());
    })->get();

    $listDosen = User::whereIn('id', function($q) {
        $q->select('dosen_id')->from('materis')->where('user_id', Auth::id());
    })->get();

    $listTahun = Materi::where('user_id', Auth::id())
        ->select('tahun')
        ->distinct()
        ->pluck('tahun');

    return view('pages.user.materi.mine', compact(
        'materis', 
        'listMatkul', 
        'listDosen', 
        'listTahun'
    ));
}



    /**
     *  Form upload
     */
    public function create()
    {
        return view('pages.user.materi.create', [
            'mataKuliah' => MataKuliah::all()
        ]);
    }




    /**
     *  Simpan materi
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'mata_kuliah_id' => ['required', 'exists:mata_kuliahs,id'],
            'dosen_id'       => ['required', 'exists:users,id'],
            'judul_materi'   => ['required', 'string'],
            'file_materi'    => ['required', 'file', 'mimes:pdf,docx,txt', 'max:20480'],
        ]);

        $file = $request->file('file_materi');

        // Clean file name (Laravel style pakai Str)
        $fileName = Str::slug($validated['judul_materi']) . '_' .
                    pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '_' .
                    time() . '.' . $file->getClientOriginalExtension();

        $path = $file->storeAs('materi', $fileName, 'public');

        Materi::create([
            ...$validated,
            'file_path' => $path,
            'tahun'     => now()->year,
            'user_id'   => Auth::id(),
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect('/materi/saya')
            ->with('success', 'Materi berhasil diunggah!');
    }





    /**
     *  Search + Filter materi
     */
    public function cari(Request $request)
    {
        // Inisialisasi Query dengan Eager Loading agar tidak berat
        $materis = Materi::query()
            ->with(['mataKuliah', 'dosen'])
            
            // Search berdasarkan Judul Materi
            ->when($request->cari, function ($q) use ($request) {
                return $q->where('judul_materi', 'like', '%' . $request->cari . '%');
            })

            // Filter berdasarkan Mata Kuliah
            ->when($request->matkul, function ($q) use ($request) {
                return $q->where('mata_kuliah_id', $request->matkul);
            })

            // Filter berdasarkan Dosen
            ->when($request->dosen, function ($q) use ($request) {
                return $q->where('dosen_id', $request->dosen);
            })

            // Filter berdasarkan Tahun
            ->when($request->tahun, function ($q) use ($request) {
                return $q->where('tahun', $request->tahun);
            })
            ->latest()
            ->get();

        // Data untuk Dropdown Filter 
        $listMatkul = MataKuliah::whereIn('id', Materi::pluck('mata_kuliah_id')->unique())->get();
        $listDosen = User::whereIn('id', Materi::pluck('dosen_id')->unique())->get();
        $listTahun = Materi::select('tahun')->distinct()->pluck('tahun');

        return view('pages.user.materi.index', compact(
            'materis',
            'listMatkul',
            'listDosen',
            'listTahun'
        ));
    }



    

    /**
     *   Ambil dosen dari matkul
     */
    public function getDosenByMk($id)
    {
        $mataKuliah = MataKuliah::find($id);

        if (!$mataKuliah) {
            return response()->json([]);
        }

        // Mengambil data dosen yang berelasi dengan Mata Kuliah tersebut
        return response()->json(
            $mataKuliah->dosens()->get(['users.id', 'users.username'])
        );
    }
}