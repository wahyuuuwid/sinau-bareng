<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi untuk menambah kolom rating.
     */
    public function up(): void
    {
        Schema::table('materis', function (Blueprint $table) {
            // Kita gunakan decimal (3,1) agar bisa menyimpan angka seperti 4.5
            // default(0) agar materi baru tidak bernilai null
            $table->decimal('rating', 3, 1)->default(0)->after('deskripsi');
        });
    }

    /**
     * Batalkan migrasi (Rollback).
     */
    public function down(): void
    {
        Schema::table('materis', function (Blueprint $table) {
            $table->dropColumn('rating');
        });
    }
};