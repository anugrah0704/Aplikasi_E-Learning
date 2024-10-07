@extends('layout.app')
@section('konten')

    <h2>Manajemen Mata Pelajaran</h2>

    <a href="{{ route('courses.create') }}" class="btn btn-primary">Tambah Mata Pelajaran</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card">
        <div class="card-header">
          <span class="h5 my-2"><i class="fa-solid fa-list"></i> Jadwal Mengajar Kelas </span>
        </div>
        <div class="card-body">
          <table class="table table-hover" id="datatablesSimple">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Mata Pelajaran</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Guru</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->description }}</td>
                        <td>{{ $course->guru->name ?? 'Belum ditugaskan' }}</td>
                        <td>
                            <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>

@endsection
