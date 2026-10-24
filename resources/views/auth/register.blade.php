
@extends('layouts.app')

@section('title', 'Registrasi')

@section('content')
    <div class="auth-wrap">
        <div class="card">
            <div class="card-header">
                <h1>Buat Akun Baru </h1>
                <p>Daftar untuk menggunakan aplikasi</p>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('register.store') }}">
                    @csrf

                    {{-- Username --}}
                    <div class="form-group">
                        <label for="reg-username">Username</label>
                        <input
                            type="text"
                            id="reg-username"
                            name="username"
                            value="{{ old('username') }}"
                            class="{{ $errors->has('username') ? 'invalid' : '' }}"
                            placeholder="Minimal 3 huruf, huruf/angka/-/_"
                            autocomplete="username"
                            minlength="3"
                            required
                            autofocus
                        >
                        @error('username')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="form-group">
                        <label for="reg-email">Email</label>
                        <input
                            type="email"
                            id="reg-email"
                            name="email"
                            value="{{ old('email') }}"
                            class="{{ $errors->has('email') ? 'invalid' : '' }}"
                            placeholder="Contoh: nama@email.com"
                            autocomplete="email"
                            required
                        >
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="form-group">
                        <label for="reg-password">Password</label>
                        <input
                            type="password"
                            id="reg-password"
                            name="password"
                            class="{{ $errors->has('password') ? 'invalid' : '' }}"
                            placeholder="Minimal 6 karakter"
                            autocomplete="new-password"
                            minlength="6"
                            required
                        >
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="form-group">
                        <label for="reg-password-confirmation">
                            Konfirmasi Password
                        </label>
                        <input
                            type="password"
                            id="reg-password-confirmation"
                            name="password_confirmation"
                            placeholder="Ulangi password"
                            autocomplete="new-password"
                            minlength="6"
                            required
                        >
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Daftar Sekarang
                    </button>
                </form>

                <p style="text-align:center; margin-top:18px; font-size:.88rem; color:#64748b;">
                    Sudah punya akun?
                    <a
                        href="{{ route('login') }}"
                        style="color:#2563eb; font-weight:600; text-decoration:none;"
                    >
                        Login di sini
                    </a>
                </p>
            </div>
        </div>
    </div>
@endsection
