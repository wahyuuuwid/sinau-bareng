<?php

namespace App\Http\Controllers;


use App\Models\Notification;
use App\Models\Materi;
use App\Models\MataKuliah;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class DosenController extends Controller
{
    public function index()
    {
        // 1. Hitung jumlah data untuk ditampilkan di Kartu Statistik
        $countMenunggu = Materi::where('status', 'pending')->count();
        $countDisetujui = Materi::where('status', 'approved')->count();
        
        // (Opsional) Jika tabel/fitur Soal AI belum ada, biarkan 0 sementara
        $countSoalAI = 0; 

        // 2. Ambil 5 data materi terbaru untuk ditampilkan di tabel
        // Gunakan 'with' agar relasi ke tabel User dan MataKuliah tidak membebani database
        $materis = Materi::with(['user', 'mataKuliah'])
                        ->orderBy('created_at', 'desc')
                        ->limit(5)
                        ->get();

        // 3. Kirim semua variabel ke tampilan (view)
        return view('pages.dosen.dashboard', compact('countMenunggu', 'countDisetujui', 'countSoalAI', 'materis'));
    }

    // Menampilkan halaman detail
    public function showMateri($id)
    {
        $materi = Materi::with(['mataKuliah', 'user'])->findOrFail($id);
        return view('pages.dosen.detail_materi', compact('materi'));
    }


    public function updateStatus(Request $request, $id)
    {
        // 1. Validasi input, tambahkan 'pesan'
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'pesan' => 'nullable|string|max:1000',
        ]);

        $materi = Materi::findOrFail($id);
        $isStatusChanged = $materi->status !== $request->status;
        
        // 2. Update status materi
        $materi->update([
            'status' => $request->status
        ]);

        // 3. Kirim Notifikasi jika status berubah menjadi approved/rejected
        if ($isStatusChanged && in_array($request->status, ['approved', 'rejected'])) {
            
            $statusText = $request->status == 'approved' ? 'Disetujui ✅' : 'Ditolak ❌';
            $catatanTambahan = $request->pesan ? "\n\nCatatan Dosen: " . $request->pesan : "";

            // --- A. Kirim Notifikasi ke User (Mahasiswa) ---
            $pesanUser = $request->status == 'approved' 
                ? "Selamat! Materi Anda '{$materi->judul_materi}' telah disetujui." . $catatanTambahan
                : "Mohon maaf, materi Anda '{$materi->judul_materi}' ditolak/perlu revisi." . $catatanTambahan;

            Notification::create([
                'user_id' => $materi->user_id,
                'title' => "Materi " . $statusText,
                'message' => $pesanUser,
                'is_read' => false,
            ]);

            // --- B. Kirim Notifikasi ke Admin ---
            // Cari user dengan role admin
            $admin = User::where('role', 'admin')->first(); 
            if ($admin) {
                $namaDosen = auth()->user()->username;
                Notification::create([
                    'user_id' => $admin->id,
                    'title' => "Laporan Validasi " . $statusText,
                    'message' => "Dosen {$namaDosen} telah mengubah status materi '{$materi->judul_materi}' menjadi {$request->status}." . $catatanTambahan,
                    'is_read' => false,
                ]);
            }
        }

        return redirect()->route('dosen.validasi')->with('success', 'Materi berhasil divalidasi dan notifikasi telah dikirim!');
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