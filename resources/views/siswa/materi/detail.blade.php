@extends('layout.app') <!-- Pastikan layout utama digunakan -->

@section('konten')

<div class="container content-wrapper">
    <div class="card">
        <div class="card-header">
            Modul / Materi
        </div>
        <div class="card-body">
            <h5 class="card-title">Detail Materi</h5>
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>Mata Pelajaran:</strong> {{ $materi->mapel->nama_mapel ?? 'Mata Pelajaran Tidak Ditemukan' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Guru / Pengajar:</strong> {{ $materi->user->username }}</p>
                </div>
            </div>

            <button class="back-btn" onclick="history.back()">Back</button>

            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Materi/Modul</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>{{ $materi->judul }}</td>
                        <td><a href="{{ Storage::url($materi->file_path) }}" class="btn btn-primary" download>Download</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
