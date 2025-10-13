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
        Schema::table('tasks', function (Blueprint $table) {
            // Ubah tipe kolom deadline dari date menjadi datetime
            // default timestamp adalah untuk memastikan tidak ada error jika kolom sudah ada data
            $table->dateTime('deadline')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            // Kembalikan ke tipe date jika di-rollback
            $table->date('deadline')->change();
        });
    }
};