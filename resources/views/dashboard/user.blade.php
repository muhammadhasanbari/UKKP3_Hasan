@extends('layouts.dashboard')

@section('title', 'Dashboard User')

@section('content')
    <h1>Dashboard User</h1>

    <p>Selamat datang di sistem pengaduan.</p>

    <div style="display:flex;gap:16px;flex-wrap:wrap;margin-top:24px;">
        <a href="{{ route('laporan.create') }}"
           class="btn btn-primary">
            + Buat Laporan Pengaduan
        </a>

        <a href="{{ route('laporan.index') }}"
           class="btn">
            Lihat Laporan Saya
        </a>
    </div>
@endsection