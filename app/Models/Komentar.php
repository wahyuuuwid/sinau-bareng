<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Komentar ini milik siapa?
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Komentar ini ada di materi apa?
    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }
}