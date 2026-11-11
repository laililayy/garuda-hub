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
            padding: 20px 8%;
        }

        header h2 {
            margin: 0;
        }

        main {
            max-width: 1100px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
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

        @yield('extra-style')
    </style>
</head>
<body>

    <header>
        <h2>Garuda Hub</h2>
        <p>Platform Lelang Proyek IT</p>
    </header>

    <main>
        @yield('content')
    </main>

</body>
</html>