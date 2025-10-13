<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
{
    Schema::create('tasks', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Menghubungkan tugas ke seorang user
        $table->string('nama_tugas');
        $table->string('mata_kuliah');
        $table->text('deskripsi')->nullable(); // Deskripsi boleh kosong
        $table->date('deadline');
        $table->enum('status', ['Belum Dikerjakan', 'Sedang Dikerjakan', 'Selesai'])->default('Belum Dikerjakan');
        $table->timestamps(); // Kolom created_at dan updated_at
    });
}
};