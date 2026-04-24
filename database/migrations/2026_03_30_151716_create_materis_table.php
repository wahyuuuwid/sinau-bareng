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
        //$table->string('mata_kuliah');

        $table->foreignId('mata_kuliah_id')->constrained('mata_kuliahs')->onDelete('cascade');
        $table->foreignId('dosen_id')->constrained('users')->onDelete('cascade'); // Dosen pengampu

        $table->string('judul_materi');
        $table->text('deskripsi')->nullable();
        $table->string('file_path'); // Lokasi file di folder storage
        $table->string('tahun');

        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Biar tau ini materi punya siapa
        
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
