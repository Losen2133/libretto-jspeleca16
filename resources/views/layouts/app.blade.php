<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LIBRETTO</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">LIBRETTO</a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('books.*') ? 'active disabled' : '' }}"
                    href="{{ request()->routeIs('books.*') ? '#' : route('books.index') }}">
                        Books
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('authors.*') ? 'active disabled' : '' }}"
                    href="{{ request()->routeIs('authors.*') ? '#' : route('authors.index') }}">
                        Authors
                    </a>
                </li>
            </ul>
        </div>
    </nav>


    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
