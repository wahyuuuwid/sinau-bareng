<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardUserController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // 1. Total Materi yang diupload user ini
        $totalMateri = Materi::where('user_id', $userId)->count();

        // 2. Rata-rata Penilaian materi milik user ini (dari orang lain)
        $averageRating = Rating::whereIn('materi_id', function($q) use ($userId) {
            $q->select('id')->from('materis')->where('user_id', $userId);
        })->avg('nilai');

        $averageRating = round($averageRating, 1);

        // 3. Materi Terbaru milik user ini
        $materiTerbaru = Materi::where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        // 4. Materi Populer Minggu Ini (Prioritas Rating, lalu Views)
        $materiPopuler = Materi::where('status', 'approved')->withAvg('ratings', 'nilai')
            ->orderByDesc('ratings_avg_nilai') // Rating dulu
            ->take(5)
            ->get();
            

        return view('pages.user.dashboard', compact(
            'totalMateri', 
            'averageRating', 
            'materiTerbaru', 
            'materiPopuler'
        ));
    }
}