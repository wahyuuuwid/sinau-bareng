<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Langsung arahkan ke view mahasiswa
        return view('pages.user.profile', compact('user'));
    }

    // FUNGSI UNTUK MEMPROSES PEMBARUAN PROFIL
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'required|string|max:255',
            // Mengecek agar email unik, tapi abaikan email milik user ini sendiri
            'email' => 'required|email|max:255|unique:users,email,' . $user->id, 
        ]);

        $user->update([
            'username' => $request->username,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Profil Anda berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password', // Cek kecocokan password lama
            'password' => 'required|string|min:8|confirmed',   // Minimal 8 char & wajib konfirmasi
        ]);

        $user = Auth::user();
        
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password berhasil diubah!');
    }

    public function updateName(Request $request) { /* kode lama Anda */ }
    public function updateEmail(Request $request) { /* kode lama Anda */ }
    
    public function deleteAccount()
    {
        $user = Auth::user(); // Ambil data user yang sedang login

        // Proses Logout agar sesinya dibersihkan
        Auth::logout();

        // Hapus akun dari database
        $user->delete();

        // Bersihkan token keamanan sesi
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Tendang kembali ke halaman login dengan pesan
        return redirect()->route('login')->with('success', 'Akun Anda telah berhasil dihapus permanen dari sistem.');
    }
}