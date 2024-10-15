<?php

namespace App\Http\Controllers;

use App\Models\User;

class ProfileController extends Controller
{
    public function show($id)
    {
        // Mengambil user dengan peran siswa berdasarkan ID
        $user = User::where('id', $id)->where('role', 'siswa')->firstOrFail();

        return view('profile', compact('user'));
    }
}
