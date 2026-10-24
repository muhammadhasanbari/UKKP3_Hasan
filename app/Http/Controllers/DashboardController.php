<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Redirect dashboard sesuai role pengguna.
     */
    public function index(Request $request): RedirectResponse
    {
        $user = $request->user();

        $route = match ($user->role) {
            'admin' => 'dashboard.admin',
            default => 'dashboard.user',
        };

        return redirect()->route($route);
    }

    /**
     * Dashboard khusus admin.
     */
    public function admin(Request $request): View
    {
        return view('dashboard.admin', ['user' => $request->user()]);
    }

    /**
     * Dashboard khusus user.
     */
    public function user(Request $request): View
    {
        return view('dashboard.user', ['user' => $request->user()]);
    }

    /**
     * Profil akun yang sedang login.
     */
    public function profil(Request $request): View
    {
        return view('dashboard.profil', ['user' => $request->user()]);
    }
}
