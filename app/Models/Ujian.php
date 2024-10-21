<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    use HasFactory;

    protected $table = 'ujian'; // nama tabel

    protected $fillable = [
        'judul',
        'mapel_id',
        'kelas_id',
        'waktu_pengerjaan',
        'info_ujian',
        'bobot_pilihan_ganda',
        'bobot_essay',
        'terbit',
        'user_id' // Tambahkan ini
    ];

    // Relasi ke model Mapel
    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }

    // Relasi ke model Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
    // Relasi ke model User (Guru)
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'user_id'); // guru_id adalah foreign key yang merujuk ke tabel users
    }
}
