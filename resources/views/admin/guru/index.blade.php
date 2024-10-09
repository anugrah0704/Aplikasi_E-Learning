@extends('layout.app')

@section('konten')
<h1>Daftar Guru</h1>

<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($guru as $g)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $g->username }}</td>
            <td>{{ $g->email }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
