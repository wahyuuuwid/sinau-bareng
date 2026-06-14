<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MateriSayaController extends Controller
{
    public function index()
    {
        // Mengambil hanya materi milik user yang sedang login
        $materis = Materi::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('pages.user.materi-saya', compact('materis'));
    }

    public function destroy($id)
    {
        $materi = Materi::where('user_id', Auth::id())->findOrFail($id);
        
        // Hapus file fisik jika ada (opsional tapi disarankan)
        // Storage::delete($materi->file_path);
        
        $materi->delete();

        return redirect()->back()->with('success', 'Materi berhasil dihapus.');
    }
}