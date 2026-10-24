
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard') - Sistem Pengaduan</title>

    @include('partials.styles')
</head>
<body>

@php
    $authUser = auth()->user();

    $menus = [
        [
            'label' => 'Dashboard',
            'route' => 'dashboard',
            'active' => request()->routeIs('dashboard'),
            'show' => true,
        ],

        [
            'label' => 'Form Aduan',
            'route' => 'laporan.create',
            'active' => request()->routeIs('laporan.create', 'laporan.store'),
            'show' => $authUser && $authUser->role === 'user',
        ],
        
        [
            'label' => 'Data Pengaduan',
            'route' => 'admin.laporan.index',
            'active' => request()->routeIs('admin.laporan.*'),
            'show' => $authUser && $authUser->role === 'admin',
        ],

        [
            'label' => 'Kelola Pengguna',
            'route' => 'admin.pengguna.index',
            'active' => request()->routeIs('admin.pengguna.*'),
            'show' => $authUser && $authUser->role === 'admin',
        ],
    ];
@endphp

<div class="dashboard-wrapper">

    <aside class="sidebar">
        <div class="sidebar-header">
            <h2>Sistem Pengaduan</h2>
            <p>Menu Navigasi</p>
        </div>

        <div class="side-title">Menu Utama</div>

        <nav class="sidebar-menu">
            @foreach ($menus as $menu)
                @if ($menu['show'])
                    <a
                        href="{{ route($menu['route']) }}"
                        class="side-link {{ $menu['active'] ? 'active' : '' }}"
                    >
                        {{ $menu['label'] }}
                    </a>
                @endif
            @endforeach
        </nav>

        <div class="side-title">Akun</div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="side-link logout-button">
                Logout
            </button>
        </form>
    </aside>

    <main class="main-content">

        <header class="topbar">
            <div>
                <h3>@yield('title', 'Dashboard')</h3>
            </div>

            <div class="user-info">
                <span>
                    {{ $authUser->username ?? $authUser->name ?? 'Pengguna' }}
                </span>

                <span class="role-label">
                    {{ ucfirst($authUser->role ?? 'user') }}
                </span>
            </div>
        </header>

        <section class="content-area">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </section>

    </main>

</div>

<style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: #f4f6f9;
        color: #263238;
    }

    .dashboard-wrapper {
        display: flex;
        min-height: 100vh;
    }

    .sidebar {
        width: 250px;
        min-width: 250px;
        background: #173b32;
        color: #fff;
        padding: 24px 16px;
    }

    .sidebar-header {
        padding: 0 10px 22px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        margin-bottom: 24px;
    }

    .sidebar-header h2 {
        font-size: 19px;
        margin: 0 0 8px;
    }

    .sidebar-header p {
        font-size: 13px;
        color: #c7d9d2;
        margin: 0;
    }

    .side-title {
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #b6cbc3;
        margin: 22px 10px 10px;
    }

    .sidebar-menu {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .side-link {
        display: block;
        width: 100%;
        padding: 12px 14px;
        border: none;
        border-radius: 7px;
        background: transparent;
        color: #fff;
        text-align: left;
        text-decoration: none;
        font-size: 14px;
        font-family: inherit;
        cursor: pointer;
        transition: background 0.2s;
    }

    .side-link:hover {
        background: #285649;
    }

    .side-link.active {
        background: #347a62;
        color: #fff;
        font-weight: bold;
    }

    .logout-button {
        margin-top: 4px;
    }

    .main-content {
        flex: 1;
        min-width: 0;
    }

    .topbar {
        min-height: 75px;
        padding: 18px 28px;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .topbar h3 {
        margin: 0;
        font-size: 20px;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 14px;
    }

    .role-label {
        padding: 5px 10px;
        border-radius: 20px;
        background: #e1eee8;
        color: #245b48;
        font-size: 12px;
    }

    .content-area {
        padding: 28px;
    }

    .alert {
        padding: 12px 16px;
        border-radius: 7px;
        margin-bottom: 20px;
    }

    .alert-success {
        background: #d9f2e3;
        color: #17663a;
    }

    .alert-error {
        background: #fde2e2;
        color: #a32020;
    }

    @media (max-width: 768px) {
        .dashboard-wrapper {
            flex-direction: column;
        }

        .sidebar {
            width: 100%;
            min-width: 0;
        }

        .topbar {
            padding: 16px;
            flex-wrap: wrap;
        }

        .content-area {
            padding: 16px;
        }
    }
</style>

</body>
</html>
