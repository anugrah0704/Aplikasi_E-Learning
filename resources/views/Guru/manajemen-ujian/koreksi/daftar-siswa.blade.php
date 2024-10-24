@extends('layout.app')

@section('konten')
<div class="container">
    <h2>Menu Manajemen Ujian / Tugas</h2>
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th>No</th>
                <th>NISN</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Nilai PG</th>
                <th>Nilai Essay</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($siswaSudahUjian as $index => $siswa)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $siswa->nisn }}</td>
                    <td>{{ $siswa->nama_siswa }}</td>
                    <td>{{ $siswa->kelas }}</td>
                    <td>
                        <button class="btn btn-primary">
                            {{ $siswa->nilai_pg }} <span class="badge bg-light mt-5">Analisa</span>
                        </button>
                    </td>
                    <td>
                        @if(is_null($siswa->nilai_essay))
                            <button class="btn btn-warning">Belum Koreksi</button>
                        @else
                            {{ $siswa->nilai_essay }}
                        @endif
                    </td>
                    <td>
                        @php
                            // Jika nilai essay masih null, anggap 0 agar tidak ada error penjumlahan
                            $total_nilai = $siswa->nilai_pg + ($siswa->nilai_essay ?? 0);
                        @endphp
                        {{ $total_nilai }}
                    </td>
                    <td>
                        <button class="btn btn-danger">Reset</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-between mt-3">
        <a href="#" class="btn btn-success">Cetak</a>
        <a href="#" class="btn btn-info">Export Excel</a>
    </div>
</div>
@endsection
