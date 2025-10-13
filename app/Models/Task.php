<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Tambahkan ini

class Task extends Model
{
    use HasFactory;

    /**
     * Mass assignment protection.
     */
    protected $fillable = [
        'nama_tugas',
        'mata_kuliah',
        'deskripsi',
        'deadline',
        'status',
        'prioritas', // Tambahkan ini jika Anda menambahkan kolom prioritas
    ];

    /**
     * Mendefinisikan bahwa sebuah Task dimiliki oleh seorang User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
