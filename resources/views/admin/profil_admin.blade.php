@extends('layout_new.app')
@section('konten')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Admin</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Ganti dengan path CSS Anda -->
</head>
<body>

<div class="container">
    <h1>Profil Admin</h1>

    <!-- Tampilkan pesan jika ada -->
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Tampilkan data admin -->
    <div class="card">
        <div class="card-body">
            <h5>Detail Admin</h5>
            <p><strong>Nama:</strong> {{ $admin->username }}</p>
            <p><strong>Email:</strong> {{ $admin->email }}</p>
            <p><strong>Role:</strong> {{ $admin->role }}</p>
            <p><strong>Tanggal Dibuat:</strong> {{ $admin->created_at }}</p>
            <p><strong>Terakhir Diperbarui:</strong> {{ $admin->updated_at }}</p>
        </div>
    </div>

    <!-- Tambahkan link kembali atau navigasi lain sesuai kebutuhan -->
    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Kembali ke Dashboard</a>
</div>

</body>
</html>

@endsection
