<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanSiswaEssay extends Model
{
    use HasFactory;

    protected $table = 'jawaban_siswa_essay';

    // Fields yang bisa diisi (mass-assignable)
    protected $fillable = [
        'hasil_ujian_id',
        'soal_id',
        'jawaban_siswa',
        'nilai'
    ];

    // Relasi ke hasil ujian
    public function hasilUjian()
    {
        return $this->belongsTo(HasilUjian::class, 'hasil_ujian_id');
    }

    // Relasi ke soal essay
    public function soal()
    {
        return $this->belongsTo(Essay::class, 'soal_id');
    }
}
