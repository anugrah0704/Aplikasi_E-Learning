@extends('layout.app')

@section('konten')
    <div class="container">
        <h3>Informasi Ujian/Tugas</h3>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Ujian Online</h5>

                <table class="table table-bordered">
                    <tr>
                        <th>Nama Ujian</th>
                        <td>: {{ $ujian->judul }}</td>
                    </tr>
                    <tr>
                        <th>Mata Pelajaran</th>
                        <td>: {{ $ujian->mapel->nama_mapel ?? 'Tidak Ada' }}</td>
                    </tr>
                    <tr>
                        <th>Pengajar</th>
                        <td>: {{ $ujian->guru->user->username ?? 'Tidak Ada' }}</td>
                    </tr>
                    <tr>
                        <th>Batas Waktu Ujian</th>
                        <td>: {{ $ujian->waktu_pengerjaan }} Menit</td>
                    </tr>
                    <tr>
                        <th>Status Soal Pilihan Ganda</th>
                        <td>
                            @if ($ujian->soal_pilihan_ganda > 0)
                                : Ada {{ $ujian->soal_pilihan_ganda }} Soal Pilihan Ganda
                            @else
                                : Tidak Ada Soal Pilihan Ganda
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Status Soal Essay</th>
                        <td>
                            @if ($ujian->soal_essay > 0)
                                : Ada {{ $ujian->soal_essay }} Soal Essay
                            @else
                                : Tidak Ada Soal Essay
                            @endif
                        </td>
                    </tr>
                </table>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <h5>Pilihan Ganda</h5>
                        @if ($ujian->soal_pilihan_ganda > 0)
                            <a href="{{ route('siswa.ujian.mulai.pilgan', $ujian->id) }}" class="btn btn-primary btn-block">
                                Mulai Kerjakan
                            </a>
                        @else
                            <button class="btn btn-secondary btn-block" disabled>Tidak Tersedia</button>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <h5>Essay</h5>
                        @if ($ujian->soal_essay > 0)
                            <a href="{{ route('siswa.ujian.mulai.essay', $ujian->id) }}" class="btn btn-primary btn-block">
                                Mulai Kerjakan
                            </a>
                        @else
                            <button class="btn btn-secondary btn-block" disabled>Tidak Tersedia</button>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
