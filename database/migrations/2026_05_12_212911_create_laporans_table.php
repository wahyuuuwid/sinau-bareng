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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke user yang melaporkan (bisa null jika anonim)
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            
            // Relasi ke materi/konten yang dilaporkan
            // (Asumsi nama tabel konten Anda adalah 'materis')
            $table->foreignId('materi_id')->constrained('materis')->onDelete('cascade');
            
            // Alasan pelaporan
            $table->text('alasan');
            
            $table->timestamps();
        });
    }
};
