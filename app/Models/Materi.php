<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;
    protected $table = 'materi';
    protected $fillable = ['judul', 'mapel_id', 'kelas_id', 'file_path', 'user_id'];


    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id'); // Pastikan foreign key sesuai
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id'); // Pastikan foreign key sesuai
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id'); // Asumsi ada field guru_id di tabel materi
    }
    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}