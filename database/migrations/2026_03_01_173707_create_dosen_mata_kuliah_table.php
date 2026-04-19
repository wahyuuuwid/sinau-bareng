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
        Schema::create('dosen_mata_kuliah', function (Blueprint $table) {
        $table->id();
        // dosen_id ngambil dari tabel users (yang role-nya dosen)
        $table->foreignId('dosen_id')->constrained('users')->onDelete('cascade'); 
        $table->foreignId('mata_kuliah_id')->constrained('mata_kuliahs')->onDelete('cascade');
        $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen_mata_kuliah');
    }
};
