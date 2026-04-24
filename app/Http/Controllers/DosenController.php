<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\MataKuliah;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        $dosenId = Auth::id();

        $materis = Materi::with(['mataKuliah', 'user'])
            ->where('dosen_id', $dosenId)
            ->latest()
            ->get();

        //Hitung Statistik 
        $countMenunggu = Materi::where('dosen_id', $dosenId)->where('status', 'pending')->count();
        $countDisetujui = Materi::where('dosen_id', $dosenId)->where('status', 'approved')->count();

        $countSoalAI = 0; 

        return view('pages.dosen.dashboard', compact(
            'materis', 
            'countMenunggu', 
            'countDisetujui', 
            'countSoalAI'
        ));
    }

    // Menampilkan halaman detail
    public function showMateri($id)
    {
        $materi = Materi::with(['mataKuliah', 'user'])->findOrFail($id);
        return view('pages.dosen.detail_materi', compact('materi'));
    }

    // Mengupdate status
    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:pending,approved,rejected']);
        
        $materi = Materi::findOrFail($id);
        $materi->update(['status' => $request->status]);

        return redirect()->route('dosen.validasi')->with('success', 'Status materi berhasil diupdate!');
    }

    public function validasiMateri()
    {
    $user = Auth::user();
    
    $query = Materi::with(['mataKuliah', 'user'])->latest();

    
    if ($user->username != 'dosen') {
        $query->where('dosen_id', $user->id);
    }

    $materis = $query->get();

    return view('pages.dosen.validasi_materi', compact('materis'));
    }
}