<?php
namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    // Tampil di "Materi Saya"
    public function index()
    {
        $materis = Materi::where('user_id', Auth::id())->latest()->get();
        return view('pages.user.materi.mine', compact('materis'));
    }

    public function create()
{
    $mataKuliah= MataKuliah::all();
    return view('pages.user.materi.create', compact('mataKuliah'));
}


    // Proses Simpan (Unggah)
    public function store(Request $request)
    {
        $request->validate([
            'mata_kuliah' => 'required',
            'dosen_id' => 'required',
            'judul_materi' => 'required',
            'file_materi' => 'required|mimes:pdf,docx,txt|max:20480', // Maks 20 MB
        ]);

        // Simpan file ke folder storage/app/public/materi
        $path = $request->file('file_materi')->store('materi', 'public');

        Materi::create([
            'mata_kuliah' => $request->mata_kuliah,
            'judul_materi' => $request->judul_materi,
            'deskripsi' => $request->deskripsi,
            'file_path' => $path,
            'tahun' => date('Y'),
            'user_id' => Auth::id(),
        ]);

        return redirect('/materi/saya')->with('success', 'Materi berhasil diunggah!');
    }

    public function cari(Request $request)
    {
    $materis = Materi::where('judul_materi', 'like', '%' . $request->cari . '%')->get();

    $listMatkul = Materi::select('mata_kuliah')->distinct()->get();
    $listDosen = Materi::select('user_id')->distinct()->with('user')->get(); 

    return view('pages.user.materi.index', compact('materis', 'listMatkul', 'listDosen'));
    }

    public function getDosenByMk($id)
    {
        //Cari Mata Kuliah berdasarkan ID
        $mataKuliah = MataKuliah::find($id);

        if (!$mataKuliah) {
            return response()->json([]); 
        }

        // Ambil data dosen yang berelasi dengan MK ini
        $dosens = $mataKuliah->dosens()->get(['users.id', 'users.username']);

        //Kembalikan dalam format JSON
        return response()->json($dosens);
    }
}