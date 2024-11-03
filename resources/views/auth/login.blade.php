@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header text-center bg-primary text-white py-4 rounded-top">
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
                            <input id="identifier" type="text" class="form-control @error('identifier') is-invalid @enderror" name="identifier" value="{{ old('identifier') }}" required autofocus placeholder="Enter your email/nis/nip">

                            @error('identifier')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <!-- Input password -->
                        <div class="mb-4">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Enter your password">

                            @error('password')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <!-- Remember me -->
                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Script untuk mengubah label dan input berdasarkan role
function updateLoginField() {
    const role = document.getElementById('role').value;
    const label = document.getElementById('dynamic-label');
    const input = document.getElementById('identifier');

    if (role === 'admin') {
        label.textContent = "{{ __('Email Address') }}";
        input.setAttribute('type', 'email');
        input.setAttribute('placeholder', 'Enter your email');
    } else if (role === 'siswa') {
        label.textContent = "{{ __('NIS') }}";
        input.setAttribute('type', 'text');
        input.setAttribute('placeholder', 'Enter your NIS');
    } else if (role === 'guru') {
        label.textContent = "{{ __('NIP') }}";
        input.setAttribute('type', 'text');
        input.setAttribute('placeholder', 'Enter your NIP');
    }
}
</script>

@endsection
