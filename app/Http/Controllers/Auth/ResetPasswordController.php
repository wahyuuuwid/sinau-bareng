<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
      // 1. nampilin form reset
    public function showResetForm(Request $request, $token)
    {
        return view('pages.auth.reset-password', [
            'token' => $token,
            'email' => $request->email
        ]);
    }

    // 2. proses reset password
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect('/login')->with('status', 'Password berhasil direset!')
            : back()->withErrors(['email' => __($status)]);
    }
}
