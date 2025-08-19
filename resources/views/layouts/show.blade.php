<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Biblioteca')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body class="background-deep-blue text-light-gray">

    <nav class="navbar navbar-expand-lg custom-navbar px-4 py-3">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <a class="navbar-brand nav-title me-3" href="/livros">Virtual Library</a>
            </div>
        </div>
    </nav>

    <script src="{{ asset('js/sidebar.js') }}"></script>

    <main class="container mt-4">
        @yield('content')
    </main>
    <footer class="text-center py-4">
        <p class="mb-0">© {{ date('Y') }} Virtual Library. Todos os direitos reservados.</p>
        <p class="mb-0">Desenvolvido por Samuel Leal</p>

        {{-- Bootstrap JS Bundle CDN --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>