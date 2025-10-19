<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Mass assignment protection.
     */
    protected $fillable = [
        'nama_tugas',
        'mata_kuliah',
        'deskripsi',
        'course_id',
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

    public function subTasks()
{
    return $this->hasMany(SubTask::class)->orderBy('created_at', 'asc');
}
}
