@extends('layout.app')

@section('konten')

<style>
    .container-fluid {
        background-color: white;
    }

    h1 {
        font-family: Times, sans-serif;
        margin-left: 60px;
        margin-top: 10px;
    }

    .content {
        margin-left: 60px;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1>Daftar Siswa</h1>
        </div>
    </div>
</div>
<br>

<!-- Menampilkan Pesan Sukses -->
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<!-- Menampilkan Error Validasi -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Tombol untuk membuka modal tambah siswa -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahSiswaModal">
    Tambah Siswa
</button>

<!-- Tabel Daftar Siswa -->
<table class="table mt-4">
    <thead>
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Kelas</th>
            <th>Gender</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($siswa as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->nis}}</td>
                <td>{{ $data->username }}</td>
                <td>{{ $data->email }}</td>
                <td>{{ $data->kelas }}</td>
                <td>{{ $data->gender }}</td>
                <td>{{ $data->alamat }}</td>
                <td>
                    <!-- Tombol Edit membuka modal edit -->
                    <button class="btn btn-warning" data-toggle="modal" data-target="#editSiswaModal-{{ $data->id }}">Edit</button>

                    <!-- Modal Edit Siswa -->
                    <div class="modal fade" id="editSiswaModal-{{ $data->id }}" tabindex="-1" aria-labelledby="editSiswaModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editSiswaModalLabel">Edit Siswa</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.siswa.updateSiswa', $data->id) }}" method="POST">
                                        @csrf
                                        @method('POST') <!-- Spoofing Method POST untuk Update -->

                                        <div class="form-group">
                                            <label for="nis">NIS:</label>
                                            <input type="text" class="form-control" name="nis" value="{{ $data->nis }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Nama:</label>
                                            <input type="text" class="form-control" name="username" value="{{ $data->username }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" class="form-control" name="email" value="{{ $data->email }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="kelas">Kelas:</label>
                                            <input type="text" class="form-control" name="kelas" value="{{ $data->kelas }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="gender">Gender:</label>
                                            <select name="gender" class="form-control" required>
                                                <option value="Laki-laki" {{ $data->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="Perempuan" {{ $data->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat:</label>
                                            <input type="text" class="form-control" name="alamat" value="{{ $data->alamat }}" required>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form untuk delete -->
                    <form action="{{ route('admin.siswa.deleteSiswa', $data->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal Tambah Siswa -->
<div class="modal fade" id="tambahSiswaModal" tabindex="-1" aria-labelledby="tambahSiswaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahSiswaModalLabel">Tambah Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Tambah Siswa -->
                <form action="{{ route('admin.siswa.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nis">NIS:</label>
                        <input type="text" class="form-control" name="nis" id="nis" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Nama:</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email (Opsional):</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas:</label>
                        <input type="text" class="form-control" name="kelas" id="kelas" required>
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender:</label>
                        <select name="gender" id="gender" class="form-control" required>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat:</label>
                        <input type="text" class="form-control" name="alamat" id="alamat" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
