<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function loginForm()
    {
        return view('pages.auth.login');
    }

    public function registerForm()
    {
        return view('pages.auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email','password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->role == 'admin') {
                return redirect('/admin');
            }

            if ($user->role == 'dosen') {
                return redirect('/dosen');
            }

            return redirect('/user');
        }

        return back()->with('error','Email atau password salah');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = \App\Models\User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);
        return redirect('/user');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    
}
