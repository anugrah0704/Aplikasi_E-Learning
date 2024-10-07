@extends('layout.app')

@section('konten')
<div class="container">
    <h1>Daftar Siswa</h1>
    <a href="{{ route('admin.siswa.create') }}" class="btn btn-primary">Tambah Siswa</a>

    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($siswa as $data)
                <tr>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->kelas }}</td>
                    <td>
                        <a href="{{ route('admin.siswa.edit', $data->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.siswa.delete', $data->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
