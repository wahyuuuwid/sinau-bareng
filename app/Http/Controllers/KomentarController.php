<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomentarController extends Controller
{
    public function store(Request $request, $materi_id)
    {
        $request->validate([
            'isi_komentar' => 'required|string|max:1000',
        ]);

        Komentar::create([
            'materi_id' => $materi_id,
            'user_id' => Auth::id(),
            'isi_komentar' => $request->isi_komentar,
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }
}