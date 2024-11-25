@extends('layout2.app')

@section('konten')
<div class="container mt-4">
    <h3 class="mb-4 text-center text-success">{{ $video->judul }}</h3>

    <div class="text-center">
        @if($video->file_path)
            <video width="100%" height="auto" controls>
                <source src="{{ asset('storage/' . $video->file_path) }}" type="video/mp4">
                Browser Anda tidak mendukung pemutar video HTML5.
            </video>
        @else
            <p class="text-danger">Video tidak ditemukan!</p>
        @endif
    </div>
</div>
@endsection
