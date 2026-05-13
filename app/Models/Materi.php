<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $table = 'materis';

    // Atribut fillable yang sudah bersih dari 'dosen'
    protected $fillable = [
        'user_id',
        'mata_kuliah',
        'judul',
        'deskripsi',
        'file_path',
        'tipe_file',
        'rating',   
    ];

    // Relasi ke tabel pengguna (Pengunggah)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // RELASI RATING YANG SEBELUMNYA HILANG KITA KEMBALIKAN DI SINI
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'materi_id');
    }
}