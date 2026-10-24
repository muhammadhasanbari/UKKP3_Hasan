
@extends('layouts.dashboard')

@section('content')
<div class="laporan-page">

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Tutup"></button>
        </div>
    @endif

    {{-- Judul halaman dan tombol --}}
    <div class="page-heading">
        <div class="heading-text">
            <h2>Laporan Pengaduan</h2>
            <p>Daftar laporan pengaduan yang telah kamu buat.</p>
        </div>

        <a href="{{ route('laporan.create') }}" class="btn-buat">
            <span>+</span> Buat Laporan
        </a>
    </div>

    {{-- Tabel laporan --}}
    <div class="card-laporan">
        <div class="card-header-laporan">
            <div>
                <h5>Daftar Laporan</h5>
                <p>Informasi pengaduan yang telah dikirim.</p>
            </div>
        </div>

        @if ($laporans->count())
            <div class="table-responsive">
                <table class="table tabel-laporan align-middle">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Judul Laporan</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Tanggal Kejadian</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($laporans as $laporan)
                            <tr>
                                <td>
                                    {{ $laporans->firstItem() + $loop->index }}
                                </td>

                                <td class="judul-laporan">
                                    {{ $laporan->judul }}
                                </td>

                                <td>{{ $laporan->kategori }}</td>

                                <td>{{ $laporan->lokasi }}</td>

                                <td class="tanggal-laporan">
                                    {{ \Carbon\Carbon::parse($laporan->tanggal_kejadian)->format('d-m-Y') }}
                                </td>

                                <td>
                                    @php
                                        $status = strtolower(trim($laporan->status ?? 'Menunggu'));
                                    @endphp

                                    @if (in_array($status, ['menunggu', 'pending']))
                                        <span class="status-badge status-menunggu">
                                            {{ $laporan->status }}
                                        </span>
                                    @elseif (in_array($status, ['diproses', 'diproses admin', 'proses']))
                                        <span class="status-badge status-diproses">
                                            {{ $laporan->status }}
                                        </span>
                                    @elseif (in_array($status, ['selesai', 'diterima']))
                                        <span class="status-badge status-selesai">
                                            {{ $laporan->status }}
                                        </span>
                                    @elseif (in_array($status, ['ditolak', 'ditolak admin']))
                                        <span class="status-badge status-ditolak">
                                            {{ $laporan->status }}
                                        </span>
                                    @else
                                        <span class="status-badge status-default">
                                            {{ $laporan->status ?? 'Menunggu' }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($laporans->hasPages())
                <div class="pagination-container">
                    {{ $laporans->links() }}
                </div>
            @endif
        @else
            {{-- Kondisi belum ada laporan --}}
            <div class="empty-state">
                <div class="empty-icon">📋</div>
                <h5>Belum Ada Laporan</h5>
                <p>Kamu belum membuat laporan pengaduan.</p>

                <a href="{{ route('laporan.create') }}" class="btn-buat">
                    + Buat Laporan Pertama
                </a>
            </div>
        @endif
    </div>

</div>

<style>
    .laporan-page {
        width: 100%;
        max-width: 100%;
        color: #1f2937;
    }

    .page-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 24px;
    }

    .heading-text h2 {
        margin: 0 0 8px;
        font-size: 26px;
        font-weight: 700;
        color: #183b32;
    }

    .heading-text p {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
        line-height: 1.6;
    }

    .btn-buat {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 7px;
        padding: 11px 17px;
        border: none;
        border-radius: 7px;
        background: #1684d8;
        color: #fff;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        white-space: nowrap;
        transition: background 0.2s ease;
    }

    .btn-buat:hover {
        background: #116bb0;
        color: #fff;
    }

    .btn-buat span {
        font-size: 19px;
        line-height: 1;
    }

    .alert {
        margin-bottom: 22px;
        border-radius: 8px;
    }

    .card-laporan {
        width: 100%;
        overflow: hidden;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.05);
    }

    .card-header-laporan {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px 22px;
        border-bottom: 1px solid #e5e7eb;
    }

    .card-header-laporan h5 {
        margin: 0 0 5px;
        font-size: 16px;
        font-weight: 700;
        color: #183b32;
    }

    .card-header-laporan p {
        margin: 0;
        color: #6b7280;
        font-size: 13px;
    }

    .table-responsive {
        width: 100%;
        overflow-x: auto;
    }

    .tabel-laporan {
        width: 100%;
        min-width: 760px;
        margin: 0;
        border-collapse: collapse;
    }

    .tabel-laporan thead th {
        padding: 15px 18px;
        background: #f8fafc;
        color: #374151;
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
        border-bottom: 1px solid #e5e7eb;
    }

    .tabel-laporan tbody td {
        padding: 17px 18px;
        color: #4b5563;
        font-size: 14px;
        border-bottom: 1px solid #f0f1f3;
        vertical-align: middle;
    }

    .tabel-laporan tbody tr:last-child td {
        border-bottom: none;
    }

    .tabel-laporan tbody tr:hover {
        background: #f9fbfa;
    }

    .tabel-laporan .judul-laporan {
        min-width: 160px;
        max-width: 280px;
        color: #1f2937;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    .tanggal-laporan {
        white-space: nowrap;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-menunggu {
        background: #fff2cc;
        color: #8a6100;
    }

    .status-diproses {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .status-selesai {
        background: #dcfce7;
        color: #166534;
    }

    .status-ditolak {
        background: #fee2e2;
        color: #b91c1c;
    }

    .status-default {
        background: #e5e7eb;
        color: #374151;
    }

    .pagination-container {
        display: flex;
        justify-content: flex-end;
        padding: 16px 20px;
        border-top: 1px solid #e5e7eb;
    }

    .pagination-container nav {
        margin: 0;
    }

    .empty-state {
        padding: 55px 20px;
        text-align: center;
    }

    .empty-icon {
        margin-bottom: 14px;
        font-size: 42px;
    }

    .empty-state h5 {
        margin-bottom: 8px;
        font-size: 18px;
        font-weight: 700;
    }

    .empty-state p {
        margin-bottom: 20px;
        color: #6b7280;
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .page-heading {
            align-items: flex-start;
        }

        .heading-text h2 {
            font-size: 22px;
        }

        .card-header-laporan {
            padding: 16px;
        }

        .pagination-container {
            justify-content: center;
            padding: 14px;
        }
    }
</style>
@endsection
