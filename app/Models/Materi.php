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

    // Relasi ke mahasiswa/admin yang UPLOAD materi ini
    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke dosen PENGAMPU materi ini
    public function dosen() 
    {
        // Kita kasih tau Laravel: "Dosen itu ngambil dari tabel users, tapi kuncinya dosen_id ya!"
        return $this->belongsTo(User::class, 'dosen_id');
    }

    // Relasi ke Mata Kuliah
    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class);
    }
}
