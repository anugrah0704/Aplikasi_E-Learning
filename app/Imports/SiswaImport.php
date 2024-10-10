<?php
namespace App\Imports;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Hash;

class SiswaImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $key => $row)
        {
            // Skip the first row (header)
            if ($key == 0) {
                continue;
            }


            // Create user for each siswa
            $user = User::create([
                'username' => $row[2], // Kolom username di Excel
                'password' => bcrypt('123456'), // Password default
                'role' => 'siswa',
            ]);

            // Create siswa record
            Siswa::create([
                'user_id' => $user->id, // Hubungkan dengan user yang baru dibuat
                'nis' => $row[0], // Kolom NIS di Excel
                'nisn' => $row[1], // Kolom NISN di Excel
                'telepon' => $row[3], // Kolom Telepon di Excel
                'kelas' => $row[4], // Kolom Kelas di Excel
                'gender' => $row[5], // Kolom Gender di Excel
                'alamat' => $row[6], // Kolom Alamat di Excel
                'tgl_lahir' => $row[7], // Kolom Tanggal Lahir di Excel

            ]);
        }
    }



}
