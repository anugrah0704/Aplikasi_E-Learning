<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        // Cek apakah user yang login
        if (Auth::check()) {
            // Cek apakah peran user sesuai
            if (Auth::user()->role === $role) {
                return $next($request);
            }
        }

        // Jika tidak sesuai, redirect atau tampilkan pesan error
        return redirect('/home')->with('error', 'Akses ditolak, Anda bukan siswa.');
    }
}
