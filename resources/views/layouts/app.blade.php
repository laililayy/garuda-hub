
<!DOCTYPE html>
{{-- NIM: 252410102035 --}}
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Garuda Hub')</title>

    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #173b67;
            --primary-light: #eff6ff;
            --navy: #102b4c;
            --background: #f5f7fb;
            --surface: #ffffff;
            --text: #1e293b;
            --muted: #64748b;
            --border: #e5eaf1;
            --success: #16a34a;
            --danger: #dc3545;
            --radius: 14px;
            --shadow: 0 4px 20px rgba(15, 35, 65, 0.045);
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            background: var(--background);
            color: var(--text);
            font-size: 14px;
            line-height: 1.6;
        }

        /* NAVBAR */

        header {
            background: var(--navy);
            color: white;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 3px 18px rgba(15, 35, 65, 0.12);
        }

        .navbar {
            max-width: 1440px;
            min-height: 76px;
            margin: auto;
            padding: 12px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 24px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .brand-mark {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #3b82f6;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 21px;
            font-weight: 800;
            box-shadow: 0 3px 10px rgba(59, 130, 246, 0.3);
        }

        .brand h2 {
            margin: 0;
            font-size: 20px;
            font-weight: 750;
            letter-spacing: -0.5px;
        }

        .brand p {
            margin: 1px 0 0;
            font-size: 11px;
            color: #b8cbe2;
            letter-spacing: 0.3px;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 6px;
            flex-wrap: wrap;
        }

        .nav-menu a,
        .nav-menu button {
            color: white;
            text-decoration: none;
            font-family: inherit;
            font-size: 13px;
        }

        .nav-link {
            display: inline-flex;
            align-items: center;
            padding: 9px 13px;
            border-radius: 9px;
            color: #dbeafe !important;
            transition: 0.2s ease;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.10);
            color: white !important;
        }

        .nav-link.active {
            background: rgba(255, 255, 255, 0.14);
            color: white !important;
            font-weight: 600;
        }

        .user-info {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #dbeafe;
            padding: 7px 11px;
            border-right: 1px solid rgba(255, 255, 255, 0.15);
            margin-right: 4px;
            font-size: 12px;
        }

        .user-avatar {
            width: 29px;
            height: 29px;
            border-radius: 50%;
            background: #dbeafe;
            color: #1d4ed8;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 12px;
        }

        .nav-button {
            background: rgba(255, 255, 255, 0.09);
            border: 1px solid rgba(255, 255, 255, 0.18);
            padding: 9px 14px;
            border-radius: 9px;
            cursor: pointer;
            transition: 0.2s;
        }

        .nav-button:hover {
            background: #dc3545;
            border-color: #dc3545;
        }

        /* PAGE */

        main {
            width: 100%;
            max-width: 1320px;
            min-height: calc(100vh - 76px);
            margin: 0 auto;
            padding: 36px 32px 60px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 18px;
            margin-bottom: 28px;
        }

        .page-header h1 {
            margin: 0;
            font-size: 27px;
            font-weight: 750;
            color: var(--navy);
            letter-spacing: -0.7px;
        }

        .page-header p {
            margin: 6px 0 0;
            color: var(--muted);
            font-size: 14px;
        }

        h2, h3, h4 {
            color: var(--navy);
        }

        /* CARD */

        .card,
        .project-card,
        .stats-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }

        .card {
            padding: 24px;
            margin-bottom: 22px;
        }

        .project-card {
            padding: 24px;
            margin-bottom: 18px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .project-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(15, 35, 65, 0.07);
        }

        .project-card h3 {
            margin-top: 0;
            margin-bottom: 10px;
        }

        .project-info {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.9;
        }

        /* BUTTON */

        .btn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 7px;
            padding: 10px 16px;
            border: 1px solid transparent;
            border-radius: 9px;
            text-decoration: none;
            cursor: pointer;
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            box-shadow: 0 2px 5px rgba(37, 99, 235, 0.16);
        }

        .btn-primary:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: #f1f5f9;
            border-color: #e2e8f0;
            color: #334155;
        }

        .btn-secondary:hover {
            background: #e2e8f0;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background: #bb2d3b;
        }

        .actions {
            display: flex;
            gap: 9px;
            flex-wrap: wrap;
            margin-top: 18px;
        }

        /* FORM */

        form {
            margin: 0;
        }

        .form-group {
            margin-bottom: 19px;
        }

        label {
            display: block;
            color: #334155;
            font-weight: 600;
            font-size: 13px;
            margin-bottom: 7px;
        }

        input:not([type="checkbox"]):not([type="radio"]),
        select,
        textarea {
            width: 100%;
            padding: 11px 13px;
            background: white;
            border: 1px solid #dbe2eb;
            border-radius: 9px;
            color: var(--text);
            font-family: inherit;
            font-size: 14px;
            outline: none;
            transition: border 0.2s, box-shadow 0.2s;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #60a5fa;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.10);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        input::placeholder,
        textarea::placeholder {
            color: #a0aec0;
        }

        /* TABLE */

        .table-responsive {
            width: 100%;
            overflow-x: auto;
            border-radius: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            font-size: 13px;
        }

        thead {
            background: #f8fafc;
        }

        th {
            padding: 14px 15px;
            color: #475569;
            font-weight: 650;
            text-align: left;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }

        td {
            padding: 14px 15px;
            border-bottom: 1px solid #edf1f5;
            vertical-align: middle;
        }

        tbody tr {
            transition: background 0.15s;
        }

        tbody tr:hover {
            background: #f8fbff;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        /* ALERT */

        .alert {
            padding: 14px 17px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            font-size: 13px;
        }

        .alert-success {
            background: #ecfdf3;
            border-color: #bbf7d0;
            color: #166534;
        }

        .alert-danger {
            background: #fff1f2;
            border-color: #fecdd3;
            color: #9f1239;
        }

        /* PAGINATION */

        .pagination {
            margin-top: 22px;
            display: flex;
            justify-content: center;
        }

        .pagination nav {
            display: flex;
            justify-content: center;
        }

        .pagination svg {
            width: 16px;
            height: 16px;
        }

        /* SEARCH */

        .search-form {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 22px;
        }

        .search-form input {
            flex: 1;
            min-width: 120px;
        }

        /* LINKS */

        a {
            transition: color 0.2s;
        }

        /* HR */

        hr {
            border: none;
            border-top: 1px solid var(--border);
            margin: 24px 0;
        }

        /* BADGES / STATUS */

        .badge,
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 650;
            background: #eff6ff;
            color: #1d4ed8;
        }

        /* EMPTY STATE */

        .empty-state {
            text-align: center;
            padding: 45px 20px;
            color: var(--muted);
        }

        /* RESPONSIVE */

        @media (max-width: 900px) {
            .navbar {
                padding: 12px 4%;
            }

            main {
                padding: 28px 22px 45px;
            }

            .user-info {
                border: none;
            }
        }

        @media (max-width: 650px) {
            .navbar {
                align-items: flex-start;
                flex-direction: column;
                gap: 14px;
            }

            .nav-menu {
                width: 100%;
                justify-content: flex-start;
            }

            .nav-link {
                padding: 8px 10px;
            }

            main {
                padding: 24px 15px 40px;
            }

            .page-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .page-header h1 {
                font-size: 23px;
            }

            .card,
            .project-card {
                padding: 18px;
            }

            .search-form {
                flex-wrap: wrap;
            }

            .search-form input {
                flex-basis: 100%;
            }

            .btn {
                padding: 9px 12px;
            }

            table {
                min-width: 700px;
            }
        }

        @yield('extra-style')
    </style>
</head>

<body>

<header>
    <div class="navbar">

        <div class="brand">
            <div class="brand-mark">G</div>
            <div>
                <h2>Garuda Hub</h2>
                <p>Platform Lelang Proyek IT</p>
            </div>
        </div>

        <nav class="nav-menu">

            @auth
                <div class="user-info">
                    <div class="user-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <span>
                        {{ auth()->user()->name }}
                        ({{ ucfirst(auth()->user()->role) }})
                    </span>
                </div>

                <a href="{{ route('dashboard') }}"
                   class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>

                <a href="{{ route('projects.index') }}"
                   class="nav-link {{ request()->routeIs('projects.*') ? 'active' : '' }}">
                    Daftar Proyek
                </a>

                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.users.index') }}"
                       class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
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