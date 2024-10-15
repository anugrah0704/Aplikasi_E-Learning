<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function login(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string', // Bisa email, NIP, atau NIS
            'password' => 'required|string',
        ]);

        // Cek apakah login sebagai admin (Email)
        if (filter_var($request->identifier, FILTER_VALIDATE_EMAIL)) {
            $credentials = [
                'email' => $request->identifier,
                'password' => $request->password,
            ];

            if (Auth::attempt($credentials)) {
                if (Auth::user()->role == 'admin') {
                    return redirect()->route('admin.dashboard'); // Redirect ke dashboard admin
                }
            }
        }

        // Cek apakah login sebagai guru (NIP)
        $guru = Guru::where('nip', $request->identifier)->first();
        if ($guru) {
            $credentials = [
                'id' => $guru->user_id, // Menggunakan user_id dari guru
                'password' => $request->password,
            ];

            if (Auth::attempt($credentials)) {
                return redirect()->route('guru.index'); // Redirect ke dashboard guru
            }
        }

        // Cek apakah login sebagai siswa (NIS)
        $siswa = Siswa::where('nis', $request->identifier)->first();
        if ($siswa) {
            $credentials = [
                'id' => $siswa->user_id, // Menggunakan user_id dari siswa
                'password' => $request->password,
            ];

            if (Auth::attempt($credentials)) {
                return redirect()->route('siswa.index'); // Redirect ke dashboard siswa
            }
        }

        // Jika login gagal
        return back()->withErrors([
            'identifier' => 'Email/NIP/NIS atau password salah.',
        ]);
    }

    protected function redirectTo()
    {
        // Cek role user dan arahkan ke halaman yang sesuai
        if (Auth::user()->role == 'admin') {
            return '/admin/dashboard'; // Route ke halaman admin
        } elseif (Auth::user()->role == 'guru') {
            return '/guru/index'; // Route ke halaman guru
        } elseif (Auth::user()->role == 'siswa') {
            return '/siswa/index'; // Route ke halaman siswa
        }

        return '/home'; // Default jika tidak ada role
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    // Tambahkan metode logout
    public function logout(Request $request)
    {
        Auth::logout(); // Proses logout
        return redirect('/login')->with('status', 'Anda telah logout.'); // Redirect ke halaman login
    }
}
