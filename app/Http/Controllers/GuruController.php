<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Guru;
class GuruController extends Controller
{
    //
    public function index()
    {
        return view('guru.index');
    }
    // Tampilkan profil guru
    public function show($id)
    {
        $guru = Guru::with('user')->findOrFail($id); // Mengambil siswa beserta user-nya
        return view('guru.profil_guru', compact('guru'));
    }

    public function profilGuru($id)
    {
        if (Auth::check() && Auth::user()->role === 'guru') {
            $guru = Guru::with('user')->find($id);

            if (!$guru) {
                return redirect()->back()->with('error', 'guru tidak ditemukan.');
            }

            $user = $guru->user;

            // Tambahkan ini untuk debugging
            dd($guru, $user); // Melihat isi variabel
        }

        return redirect('/home')->with('error', 'Akses ditolak, Anda bukan siswa.');
    }

}
