@extends('layout.app')

@section('konten')
    <h2>Edit Mata Pelajaran</h2>

    <form action="{{ route('courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nama Mata Pelajaran</label>
            <input type="text" name="name" value="{{ $course->name }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" class="form-control" required>{{ $course->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="users_id">Pilih Guru</label>
            <select name="users_id" class="form-control" required>
                @foreach ($guru as $guru)
                    <option value="{{ $guru->id }}" {{ $guru->id == $course->guru_id ? 'selected' : '' }}>
                        {{ $guru->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
