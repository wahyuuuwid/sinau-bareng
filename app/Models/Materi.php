<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $fillable = [
        'mata_kuliah',
        'judul_materi', 
        'deskripsi', 
        'file_path', 
        'tahun', 
        'user_id'
        ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
