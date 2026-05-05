<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['materi_id', 'user_id', 'nilai'];

    // Relasi balik ke Materi
    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }

    // Relasi ke User yang ngasih rate
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
