@extends('layouts.dashboard')

@section('title', 'Edit Pengguna')

@section('content')
<h1>Edit Pengguna</h1>

<div style="background:white; padding:24px; border-radius:12px; max-width:650px;">
    <form action="{{ route('admin.pengguna.update', $pengguna->id) }}"
          method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom:18px;">
            <label for="username">Username</label>
            <input
                id="username"
                type="text"
                name="username"
                value="{{ old('username', $pengguna->username) }}"
                maxlength="50"
                required
                style="display:block; width:100%; box-sizing:border-box; padding:12px; margin-top:8px;"
            >
            @error('username')
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>

        <div style="margin-bottom:18px;">
            <label for="email">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email', $pengguna->email) }}"
                required
                style="display:block; width:100%; box-sizing:border-box; padding:12px; margin-top:8px;"
            >
            @error('email')
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>

        <div style="margin-bottom:18px;">
            <label for="role">Role</label>
            <select
                id="role"
                name="role"
                required
                style="display:block; width:100%; box-sizing:border-box; padding:12px; margin-top:8px;"
            >
                <option value="user" {{ old('role', $pengguna->role) === 'user' ? 'selected' : '' }}>
                    User
                </option>

                <option value="admin" {{ old('role', $pengguna->role) === 'admin' ? 'selected' : '' }}>
                    Admin
                </option>
            </select>
            @error('role')
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>

        <hr style="margin:24px 0;">

        <h3>Ubah Password</h3>
        <p style="color:#64748b;">
            Kosongkan jika tidak ingin mengubah password.
        </p>

        <div style="margin-bottom:18px;">
            <label for="password">Password Baru</label>
            <input
                id="password"
                type="password"
                name="password"
                minlength="8"
                autocomplete="new-password"
                style="display:block; width:100%; box-sizing:border-box; padding:12px; margin-top:8px;"
            >
            @error('password')
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>

        <div style="margin-bottom:24px;">
            <label for="password_confirmation">Konfirmasi Password Baru</label>
            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                minlength="8"
                autocomplete="new-password"
                style="display:block; width:100%; box-sizing:border-box; padding:12px; margin-top:8px;"
            >
        </div>

        <button type="submit" class="btn btn-primary">
            Simpan Perubahan
        </button>

        <a href="{{ route('admin.pengguna.index') }}">
            Batal
        </a>
    </form>
</div>
@endsection