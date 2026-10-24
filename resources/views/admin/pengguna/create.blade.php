@extends('layouts.dashboard')

@section('title', 'Tambah Pengguna')

@section('content')
<div style="max-width:750px; margin:0 auto;">

    <div style="margin-bottom:24px;">
        <h1 style="margin:0 0 8px;">Tambah Pengguna</h1>
        <p style="color:#64748b; margin:0;">
            Tambahkan akun pengguna baru ke dalam sistem pengaduan.
        </p>
    </div>

    <div style="background:#fff; padding:28px; border-radius:12px; box-shadow:0 4px 15px rgba(0,0,0,0.05);">

        @if ($errors->any())
            <div style="background:#fee2e2; color:#991b1b; padding:14px; border-radius:8px; margin-bottom:20px;">
                <strong>Periksa kembali data yang kamu masukkan:</strong>
                <ul style="margin-bottom:0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.pengguna.store') }}" method="POST">
            @csrf

            <div style="margin-bottom:20px;">
                <label for="username" style="display:block; font-weight:600; margin-bottom:8px;">
                    Username
                </label>

                <input
                    type="text"
                    id="username"
                    name="username"
                    value="{{ old('username') }}"
                    placeholder="Masukkan username"
                    maxlength="50"
                    required
                    style="width:100%; box-sizing:border-box; padding:12px; border:1px solid #cbd5e1; border-radius:8px;"
                >

                @error('username')
                    <small style="color:#dc2626;">{{ $message }}</small>
                @enderror
            </div>

            <div style="margin-bottom:20px;">
                <label for="email" style="display:block; font-weight:600; margin-bottom:8px;">
                    Email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="contoh@email.com"
                    required
                    style="width:100%; box-sizing:border-box; padding:12px; border:1px solid #cbd5e1; border-radius:8px;"
                >

                @error('email')
                    <small style="color:#dc2626;">{{ $message }}</small>
                @enderror
            </div>

            <div style="margin-bottom:20px;">
                <label for="password" style="display:block; font-weight:600; margin-bottom:8px;">
                    Password
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Minimal 8 karakter"
                    minlength="8"
                    autocomplete="new-password"
                    required
                    style="width:100%; box-sizing:border-box; padding:12px; border:1px solid #cbd5e1; border-radius:8px;"
                >

                @error('password')
                    <small style="color:#dc2626;">{{ $message }}</small>
                @enderror
            </div>

            <div style="margin-bottom:20px;">
                <label for="password_confirmation" style="display:block; font-weight:600; margin-bottom:8px;">
                    Konfirmasi Password
                </label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Ulangi password"
                    minlength="8"
                    autocomplete="new-password"
                    required
                    style="width:100%; box-sizing:border-box; padding:12px; border:1px solid #cbd5e1; border-radius:8px;"
                >
            </div>

            <div style="margin-bottom:28px;">
                <label for="role" style="display:block; font-weight:600; margin-bottom:8px;">
                    Role Pengguna
                </label>

                <select
                    id="role"
                    name="role"
                    required
                    style="width:100%; box-sizing:border-box; padding:12px; border:1px solid #cbd5e1; border-radius:8px; background:#fff;"
                >
                    <option value="user" {{ old('role', 'user') === 'user' ? 'selected' : '' }}>
                        User
                    </option>

                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>
                </select>

                @error('role')
                    <small style="color:#dc2626;">{{ $message }}</small>
                @enderror
            </div>

            <div style="display:flex; gap:10px; flex-wrap:wrap;">
                <button
                    type="submit"
                    class="btn btn-primary"
                    style="padding:12px 20px; cursor:pointer;"
                >
                    Simpan Pengguna
                </button>

                <a
                    href="{{ route('admin.pengguna.index') }}"
                    class="btn"
                    style="padding:12px 20px; text-decoration:none;"
                >
                    Kembali
                </a>
            </div>
        </form>

    </div>
</div>
@endsection