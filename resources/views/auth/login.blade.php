@extends('layouts.app')

@section('content')

@if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Dropdown untuk memilih role -->
                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Login As') }}</label>

                            <div class="col-md-6">
                                <select id="role" class="form-select" name="role" onchange="updateLoginField()" required>
                                    <option value="admin">{{ __('Admin') }}</option>
                                    <option value="siswa">{{ __('Siswa') }}</option>
                                    <option value="guru">{{ __('Guru') }}</option>
                                </select>
                            </div>
                        </div>

                        <!-- Input dinamis untuk email/NIS/NIP -->
                        <div class="row mb-3">
                            <label id="dynamic-label" for="identifier" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="identifier" type="text" class="form-control @error('identifier') is-invalid @enderror" name="identifier" value="{{ old('identifier') }}" required autofocus>

                                @error('identifier')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Input password -->
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Remember me -->
                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
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
