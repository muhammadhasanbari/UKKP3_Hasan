<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PenggunaController extends Controller
{
    private function cekAdmin(): void
    {
        abort_unless(
            auth()->check() && auth()->user()->role === 'admin',
            403,
            'Akses hanya untuk admin.'
        );
    }

    // READ: Menampilkan daftar pengguna
    public function index()
    {
        $this->cekAdmin();

        $pengguna = User::orderBy('id', 'desc')->paginate(10);

        return view('admin.pengguna.index', compact('pengguna'));
    }

    // Menampilkan form tambah pengguna
    public function create()
    {
        $this->cekAdmin();

        return view('admin.pengguna.create');
    }

    // CREATE: Menyimpan pengguna baru
    public function store(Request $request)
    {
        $this->cekAdmin();

        $data = $request->validate([
            'username' => [
                'required', 'string', 'max:50',
                'unique:users,username',
            ],
            'email' => [
                'required', 'email', 'max:255',
                'unique:users,email',
            ],
            'password' => [
                'required', 'string', 'min:8', 'confirmed',
            ],
            'role' => [
                'required', Rule::in(['admin', 'user']),
            ],
        ]);

        $user = new User();
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->role = $data['role'];
        $user->save();

        return redirect()
            ->route('admin.pengguna.index')
            ->with('success', 'Pengguna berhasil ditambahkan.');
    }

    // Menampilkan form edit
    public function edit(User $pengguna)
    {
        $this->cekAdmin();

        return view('admin.pengguna.edit', compact('pengguna'));
    }

    // UPDATE: Memperbarui pengguna
    public function update(Request $request, User $pengguna)
    {
        $this->cekAdmin();

        $data = $request->validate([
            'username' => [
                'required', 'string', 'max:50',
                Rule::unique('users', 'username')->ignore($pengguna->id),
            ],
            'email' => [
                'required', 'email', 'max:255',
                Rule::unique('users', 'email')->ignore($pengguna->id),
            ],
            'role' => [
                'required', Rule::in(['admin', 'user']),
            ],
            'password' => [
                'nullable', 'string', 'min:8', 'confirmed',
            ],
        ]);

        // Jangan menghilangkan akses admin dari akun sendiri.
        if (
            $pengguna->id === auth()->id()
            && $data['role'] !== 'admin'
        ) {
            return back()
                ->withInput()
                ->with('error', 'Role akun yang sedang digunakan tidak dapat diubah menjadi user.');
        }

        // Jangan menghapus admin terakhir melalui perubahan role.
        if (
            $pengguna->role === 'admin'
            && $data['role'] !== 'admin'
            && User::where('role', 'admin')->count() <= 1
        ) {
            return back()
                ->withInput()
                ->with('error', 'Tidak dapat mengubah role admin terakhir.');
        }

        $pengguna->username = $data['username'];
        $pengguna->email = $data['email'];
        $pengguna->role = $data['role'];

        if (!empty($data['password'])) {
            $pengguna->password = Hash::make($data['password']);
        }

        $pengguna->save();

        return redirect()
            ->route('admin.pengguna.index')
            ->with('success', 'Pengguna berhasil diperbarui.');
    }

    // DELETE: Menghapus pengguna
    public function destroy(User $pengguna)
    {
        $this->cekAdmin();

        if ($pengguna->id === auth()->id()) {
            return back()->with(
                'error',
                'Kamu tidak dapat menghapus akun sendiri.'
            );
        }

        if (
            $pengguna->role === 'admin'
            && User::where('role', 'admin')->count() <= 1
        ) {
            return back()->with(
                'error',
                'Admin terakhir tidak dapat dihapus.'
            );
        }

        $pengguna->delete();

        return redirect()
            ->route('admin.pengguna.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}