<?php
<<<<<<< Updated upstream

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // Menampilkan data profile user
    public function index()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    // Mengubah nama user
    public function updateName(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->save();

        return redirect()->route('profile')->with('success', 'Nama berhasil diubah.');
    }

    // Mengubah email user
    public function updateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->email = $request->email;
        $user->save();

        return redirect()->route('profile')->with('success', 'Email berhasil diubah.');
    }

    // Menghapus akun user
    public function deleteAccount(Request $request)
    {
        $user = Auth::user();
        Auth::logout();
        $user->delete();

        return redirect('/')->with('success', 'Akun berhasil dihapus.');
    }
}
=======
>>>>>>> Stashed changes

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        // PERBAIKAN DI SINI: Mengarah ke 'app_dosen' / 'app_user', BUKAN 'sidebar'
        $layout = Auth::user()->role == 'dosen' ? 'components.layout.app_dosen' : 'components.layout.app_user';
        
        // Pastikan nama file view-nya sesuai dengan yang kamu miliki
        // (contoh: 'pages.profile' atau 'pages.user.profile')
        return view('pages.user.profile', compact('layout'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
        ]);

        $user = auth()->user();
        $user->update([
            'username' => $request->username,
            'email'    => $request->email,
        ]);

        return redirect()->back()->with('success', 'Profil Anda berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|string|min:6|confirmed',
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->with('error', 'Password lama tidak sesuai.');
        }

        Auth::user()->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', 'Password berhasil diubah!');
    }
}