<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('materis', function (Blueprint $table) {
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('tahun');
        });
    }

    public function down(): void
    {
        Schema::table('materis', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
