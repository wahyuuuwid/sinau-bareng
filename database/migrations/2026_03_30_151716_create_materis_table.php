<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('materis', function (Blueprint $table) {
        $table->id();
        
        // Mengganti mata_kuliah_id menjadi string pelajaran agar inputan bebas (custom)
        $table->string('pelajaran'); 
        
        // dosen_id dihapus karena sifatnya sudah global tanpa dosen pengampu

        $table->string('judul_materi');
        $table->text('deskripsi')->nullable();
        $table->string('file_path'); 
        $table->string('tahun');
        $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
        
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materis');
    }
};
