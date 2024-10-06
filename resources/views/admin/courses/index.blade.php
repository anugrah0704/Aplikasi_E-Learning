@extends('layout.app')
@section('konten')

    <h2>Manajemen Mata Pelajaran</h2>

    <a href="{{ route('courses.create') }}" class="btn btn-primary">Tambah Mata Pelajaran</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mata Pelajaran</th>
                <th>Deskripsi</th>
                <th>Guru</th>
                <th>Aksi</th>
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
@endsection
