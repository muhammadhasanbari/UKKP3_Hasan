<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pengaduan')</title>
    @include('partials.styles')
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="{{ route('login') }}" class="brand">Pengaduan</a>
            @auth
                <div class="nav-user">
                    <span class="badge badge-{{ auth()->user()->role }}">{{ auth()->user()->role }}</span>
                    <span>{{ auth()->user()->username }}</span>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">Logout</button>
                    </form>
                </div>
            @else
                <div class="nav-user">
                    <a href="{{ route('login') }}" style="color:#e2e8f0; text-decoration:none;">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm" style="text-decoration:none;">Daftar</a>
                </div>
            @endauth
        </div>
    </nav>

    <main>@yield('content')</main>
</body>
</html>
