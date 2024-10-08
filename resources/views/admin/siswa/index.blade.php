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

    .button-group {
        display: flex;
        justify-content: flex-end; /* Menempatkan tombol di sebelah kanan */
        margin: 20px 60px; /* Memberikan margin atas dan bawah */
    }

    .button-group .btn {
        margin-left: 10px; /* Jarak antar tombol */
    }

    .btn-action {
        margin-right: 5px; /* Memberikan jarak antara tombol dalam tabel */
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1><i class="fas fa-users"></i> Daftar Siswa</h1>
        </div>
    </div>
</div>
<br>

<!-- Menampilkan Pesan Sukses -->
@if (session('success'))
    <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
@endif

<!-- Menampilkan Error Validasi -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li><i class="fas fa-exclamation-triangle"></i> {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Basic</h4>
                <div class="btn-group" role="group">
                    <!-- Tombol untuk membuka modal upload Excel -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadExcelModal">
                        <i class="fas fa-upload"></i> Upload Excel
                    </button>

                    <!-- Tombol untuk download template Excel -->
                    <button class="btn btn-success">
                        <a href="{{ route('admin.siswa.downloadTemplateSiswa') }}" style="color: white; text-decoration: none;">
                            <i class="fas fa-file-download"></i> Download Template
                        </a>
                    </button>

                    <!-- Tombol untuk membuka modal tambah siswa -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahSiswaModal">
                        <i class="fas fa-user-plus"></i> Tambah Siswa
                    </button>
                </div>
            </div>

            <!-- Modal Upload Excel -->
            <div class="modal fade" id="uploadExcelModal" tabindex="-1" aria-labelledby="uploadExcelModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="uploadExcelModalLabel">Upload File Excel</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Form untuk Upload File Excel -->
                            <form action="{{ route('admin.siswa.import') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="file" class="form-control" name="file" required>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-upload"></i> Upload
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

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
                                    <label for="nisn">NISN:</label>
                                    <input type="text" class="form-control" name="nisn" id="nisn" required>
                                </div>
                                <div class="form-group">
                                    <label for="username">Nama:</label>
                                    <input type="text" class="form-control" name="username" id="username" required>
                                </div>
                                <div class="form-group">
                                    <label for="telepon">Telepon:</label>
                                    <input type="text" class="form-control" name="telepon" id="telepon" required>
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
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>NISN</th>
                                <th>Nama</th>
                                <th>Telepon</th>
                                <th>Kelas</th>
                                <th>Gender</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>NISN</th>
                                <th>Nama</th>
                                <th>Telepon</th>
                                <th>Kelas</th>
                                <th>Gender</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($siswa as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->nis }}</td>
                                    <td>{{ $data->nisn }}</td>
                                    <td>{{ $data->username }}</td>
                                    <td>{{ $data->telepon }}</td>
                                    <td>{{ $data->kelas }}</td>
                                    <td>{{ $data->gender }}</td>
                                    <td>{{ $data->alamat }}</td>
                                    <td>
                                        <!-- Menempatkan semua tombol dalam satu kolom -->
                                        <div class="d-flex justify-content-center">
                                            <!-- Tombol Edit membuka modal edit -->
                                            <button class="btn btn-warning btn-action" data-toggle="modal" data-target="#editSiswaModal-{{ $data->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>

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
                                                                    <label for="nisn">NISN:</label>
                                                                    <input type="text" class="form-control" name="nisn" value="{{ $data->nisn }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="username">Nama:</label>
                                                                    <input type="text" class="form-control" name="username" value="{{ $data->username }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="kelas">Kelas:</label>
                                                                    <input type="text" class="form-control" name="kelas" value="{{ $data->kelas }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="telepon">Telepon:</label>
                                                                    <input type="text" class="form-control" name="telepon" value="{{ $data->telepon }}" required>
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

                                                                <button type="submit" class="btn btn-primary">
                                                                    <i class="fas fa-save"></i> Simpan
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Form untuk delete -->
                                            <form action="{{ route('admin.siswa.deleteSiswa', $data->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-action" onclick="return confirm('Yakin ingin menghapus?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
