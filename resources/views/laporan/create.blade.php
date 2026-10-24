 @extends('layouts.dashboard')

@section('title', 'Buat Pengaduan')

@section('content')
<div style="max-width:800px; margin:auto;">
    <div style="margin-bottom:24px;">
        <h1 style="margin:0 0 8px;">Form Laporan Pengaduan</h1>
        <p style="color:#64748b; margin:0;">
            Sampaikan pengaduan dengan jelas agar dapat ditindaklanjuti.
        </p>
    </div>

    <div style="background:#fff; padding:28px; border-radius:12px; box-shadow:0 4px 15px rgba(0,0,0,.05);">

        @if ($errors->any())
            <div style="background:#fee2e2; color:#991b1b; padding:14px; border-radius:8px; margin-bottom:20px;">
                <strong>Periksa kembali data laporan:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div style="margin-bottom:20px;">
                <label for="judul">Judul Pengaduan</label>
                <input id="judul" type="text" name="judul"
                    value="{{ old('judul') }}" maxlength="255"
                    placeholder="Contoh: Jalan rusak di depan sekolah"
                    required
                    style="display:block;width:100%;box-sizing:border-box;padding:12px;margin-top:8px;border:1px solid #cbd5e1;border-radius:8px;">
            </div>

            <div style="margin-bottom:20px;">
                <label for="kategori">Kategori Pengaduan</label>
                
<div class="mb-3">
    <label for="kategori" class="form-label">Kategori Pengaduan</label>
    <input
        type="text"
        name="kategori"
        id="kategori"
        class="form-control"
        placeholder="Contoh: Infrastruktur, Kebersihan, Keamanan"
        value="{{ old('kategori') }}"
        required
    >
    @error('kategori')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

            </div>

            <div style="margin-bottom:20px;">
                <label for="lokasi">Lokasi Kejadian</label>
                <input id="lokasi" type="text" name="lokasi"
                    value="{{ old('lokasi') }}" maxlength="255"
                    placeholder="Masukkan lokasi kejadian"
                    required
                    style="display:block;width:100%;box-sizing:border-box;padding:12px;margin-top:8px;border:1px solid #cbd5e1;border-radius:8px;">
            </div>

            <div style="margin-bottom:20px;">
                <label for="tanggal_kejadian">Tanggal Kejadian</label>
                <input id="tanggal_kejadian" type="date"
                    name="tanggal_kejadian"
                    value="{{ old('tanggal_kejadian') }}"
                    max="{{ date('Y-m-d') }}" required
                    style="display:block;width:100%;box-sizing:border-box;padding:12px;margin-top:8px;border:1px solid #cbd5e1;border-radius:8px;">
            </div>

            <div style="margin-bottom:20px;">
                <label for="isi">Isi Pengaduan</label>
                <textarea id="isi" name="isi" rows="6" maxlength="5000"
                    placeholder="Jelaskan kejadian, kondisi, dan masalah yang ingin dilaporkan..."
                    required
                    style="display:block;width:100%;box-sizing:border-box;padding:12px;margin-top:8px;border:1px solid #cbd5e1;border-radius:8px;">{{ old('isi') }}</textarea>
            </div>

            <div style="margin-bottom:24px;">
                <label for="foto">Foto Bukti (Opsional)</label>
                <input id="foto" type="file" name="foto"
                    accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                    style="display:block;width:100%;box-sizing:border-box;padding:12px;margin-top:8px;border:1px solid #cbd5e1;border-radius:8px;">
                <small style="color:#64748b;">
                    Format JPG, PNG, atau WEBP. Maksimal 2 MB.
                </small>
            </div>

            <div style="display:flex;gap:10px;flex-wrap:wrap;">
                <button type="submit" class="btn btn-primary">
                    Kirim Pengaduan
                </button>

                <a href="{{ route('laporan.index') }}"
                    class="btn" style="text-decoration:none;">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection