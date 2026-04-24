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


    public function store(Request $request)
{
    $request->validate([
        'mata_kuliah_id' => 'required|exists:mata_kuliahs,id', // Ganti nama inputnya
        'dosen_id'       => 'required|exists:users,id',       // Ganti nama inputnya
        'judul_materi'   => 'required',
        'file_materi'    => 'required|mimes:pdf,docx,txt|max:20480',
    ]);

    // Simpan file ke storage
    $path = $request->file('file_materi')->store('materi', 'public');

{
    $request->validate([
        'mata_kuliah_id' => 'required|exists:mata_kuliahs,id', 
        'dosen_id'       => 'required|exists:users,id',    
        'judul_materi'   => 'required',
        'file_materi'    => 'required|mimes:pdf,docx,txt|max:20480',
    ]);


    $path = $request->file('file_materi')->store('materi', 'public');


    // Pastikan key di bawah ini SAMA PERSIS dengan $fillable di Model
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