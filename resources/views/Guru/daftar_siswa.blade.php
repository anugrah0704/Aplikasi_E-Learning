@extends('layout_new.app')

@section('konten')

<div class="container mt-5">
    <h1 class="text-center mb-4">Daftar Siswa yang Diampu</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-hover shadow-sm">
            <thead class="table-primary">
                <tr class="text-center">
                    <th>No</th>
                    <th>Nama</th>
                    <th>NISN</th>
                    <th>Kelas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($siswa as $data)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->username }}</td>
                        <td>{{ $data->siswa->nisn ?? '-' }}</td>
                        <td>{{ $data->kelas->nama_kelas ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
