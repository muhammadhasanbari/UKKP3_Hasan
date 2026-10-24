
@extends('layouts.dashboard')

@section('title', 'Data Pengaduan')

@section('content')
<div class="admin-laporan-page">

    {{-- Header halaman --}}
    <div class="admin-laporan-heading">
        <div>
            <h2>Data Pengaduan</h2>
            <p>Daftar seluruh laporan pengaduan yang dikirim oleh pengguna.</p>
        </div>
    </div>

    {{-- Card tabel --}}
    <div class="admin-laporan-card">

        <div class="admin-laporan-card-header">
            <div>
                <h5>Daftar Seluruh Pengaduan</h5>
                <p>Kelola dan pantau laporan yang masuk.</p>
            </div>

            <span class="jumlah-laporan">
                Total: {{ $laporans->total() }} laporan
            </span>
        </div>

        @if ($laporans->count() > 0)

            <div class="admin-laporan-table-wrapper">
                <table class="admin-laporan-table">
                    <thead>
                        <tr>
                            <th class="kolom-no">No.</th>
                            <th class="kolom-nama">Nama Pelapor</th>
                            <th class="kolom-judul">Judul</th>
                            <th class="kolom-kategori">Kategori</th>
                            <th class="kolom-lokasi">Lokasi</th>
                            <th class="kolom-tanggal">Tanggal Kejadian</th>
                            <th class="kolom-isi">Isi Laporan</th>
                            <th class="kolom-status">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($laporans as $laporan)
                            <tr>
                                <td class="text-center">
                                    {{ $laporans->firstItem() + $loop->index }}
                                </td>

                                <td class="nama-pelapor">
                                    {{ $laporan->user->username
                                        ?? $laporan->user->name
                                        ?? 'User ID: ' . $laporan->user_id }}
                                </td>

                                <td class="judul-pengaduan">
                                    {{ $laporan->judul }}
                                </td>

                                <td>{{ $laporan->kategori }}</td>

                                <td>{{ $laporan->lokasi }}</td>

                                <td class="tanggal-pengaduan">
                                    {{ \Carbon\Carbon::parse($laporan->tanggal_kejadian)->format('d-m-Y') }}
                                </td>

                                <td class="isi-pengaduan">
                                    {{ $laporan->isi }}
                                </td>

                                <td>
                                    @php
                                        $status = strtolower(trim($laporan->status ?? 'menunggu'));
                                    @endphp

                                    @if (in_array($status, ['menunggu', 'pending']))
                                        <span class="status-admin status-menunggu">
                                            {{ $laporan->status }}
                                        </span>
                                    @elseif (in_array($status, ['diproses', 'proses', 'diproses admin']))
                                        <span class="status-admin status-diproses">
                                            {{ $laporan->status }}
                                        </span>
                                    @elseif (in_array($status, ['selesai', 'diterima']))
                                        <span class="status-admin status-selesai">
                                            {{ $laporan->status }}
                                        </span>
                                    @elseif (in_array($status, ['ditolak', 'ditolak admin']))
                                        <span class="status-admin status-ditolak">
                                            {{ $laporan->status }}
                                        </span>
                                    @else
                                        <span class="status-admin status-default">
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
            <div class="admin-laporan-pagination">
                {{ $laporans->links() }}
            </div>

        @else

            <div class="admin-laporan-empty">
                <div class="admin-laporan-empty-icon">📋</div>
                <h5>Belum Ada Pengaduan</h5>
                <p>Laporan yang dikirim pengguna akan muncul di sini.</p>
            </div>

        @endif
    </div>
</div>

<style>
    /* Area halaman: gunakan seluruh lebar konten */
    .admin-laporan-page {
        display: block;
        width: 100%;
        max-width: none;
        min-width: 0;
        color: #1f2937;
    }

    .admin-laporan-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    .admin-laporan-heading h2 {
        margin: 0 0 8px;
        color: #183b32;
        font-size: 26px;
        font-weight: 700;
    }

    .admin-laporan-heading p {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
        line-height: 1.6;
    }

    /* Card utama dibuat selebar area konten */
    .admin-laporan-card {
        display: block;
        width: 100%;
        max-width: none;
        min-width: 0;
        overflow: hidden;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.05);
    }

    .admin-laporan-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        padding: 20px 22px;
        border-bottom: 1px solid #e5e7eb;
    }

    .admin-laporan-card-header h5 {
        margin: 0 0 5px;
        color: #183b32;
        font-size: 16px;
        font-weight: 700;
    }

    .admin-laporan-card-header p {
        margin: 0;
        color: #6b7280;
        font-size: 13px;
    }

    .jumlah-laporan {
        display: inline-block;
        padding: 7px 12px;
        background: #e8f3ee;
        color: #205c48;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    /* Tabel melebar; jika layar tidak cukup, bisa digeser */
    .admin-laporan-table-wrapper {
        display: block;
        width: 100%;
        max-width: 100%;
        overflow-x: auto;
        overflow-y: hidden;
    }

    .admin-laporan-table {
        width: 100%;
        min-width: 1150px;
        margin: 0;
        border-collapse: collapse;
        table-layout: auto;
    }

    .admin-laporan-table thead th {
        padding: 15px 14px;
        background: #f5f8f7;
        color: #374151;
        border-bottom: 1px solid #e5e7eb;
        font-size: 13px;
        font-weight: 700;
        text-align: left;
        white-space: nowrap;
    }

    .admin-laporan-table tbody td {
        padding: 16px 14px;
        color: #4b5563;
        border-bottom: 1px solid #edf0f2;
        font-size: 13px;
        line-height: 1.6;
        vertical-align: top;
    }

    .admin-laporan-table tbody tr:last-child td {
        border-bottom: none;
    }

    .admin-laporan-table tbody tr:hover {
        background: #f8fbf9;
    }

    .admin-laporan-table .kolom-no {
        width: 55px;
    }

    .admin-laporan-table .kolom-nama {
        min-width: 150px;
    }

    .admin-laporan-table .kolom-judul {
        min-width: 150px;
    }

    .admin-laporan-table .kolom-kategori {
        min-width: 120px;
    }

    .admin-laporan-table .kolom-lokasi {
        min-width: 150px;
    }

    .admin-laporan-table .kolom-tanggal {
        min-width: 145px;
    }

    .admin-laporan-table .kolom-isi {
        min-width: 250px;
    }

    .admin-laporan-table .kolom-status {
        min-width: 120px;
    }

    .nama-pelapor,
    .judul-pengaduan {
        overflow-wrap: anywhere;
    }

    .isi-pengaduan {
        min-width: 250px;
        max-width: 400px;
        white-space: normal;
        overflow-wrap: anywhere;
    }

    .tanggal-pengaduan {
        white-space: nowrap;
    }

    .status-admin {
        display: inline-block;
        padding: 6px 11px;
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

    .admin-laporan-pagination {
        display: flex;
        justify-content: flex-end;
        padding: 16px 20px;
        border-top: 1px solid #e5e7eb;
    }

    .admin-laporan-pagination nav {
        margin: 0;
    }

    .admin-laporan-empty {
        padding: 55px 20px;
        text-align: center;
    }

    .admin-laporan-empty-icon {
        margin-bottom: 14px;
        font-size: 42px;
    }

    .admin-laporan-empty h5 {
        margin-bottom: 8px;
        font-weight: 700;
    }

    .admin-laporan-empty p {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .admin-laporan-heading h2 {
            font-size: 22px;
        }

        .admin-laporan-card-header {
            padding: 16px;
        }

        .admin-laporan-pagination {
            justify-content: center;
            padding: 14px;
        }
    }
</style>
@endsection
