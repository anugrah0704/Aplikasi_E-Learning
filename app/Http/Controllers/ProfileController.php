<?php

namespace App\Http\Controllers;

use App\Models\User;

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

}
