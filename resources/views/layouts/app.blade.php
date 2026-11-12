<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Garuda Hub')</title>

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

        header {
            background: #173b67;
            color: white;
            padding: 18px 8%;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .brand h2 {
            margin: 0;
        }

        .brand p {
            margin: 5px 0 0;
            font-size: 13px;
            color: #dce7f5;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .nav-menu a,
        .nav-menu button {
            color: white;
            text-decoration: none;
            font-size: 14px;
        }

        .nav-link {
            padding: 9px 12px;
            border-radius: 5px;
        }

        .nav-link:hover {
            background: #28517e;
        }

        .nav-button {
            background: #dc3545;
            border: none;
            padding: 9px 13px;
            border-radius: 5px;
            cursor: pointer;
        }

        .user-info {
            font-size: 13px;
            color: #dce7f5;
            margin-right: 5px;
        }

        main {
            max-width: 1100px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-primary {
            background: #1769aa;
            color: white;
        }

        .btn-secondary {
            background: #e3e8ef;
            color: #263238;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .project-card {
            background: white;
            padding: 22px;
            border-radius: 9px;
            margin-bottom: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .project-card h3 {
            margin-top: 0;
        }

        .project-info {
            color: #667085;
            font-size: 14px;
            line-height: 1.8;
        }

        .alert {
            padding: 13px;
            background: #d1e7dd;
            color: #0f5132;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-top: 15px;
        }

        .pagination {
            margin-top: 20px;
        }

        @media (max-width: 650px) {
            header {
                padding: 18px 5%;
            }

            .navbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .nav-menu {
                width: 100%;
            }
        }

        @yield('extra-style')
    </style>
</head>
<body>

<header>
    <div class="navbar">

        <div class="brand">
            <h2>Garuda Hub</h2>
            <p>Platform Lelang Proyek IT</p>
        </div>

        <nav class="nav-menu">

            @auth
                <span class="user-info">
                    {{ auth()->user()->name }}
                    ({{ ucfirst(auth()->user()->role) }})
                </span>

                <a href="{{ route('dashboard') }}" class="nav-link">
                    Dashboard
                </a>

                <a href="{{ route('projects.index') }}" class="nav-link">
                    Daftar Proyek
                </a>

                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.users.index') }}" class="nav-link">
                        Manajemen Pengguna
                    </a>
                @endif

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-button">
                        Logout
                    </button>
                </form>

            @else

                <a href="{{ route('login') }}" class="nav-link">
                    Login
                </a>

                <a href="{{ route('register') }}" class="nav-link">
                    Register
                </a>

            @endauth

        </nav>

    </div>
</header>

<main>
    @yield('content')
</main>

</body>
</html>