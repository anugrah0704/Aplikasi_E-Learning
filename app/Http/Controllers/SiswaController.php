<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;

use App\Models\Siswa;
class SiswaController extends Controller
{
    // Halaman utama siswa
    public function index()
    {
        return view('siswa.index');
    }

    // Tampilkan profil siswa yang sedang login
    public function show($id)
{
    $siswa = Siswa::with('user')->findOrFail($id); // Mengambil siswa beserta user-nya
    return view('siswa.profil_siswa', compact('siswa'));
}

    public function profileSiswa($id)
    {
        if (Auth::check() && Auth::user()->role === 'siswa') {
            $siswa = Siswa::with('user')->find($id);

            if (!$siswa) {
                return redirect()->back()->with('error', 'Siswa tidak ditemukan.');
            }

            $user = $siswa->user;

            // Tambahkan ini untuk debugging
            dd($siswa, $user); // Melihat isi variabel
        }

        return redirect('/home')->with('error', 'Akses ditolak, Anda bukan siswa.');
    }

}
