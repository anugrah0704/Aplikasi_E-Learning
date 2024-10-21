<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanSiswaPilgan extends Model
{
    use HasFactory;

    protected $table = 'jawaban_siswa_pilgan';

    // Fields yang bisa diisi (mass-assignable)
    protected $fillable = [
        'hasil_ujian_id',
        'soal_id',
        'jawaban_siswa',
        'benar'
    ];

    // Relasi ke hasil ujian
    public function hasilUjian()
    {
        return $this->belongsTo(HasilUjian::class, 'hasil_ujian_id');
    }

    // Relasi ke soal pilihan ganda
    public function soal()
    {
        return $this->belongsTo(PilihanGanda::class, 'soal_id');
    }
}
