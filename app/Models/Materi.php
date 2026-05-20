<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $fillable = [
        'pelajaran', // Mengganti mata_kuliah_id menjadi pelajaran
        'judul_materi', 
        'deskripsi', 
        'file_path', 
        'tahun', 
        'status', 
        'user_id'
    ];

    // Relasi ke mahasiswa/admin yang UPLOAD materi ini (Tetap Pertahankan)
    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke ratings (Tetap Pertahankan)
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}