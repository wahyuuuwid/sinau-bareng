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
            // Relasi ke user yang melaporkan
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // Relasi ke materi yang dilaporkan
            $table->foreignId('materi_id')->constrained('materis')->onDelete('cascade');
            // Alasan laporan
            $table->text('alasan');
            // (Opsional) Status laporan, misalnya: pending, direview, selesai
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
