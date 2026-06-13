<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardUserController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // 1. Statistik Personal
        $totalMateri = Materi::where('user_id', $userId)->count();
        $averageRating = round(Materi::where('user_id', $userId)->avg('rating'), 1) ?: 0;

        // 2. Materi Populer (Trending 30 hari terakhir)
        $materiPopuler = Materi::with('user')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->orderByDesc('rating')
            ->take(4)
            ->get();

        return view('pages.user.dashboard', compact('totalMateri', 'averageRating', 'materiPopuler'));
    }

    public function mine()
    {
    // Mengambil materi milik user yang sedang login [cite: 24]
    $materis = Materi::where('user_id', Auth::id())->latest()->get();

    // PERBAIKAN: Sesuaikan titik (.) dengan struktur folder kamu
    // user.materi.mine -> resources/views/user/materi/mine.blade.php
    return view('pages.user.materi.mine', compact('materis'));  
    }
}