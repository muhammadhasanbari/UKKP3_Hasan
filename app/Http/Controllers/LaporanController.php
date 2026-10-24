<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    /**
     * Menampilkan daftar laporan milik user yang sedang login.
     */
    public function index()
    {
        $laporans = Laporan::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('laporan.index', compact('laporans'));
    }

    /**
     * Menampilkan form pengaduan.
     */
    public function create()
    {
        return view('laporan.create');
    }

    /**
     * Menyimpan laporan pengaduan.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'tanggal_kejadian' => 'required|date',
            'isi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'judul.required' => 'Judul pengaduan wajib diisi.',
            'kategori.required' => 'Kategori pengaduan wajib diisi.',
            'kategori.string' => 'Kategori harus berupa teks.',
            'lokasi.required' => 'Lokasi kejadian wajib diisi.',
            'tanggal_kejadian.required' => 'Tanggal kejadian wajib diisi.',
            'tanggal_kejadian.date' => 'Tanggal kejadian tidak valid.',
            'isi.required' => 'Isi pengaduan wajib diisi.',
            'foto.image' => 'File bukti harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat JPG, JPEG, PNG, atau WEBP.',
            'foto.max' => 'Ukuran foto maksimal 2 MB.',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')
                ->store('laporan', 'public');
        }

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'Menunggu';

        Laporan::create($validated);

        return redirect()
            ->route('laporan.index')
            ->with('success', 'Laporan pengaduan berhasil dikirim.');
    }
}
