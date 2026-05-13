<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporKonten extends Model
{
    protected $fillable = ['user_id', 'materi_id', 'alasan', 'status'];

    public function user() { return $this->belongsTo(User::class); }
    public function materi() { return $this->belongsTo(Materi::class); }
}
