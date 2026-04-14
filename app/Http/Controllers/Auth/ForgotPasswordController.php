<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    // 1. Munculin Form
    public function showLinkRequestForm()
    {
        return view('pages.auth.forgot-password');
    }

    // 2. Logika Kirim Email (Sederhana dulu)
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Ini perintah saktinya
        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', 'Link reset password sudah dikirim ke email kamu!')
            : back()->withErrors(['email' => __($status)]);
    }
}
