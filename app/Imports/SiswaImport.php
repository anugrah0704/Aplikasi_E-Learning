<?php

// app/Imports/SiswaImport.php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel, WithHeadingRow
{
    /**
     * Method untuk membuat model user dari baris Excel
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Pastikan kolom dari excel sesuai dengan tabel users
        return new User([
            'nis'      => $row['nis'],  // Sesuaikan dengan header kolom di file Excel
            'nisn'      => $row['nisn'],
            'username' => $row['username'],
            'telepon'    => $row['telepon'],
            'kelas'    => $row['kelas'],
            'gender'   => $row['gender'],
            'alamat'   => $row['alamat'],
            'role'     => 'siswa', // Set role sebagai siswa
            'password' => Hash::make('123456') // Password default, bisa diubah sesuai kebutuhan
        ]);
    }
}
