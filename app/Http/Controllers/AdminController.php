<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Materi;
use App\Models\Laporan;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // ==========================================
    // DASHBOARD ADMIN
    // ==========================================
    public function index()
    {
        Carbon::setLocale('id');
        $now = Carbon::now();

        // 1. STATISTIK UTAMA
        $totalPengguna = User::count();
        $totalMateri = Materi::count();
        $totalLaporan = 0;
        try {
            $totalLaporan = DB::table('laporans')->count();
        } catch (\Exception $e) { $totalLaporan = 0; }

        // 2. AKTIVITAS TERBARU (Real-time)
        $activities = collect();
        Materi::latest()->take(2)->get()->each(function($m) use ($activities) {
            $activities->push((object)[
                'pesan' => 'Materi baru: "' . Str::limit($m->judul, 20) . '"',
                'waktu' => $m->created_at->diffForHumans(),
                'waktu_asli' => $m->created_at
            ]);
        });
        User::latest()->take(2)->get()->each(function($u) use ($activities) {
            $activities->push((object)[
                'pesan' => 'User baru: ' . $u->username,
                'waktu' => $u->created_at->diffForHumans(),
                'waktu_asli' => $u->created_at
            ]);
        });
        $aktivitasTerbaru = $activities->sortByDesc('waktu_asli')->take(5)->values();

        // 3. DISTRIBUSI KONTEN (Materi vs Generate Soal AI)
        // Menghitung berapa banyak materi dan berapa banyak soal yang dihasilkan
        $countMateri = Materi::count(); 
        $countSoalAI = 25; // Ganti dengan count dari model Soal Anda jika ada
        $totalDist = $countMateri + $countSoalAI;
        
        $pMateri = $totalDist > 0 ? ($countMateri / $totalDist) * 100 : 50;
        $pieDistribusi = "#8979FF 0% {$pMateri}%, #FF928A {$pMateri}% 100%";

        // 4. DATA GRAFIK BULANAN (Upload per Bulan)
        // Kita ambil jumlah materi yang dibuat dalam 12 bulan terakhir
        $monthlyUploads = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyUploads[] = Materi::whereYear('created_at', $now->year)
                                      ->whereMonth('created_at', $i)
                                      ->count();
        }
        // Cari angka tertinggi untuk skala grafik (tinggi maksimal 100% di UI)
        $maxUpload = max($monthlyUploads) > 0 ? max($monthlyUploads) : 10;
        $chartHeights = array_map(fn($val) => ($val / $maxUpload) * 100, $monthlyUploads);

        $notifications = Auth::user()
    ->notifications()
    ->latest()
    ->take(5)
    ->get();

$unreadCount = Auth::user()
    ->notifications()
    ->where('is_read', false)
    ->count();

        return view('pages.admin.dashboard', compact(
            'totalPengguna', 'totalMateri', 'totalLaporan', 
            'aktivitasTerbaru', 'pieDistribusi', 'chartHeights',
            'notifications','unreadCount'
        ));
    }

    public function storeUser(Request $request)
    {
        // 1. Validasi input (memastikan data tidak kosong dan email belum terdaftar)
        $request->validate([
            'username' => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:admin,user,dosen',
        ], [
            // Pesan error custom (opsional agar lebih bahasa Indonesia)
            'email.unique' => 'Email ini sudah digunakan oleh pengguna lain.',
            'password.min' => 'Kata sandi minimal harus 6 karakter.'
        ]);

        // 2. Simpan ke database
        User::create([
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password), // Enkripsi password
            'role'     => $request->role,
        ]);

        // 3. Kembali ke halaman dengan pesan sukses
        return back()->with('success', 'Pengguna baru berhasil ditambahkan!');
    }

    public function manageModeration()
    {
    // Mengambil semua materi yang statusnya 'pending' atau semua materi untuk moderasi
    // Sesuaikan 'Materi' dengan nama Model Anda
    $kontens = Materi::latest()->paginate(5);
    
    // Mendefinisikan variabel totalKonten agar tidak error lagi
    $totalKonten = $kontens->count();

    return view('pages.admin.moderation', compact('kontens', 'totalKonten'));
    }
    
    public function updateMateri(Request $request, $id)
{
    $request->validate([
        'judul_materi' => 'required|string|max:255',
        'deskripsi'    => 'nullable|string',
        'status'       => 'required|in:pending,approved,rejected',
    ]);

    $konten = Materi::findOrFail($id);

    $konten->update([
        'judul_materi' => $request->judul_materi,
        'deskripsi'    => $request->deskripsi,
        'status'       => $request->status,
    ]);

    return redirect()->back()->with('success', 'Konten berhasil diperbarui');
}

    public function manageLaporan()
    {
        // Mengambil data laporan dengan relasi materi dan user pelapor
        $reports = Laporan::with(['materi', 'user'])->latest()->get();

        // Mengarahkan ke folder resources/views/pages/admin/laporan.blade.php
        return view('pages.admin.laporan', compact('reports'));
    }

    public function profile()
    {
        return view('pages.admin.profile'); 
    }

    public function updateProfile(Request $request)
    {
    $request->validate([
        'username' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . auth()->id(),
    ]);

    auth()->user()->update([
        'username' => $request->username,
        'email' => $request->email,
    ]);

    return back()->with('success', 'Informasi profil berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
    $request->validate([
        'current_password' => 'required|current_password',
        'password' => 'required|min:6|confirmed',
    ]);

    auth()->user()->update([
        'password' => Hash::make($request->password),
    ]);

    return back()->with('success', 'Kata sandi Anda telah berhasil diubah!');
    }

    public function laporanIndex()
    {
    // Mengambil laporan terbaru beserta data materi dan pelapornya
    $laporans = Laporan::with(['materi', 'user'])->latest()->get();

    return view('pages.admin.laporan', compact('laporans'));
    }

    public function deleteReportedMateri($id)
    {
        $report = Laporan::findOrFail($id);
        
        // Hapus materi yang terkait
        if ($report->materi) {
            $report->materi->delete();
        }
        
        $report->delete(); // Hapus laporan tersebut

        return redirect()->back()->with('success', 'Materi bermasalah berhasil dihapus.');
    }

    // ... (Fungsi lain biarkan utuh: manageUsers, storeUser, manageLaporan, manageModeration, dll) ...
   public function manageUsers()
{
    $users = User::where('role', '!=', 'admin')
        ->latest()
        ->paginate(5);

    $totalUsers = User::where('role', '!=', 'admin')->count();

    return view('pages.admin.users', compact('users', 'totalUsers'));
}
    public function updateUser(Request $request, $id)
{
    $request->validate([
        'username' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'role' => 'required',
    ]);

    $user = User::findOrFail($id);

    $user->username = $request->username;
    $user->email = $request->email;
    $user->role = $request->role;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return back()->with('success', 'Pengguna berhasil diperbarui');
}

    public function deleteUser($id)
{
    $user = User::findOrFail($id);

    $user->delete();

    return back()->with('success', 'Pengguna berhasil dihapus');
}
    public function ignoreReport($id) { return back(); }
    
    public function deleteContent($id)
{
    $konten = Materi::findOrFail($id);

    Storage::delete($konten->file_path);

    $konten->delete();

    return back()->with('success', 'Konten berhasil dihapus.');
}
}