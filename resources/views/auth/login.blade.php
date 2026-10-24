@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="auth-wrap">
        <div class="card">
            <div class="card-header">
                <h1>Selamat Datang 👋</h1>
                <p>Masuk ke akun Anda untuk melanjutkan</p>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('login.attempt') }}">
                    @csrf

                    @if (session('error'))
                        <div class="alert alert-error">{{ session('error') }}</div>
                    @endif

                    @if ($errors->has('login'))
                        <div class="alert alert-error">{{ $errors->first('login') }}</div>
                    @endif

                    <div class="form-group">
                        <label for="login-username">Username</label>
                        <input type="text" id="login-username" name="username" value="{{ old('username') }}"
                               class="{{ $errors->has('username') ? 'invalid' : '' }}" placeholder="Masukkan username" autofocus>
                        @error('username')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="login-password">Password</label>
                        <input type="password" id="login-password" name="password"
                               class="{{ $errors->has('password') ? 'invalid' : '' }}" placeholder="Masukkan password">
                        @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="check">
                        <input type="checkbox" id="remember" name="remember" value="1">
                        <label for="remember" style="margin:0; font-weight:400;">Ingat saya</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Login</button>
                </form>

                <p style="text-align:center; margin-top:18px; font-size:.88rem; color:#64748b;">
                    Belum punya akun? <a href="{{ route('register') }}" style="color:#2563eb; font-weight:600; text-decoration:none;">Daftar di sini</a>
                </p>
            </div>
        </div>
    </div>
@endsection
