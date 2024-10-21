@extends('layout.app')

@section('konten')
    <div class="container">
        <h3>Menu Manajemen Ujian / Tugas</h3>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mapel</th>
                        <th>Pengajar</th> <!-- Menampilkan nama guru -->
                        <th>Jumlah Ujian</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ujians as $ujian)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $ujian->mapel ? $ujian->mapel->nama_mapel : 'Tidak ada mapel' }}</td>
                            <td>{{ $ujian->guru ? $ujian->guru->user->username : 'Tidak ada guru' }}</td>
                            <td>{{ $ujian->guru_count }}</td> <!-- Menampilkan jumlah ujian per guru -->
                            <td>
                                @if (isset($ujian->id))
                                    <a href="{{ route('siswa.ujian.view', $ujian->id) }}" class="btn btn-primary">
                                        <i class="fa fa-search"></i>
                                    </a>
                                @else
                                    <span>Tidak tersedia</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
