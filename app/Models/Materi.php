<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $fillable = [
        'mata_kuliah_id',
        'dosen_id',
        'judul_materi', 
        'deskripsi', 
        'file_path', 
        'tahun', 
        'status', 
        'user_id'
    ];

    // Relasi ke mata kuliah
    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id');
    }

    // Relasi ke dosen pengampu
    public function dosen()
    {
        return $this->belongsTo(User::class, 'dosen_id');
    }

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