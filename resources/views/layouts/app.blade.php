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
            <a class="navbar-brand nav-title" href="/">Virtual Library</a>

            <div class="collapse navbar-collapse justify-content-center">
                <ul class="navbar-nav gap-4">
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="/livros">Livros</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle nav-link-custom" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Autores
                        </a>
                        <ul class="dropdown-menu custom-dropdown-menu" aria-labelledby="navbarDropdown">
                            @php
                            $authors = isset($authors) && is_array($authors) ? $authors : [];
                            @endphp
                            @if(count($authors))
                            @foreach($authors as $author)
                            <li>
                                <a class="dropdown-item" href="{{ route('livros.index', ['author' => $author]) }}">
                                    {{ $author }}
                                </a>
                            </li>
                            @endforeach
                            @else
                            <li><span class="dropdown-item text-muted">Nenhum autor encontrado</span></li>
                            @endif
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle nav-link-custom" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categorias
                        </a>
                        <ul class="dropdown-menu custom-dropdown-menu" aria-labelledby="categoriesDropdown">
                            @forelse($categories as $category) <!-- $categories deve ser uma coleção -->
                            <li>
                                <a class="dropdown-item" href="{{ route('livros.index', ['category' => $category->id]) }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                            @empty
                            <li><span class="dropdown-item text-muted">Nenhuma categoria encontrada</span></li>
                            @endforelse
                        </ul>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#">Editoras</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#">Gêneros</a>
                    </li>
                </ul>
            </div>
            <form action="{{ route('search') }}" method="GET" class="d-flex align-items-center">
                <input type="text" class="form-control search-input background-search" name="query" placeholder="Buscar livros...">
                <button type="submit" class="icon-button">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>
    </nav>



    <main class="container mt-4">
        @yield('content')
    </main>
    <footer class="text-center py-4">
        <p class="mb-0">© {{ date('Y') }} Virtual Library. Todos os direitos reservados.</p>
        <p class="mb-0">Desenvolvido por Samuel Leal<a href="https://

    {{-- Bootstrap JS Bundle CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>