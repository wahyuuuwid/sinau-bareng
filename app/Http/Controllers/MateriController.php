<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    // Tampil di "Materi Saya"
    public function index()
    {
        $materis = Materi::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('pages.user.materi.mine', compact('materis'));
    }

    // Form upload materi
    public function create()
    {
        $mataKuliah = MataKuliah::all();
        return view('pages.user.materi.create', compact('mataKuliah'));
    }

    // Simpan materi
    public function store(Request $request)
{
    $request->validate([
        'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
        'dosen_id'       => 'required|exists:users,id',
        'judul_materi'   => 'required',
        'file_materi'    => 'required|mimes:pdf,docx,txt|max:20480',
    ]);

    // Ambil file asli
    $file = $request->file('file_materi');
    
    // Buat nama file baru (misal: judul_materi_nama_asli.pdf)
    // Hapus spasi dan karakter aneh dari judul materi
    $cleanJudul = preg_replace('/[^a-zA-Z0-9]/', '_', $request->judul_materi);
    $namaAsli = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
    $extension = $file->getClientOriginalExtension();
    
    // Contoh nama: Judul_Materi_Nama_File_Asli_timestamp.pdf
    $namaFile = $cleanJudul . '_' . $namaAsli . '_' . time() . '.' . $extension;
    
    // Simpan dengan nama yang sudah ditentukan
    $path = $file->storeAs('materi', $namaFile, 'public');

    // Simpan ke database
    Materi::create([
        'mata_kuliah_id' => $request->mata_kuliah_id,
        'dosen_id'       => $request->dosen_id,
        'judul_materi'   => $request->judul_materi,
        'deskripsi'      => $request->deskripsi,
        'file_path'      => $path,
        'tahun'          => date('Y'),
        'user_id'        => Auth::id(),
    ]);

    return redirect('/materi/saya')->with('success', 'Materi berhasil diunggah!');
}

    // Pencarian materi
    public function cari(Request $request)
{
    $materis = Materi::where('judul_materi', 'like', '%' . $request->cari . '%')->get();

    $listMatkul = Materi::select('mata_kuliah_id')
        ->distinct()
        ->with('mataKuliah') 
        ->get();

    
    $listDosen = Materi::select('dosen_id')
        ->distinct()
        ->with('dosen') 
        ->get(); 

    return view('pages.user.materi.index', compact('materis', 'listMatkul', 'listDosen'));
}

    // Ambil dosen berdasarkan mata kuliah (AJAX)
    public function getDosenByMk($id)
    {
        $mataKuliah = MataKuliah::find($id);

        if (!$mataKuliah) {
            return response()->json([]);
        }

        // relasi: MataKuliah -> dosens()
        $dosens = $mataKuliah->dosens()->get(['users.id', 'users.username']);

        return response()->json($dosens);
    }
}