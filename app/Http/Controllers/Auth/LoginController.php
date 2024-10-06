<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

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
