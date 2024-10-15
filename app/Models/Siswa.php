<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $fillable = [
        'user_id',
        'nis',
        'nisn',
        'telepon',
        'alamat',
        'tgl_lahir',
        'kelas_id',
        'gender',
    ];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');// Gantilah 'kelas_id' sesuai dengan nama kolom di tabel siswa yang merujuk ke kelas
    }

}
