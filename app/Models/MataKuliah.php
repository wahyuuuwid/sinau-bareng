<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliahs';
    
    protected $fillable = ['nama_mk'];

    // Relasi balik: Satu mata kuliah ini diajar oleh dosen siapa aja?
    public function dosens()
    {
        return $this->belongsToMany(
            User::class, 
            'dosen_mata_kuliah', 
            'mata_kuliah_id', 
            'dosen_id'
        );
    }
}