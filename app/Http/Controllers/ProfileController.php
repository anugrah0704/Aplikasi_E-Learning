<?php

namespace App\Http\Controllers;

use App\Models\User;
use db;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ProfileController extends Controller
{

    public function profil()
    {
        return view('siswa.profil_siswa');
    }
    public function show($id)
{
    // Ambil data user dengan id dan pastikan perannya adalah siswa
    $user = User::with('kelas')->findOrFail($id);

    // Cek peran user apakah siswa, jika bukan maka kembalikan 404
    if ($user->role !== 'siswa') {
        abort(404, "User bukan siswa");
    }
    dd($user);
    // Kirim data user ke view
    return view('profile', compact('user'));
}

public function showProfilGuru()
{
    // Mendapatkan ID pengguna yang sedang login
    $userId = Auth::id();

    // Query untuk mendapatkan data guru yang sesuai dengan user yang sedang login
    $guruData = DB::table('users')
        ->join('guru', 'users.id', '=', 'guru.user_id')
        ->select(
            'users.id as user_id',
            'users.username as nama',
            'users.email',
            'guru.nip',
            'guru.alamat',
            'guru.tgl_lahir',
            'guru.telepon',
            'guru.gender',
            'guru.jabatan'
        )
        ->where('users.role', 'guru')
        ->where('users.id', $userId) // Menyaring data sesuai dengan user yang login
        ->first();

    return view('guru.profil.profil_guru', compact('guruData'));
}


}
