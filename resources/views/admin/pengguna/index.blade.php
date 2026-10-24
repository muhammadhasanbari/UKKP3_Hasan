@extends('layouts.dashboard')

@section('title', 'Kelola Pengguna')

@section('content')
<div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; margin-bottom:24px;">
    <div>
        <h1 style="margin:0 0 8px;">Kelola Pengguna</h1>
        <p style="margin:0; color:#64748b;">
            Kelola akun admin dan pengguna.
        </p>
    </div>

    <a href="{{ route('admin.pengguna.create') }}"
       class="btn btn-primary">
        + Tambah Pengguna
    </a>
</div>

<div style="background:white; padding:20px; border-radius:12px; overflow-x:auto;">
    <table style="width:100%; border-collapse:collapse; text-align:left;">
        <thead>
            <tr style="background:#f1f5f9;">
                <th style="padding:12px;">No.</th>
                <th style="padding:12px;">Username</th>
                <th style="padding:12px;">Email</th>
                <th style="padding:12px;">Role</th>
                <th style="padding:12px;">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($pengguna as $user)
                <tr style="border-bottom:1px solid #e2e8f0;">
                    <td style="padding:12px;">
                        {{ $pengguna->firstItem() + $loop->index }}
                    </td>

                    <td style="padding:12px;">
                        {{ $user->username }}
                    </td>

                    <td style="padding:12px;">
                        {{ $user->email }}
                    </td>

                    <td style="padding:12px;">
                        <span class="badge badge-{{ $user->role }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>

                    <td style="padding:12px; white-space:nowrap;">
                        <a href="{{ route('admin.pengguna.edit', $user->id) }}"
                           class="btn btn-primary btn-sm">
                            Edit
                        </a>

                        <form
                            action="{{ route('admin.pengguna.destroy', $user->id) }}"
                            method="POST"
                            style="display:inline;"
                            onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')"
                        >
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-sm"
                                    style="background:#dc2626; color:white; border:none; cursor:pointer;">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5"
                        style="padding:24px; text-align:center;">
                        Belum ada pengguna.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top:20px;">
        {{ $pengguna->links() }}
    </div>
</div>
@endsection