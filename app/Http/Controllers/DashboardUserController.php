<?php

namespace App\Http\Controllers;
use App\Models\Materi;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DashboardUserController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $totalMateri = Materi::where('user_id', Auth::id())->count();

        $materiTerbaru = Materi::where('user_id', $userId)
        ->latest()
        ->take(5)
        ->get();


        return view('pages.user.dashboard', compact('totalMateri', 'materiTerbaru'));
    }
}
