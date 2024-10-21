@extends('layout.app')

@section('konten')
    <div class="container">
        <h3>Menu Manajemen Ujian / Tugas</h3>

        <div class="card">
            <div class="card-header">
                Daftar Ujian Oleh {{ $ujian->guru->user->username ?? 'Guru Tidak Ditemukan' }}
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Ujian</th>
                            <th>Mapel</th>
                            <th>Waktu</th>
                            <th>Kerjakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>{{ $ujian->judul }}</td>
                            <td>{{ $ujian->mapel->nama_mapel ?? 'Mapel Tidak Ditemukan' }}</td>
                            <td>{{ $ujian->waktu_pengerjaan }} Menit</td>
                            <td>
                                <a href="{{ route('siswa.ujian.kerjakan', $ujian->id) }}" class="btn btn-primary">
                                    <i class="fa fa-play"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
