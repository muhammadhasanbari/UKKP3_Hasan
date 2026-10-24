<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Halaman awal: form login saja.
     */
    public function showLogin(): View
    {
        return view('auth.login');
    }

    /**
     * Halaman registrasi: form daftar saja.
     */
    public function showRegister(): View
    {
        return view('auth.register');
    }

    /**
     * Proses login hanya dengan username & password.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        if (! Auth::attempt($credentials, $remember)) {
            throw ValidationException::withMessages([
                'login' => 'Username atau password salah.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }

    /**
     * Proses registrasi, role otomatis "user".
     */
    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'username' => ['required', 'string', 'min:3', 'max:255', 'alpha_dash', 'unique:users,username'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = User::create([
            'username' => $data['username'],
            'password' => $data['password'],
            'role' => User::ROLE_USER,
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('dashboard.user')
            ->with('success', 'Registrasi berhasil. Selamat datang!');
    }

    /**
     * Proses logout.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
