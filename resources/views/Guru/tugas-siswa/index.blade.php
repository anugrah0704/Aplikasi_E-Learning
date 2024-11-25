@extends('layout2.app')

@section('konten')
<title>Tugas Siswa</title>
    <div class="container">
        <h3 class="my-4">Daftar Tugas yang Dibuat</h3>

        <!-- Tombol Tambah Tugas -->
        <div class="text-end mb-3">
            <a href="{{ route('guru.tugas-siswa.create') }}" class="btn btn-primary">+ Buat Tugas Baru</a>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Tabel Daftar Tugas -->
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Mata Pelajaran</th>
                            <th>Kelas</th>
                            <th>Pengumpulan Terakhir</th>
                            <th>File</th>
                            <th>lihat Soal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tugas as $index => $task)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $task->judul }}</td>
                                <td>{{ $task->mapel->nama_mapel ?? 'Mata Pelajaran Tidak Tersedia' }}</td>
                                <td>{{ $task->kelas->nama_kelas ?? 'Kelas Tidak Tersedia' }}</td>
                                <td>
                                    {{ $task->tanggal_pengumpulan ? \Carbon\Carbon::parse($task->tanggal_pengumpulan)->format('d M Y') : '-' }}
                                </td>
                                <td>
                                    @if($task->file)
                                        <a href="{{ asset('storage/' . $task->file) }}" class="btn btn-sm btn-success" target="_blank">
                                            <i class="fa-solid fa-download"></i>
                                        </a>
                                    @else
                                        <span class="text-muted">Tidak ada file</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('guru.tugas-siswa.showguru', $task->id) }}" class="btn btn-sm btn-info">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('guru.tugas-siswa.edit', $task->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('guru.tugas-siswa.destroy', $task->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada tugas yang tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
