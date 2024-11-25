@extends('layouts.app')

@section('content')
<body>
<div style="min-height: 100vh;
            background-image: url('{{ asset('images/login.jpg') }}');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;">
    <div class="card shadow-lg border-0 rounded-3" style="background: rgba(0, 0, 0, 0.7); color: white; width: 100%; max-width: 400px;">
        <div class="card-header text-center py-4">
            <h3 class="mb-0">{{ __('Login') }}</h3>
        </div>

        <div class="card-body p-4">
            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Input dinamis untuk email/NIS/NIP -->
                <div class="mb-4">
                    <label id="dynamic-label" for="identifier" class="form-label">{{ __('Email/NIS/NIP Address') }}</label>
                    <input id="identifier" type="text" class="form-control bg-dark text-white border-0 @error('identifier') is-invalid @enderror" name="identifier" value="{{ old('identifier') }}" required autofocus placeholder="Enter your email/nis/nip">

                    @error('identifier')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <!-- Input password -->
                <div class="mb-4">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control bg-dark text-white border-0 @error('password') is-invalid @enderror" name="password" required placeholder="Enter your password">

                    @error('password')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg" style="background: #6a1b9a; border-color: #6a1b9a;">
                        {{ __('Login') }}
                    </button>
                </div>
            </form>


        </div>
    </div>
</div>
</body>
@endsection
