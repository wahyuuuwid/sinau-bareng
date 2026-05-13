<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MateriController extends Controller
{
    /**
     * Menampilkan semua materi (Halaman Cari Materi)
     */
    public function index()
    {
        // UBAH get() MENJADI paginate(9)
        $materis = Materi::with('user')->latest()->paginate(9); 
        
        $listMatkul = Materi::select('mata_kuliah')->distinct()->pluck('mata_kuliah');

        return view('pages.user.materi.index', compact('materis', 'listMatkul'));
    }

    /**
     * Menampilkan materi milik user yang sedang login (Halaman Materi Saya)
     */
    public function myMateri()
    {
        // Mengambil materi milik user ini saja
        $materis = Materi::where('user_id', Auth::id())->latest()->get();
        
        // Mengambil daftar unik mata kuliah untuk filter di sidebar mine.blade.php
        $listMatkul = Materi::where('user_id', Auth::id())
                            ->select('mata_kuliah')
                            ->distinct()
                            ->pluck('mata_kuliah');

        return view('pages.user.materi.mine', compact('materis', 'listMatkul'));
    }

    /**
     * Fungsi Pencarian (Menjawab error: Call to undefined method cari())
     */
    public function cari(Request $request)
    {
        $keyword = $request->get('keyword');
        
        // UBAH get() MENJADI paginate(9)
        $materis = Materi::with('user')
            ->where(function($query) use ($keyword) {
                $query->where('judul', 'like', "%$keyword%")
                      ->orWhere('mata_kuliah', 'like', "%$keyword%");
            })
            ->latest()
            ->paginate(9);

        $listMatkul = Materi::select('mata_kuliah')->distinct()->pluck('mata_kuliah');

        return view('pages.user.materi.index', compact('materis', 'listMatkul', 'keyword'));
    }

    public function create()
    {
        return view('pages.user.materi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'mata_kuliah' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file_materi' => 'required|file|mimes:pdf,doc,docx,ppt,pptx,txt|max:20480',
        ]);

        $filePath = null;
        $tipeFile = null;

        if ($request->hasFile('file_materi')) {
            $file = $request->file('file_materi');
            $tipeFile = $file->getClientOriginalExtension();
            $filePath = $file->store('materis', 'public'); 
        }

        Materi::create([
            'user_id' => Auth::id(),
            'mata_kuliah' => $request->mata_kuliah,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file_path' => $filePath,
            'tipe_file' => $tipeFile,
        ]);

        return redirect()->route('materi.mine')->with('success', 'Materi berhasil diunggah!');
    }

    public function show($id)
    {
    $materi = Materi::with('user')->findOrFail($id);
    return view('pages.user.materi.detail', compact('materi'));
    }

    public function report(Request $request, $id)
    {
        $request->validate([
            'alasan' => 'required|string|max:255',
        ]);

        // Periksa tabel 'laporans' Anda. Jika kolomnya bukan 'materi_id', sesuaikan di sini.
        // Misalnya jika di DB namanya 'id_materi', maka ganti 'materi_id' menjadi 'id_materi'.
        DB::table('laporans')->insert([
            'materi_id'  => $id, // Ganti ini jika nama kolom di DB berbeda
            'user_id'    => Auth::id(),
            'alasan'     => $request->alasan,
            'status'     => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Laporan berhasil dikirim ke Admin.');
    }

    public function download($id)
    {
        $materi = Materi::findOrFail($id);
        
        // Pastikan path di DB (misal: materis/file.pdf) ditambah 'public/' jika pakai disk public
        $path = 'public/' . $materi->file_path;

        if (!Storage::exists($path)) {
            return back()->with('error', 'File tidak ditemukan di server.');
        }

        $extension = pathinfo($materi->file_path, PATHINFO_EXTENSION);
        $safeName = Str::slug($materi->judul) . '.' . $extension;

        // return Storage::download akan memaksa browser mengunduh file
        return Storage::download($path, $safeName);
    }

    public function rate(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $materi = Materi::findOrFail($id);
    
        // Simpan rating ke kolom 'rating' di tabel materis
        $materi->rating = $request->rating;
        $materi->save();

        return back()->with('success', 'Rating berhasil disimpan!');
    }

    public function destroy($id)
    {
    // Cari materi milik user yang sedang login agar tidak bisa menghapus milik orang lain
    $materi = Materi::where('user_id', Auth::id())->findOrFail($id);
    
    // Hapus data dari database
    $materi->delete();

    return redirect()->back()->with('success', 'Materi berhasil dihapus!');
        }
}