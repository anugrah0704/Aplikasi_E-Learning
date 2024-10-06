@extends('layout.app')

@section('konten')
    <h2>Tambah Mata Pelajaran</h2>

    <form action="{{ route('courses.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nama Mata Pelajaran</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label for="users_id">Pilih Guru</label>
            <select name="users_id" class="form-control" required>
                <option value="">Pilih Guru</option>
                @foreach ($guru as $guru)
                    <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
