<?php
namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    // Tampil di "Materi Saya"
    public function index()
    {
        $materis = Materi::where('user_id', Auth::id())->latest()->get();
        return view('pages.user.materi.mine', compact('materis'));
    }

    // Proses Simpan (Unggah)
    public function store(Request $request)
    {
        $request->validate([
            'mata_kuliah' => 'required',
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
}