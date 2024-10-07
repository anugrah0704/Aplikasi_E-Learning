@extends('layout.app')

@section('konten')

<div class="container">
    <h1>Edit Data Siswa</h1>

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

    <form action="{{ route('admin.siswa.updateSiswa', $siswa->id) }}" method="POST">
        @csrf
        @method('POST') <!-- Menggunakan spoofing metode POST untuk update -->

        <div class="form-group">
            <label for="nis">NIS:</label>
            <input type="text" class="form-control" name="nis" value="{{ $siswa->nis }}" required>
        </div>

        <div class="form-group">
            <label for="username">Nama:</label>
            <input type="text" class="form-control" name="username" value="{{ $siswa->username }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email (Opsional):</label>
            <input type="email" class="form-control" name="email" value="{{ $siswa->email }}">
        </div>

        <div class="form-group">
            <label for="kelas">Kelas:</label>
            <input type="text" class="form-control" name="kelas" value="{{ $siswa->kelas }}" required>
        </div>

        <div class="form-group">
            <label for="gender">Gender:</label>
            <select name="gender" class="form-control" required>
                <option value="Laki-laki" {{ $siswa->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ $siswa->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <input type="text" class="form-control" name="alamat" value="{{ $siswa->alamat }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

@endsection
