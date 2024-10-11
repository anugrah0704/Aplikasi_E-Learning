@extends('layout.app')

@section('konten')
    <h1>Edit Mata Pelajaran</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('mapel.update', $mapel->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="kode_mapel">Kode Mapel</label>
            <input type="text" name="kode_mapel" class="form-control" value="{{ $mapel->kode_mapel }}" required>
        </div>
        <div class="form-group">
            <label for="nama_mapel">Nama Mapel</label>
            <input type="text" name="nama_mapel" class="form-control" value="{{ $mapel->nama_mapel }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
