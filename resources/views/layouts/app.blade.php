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
                            @forelse($categories as $category)
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
                        <a class="nav-link nav-link-custom" href="#" data-bs-toggle="modal" data-bs-target="#userLoansModal">
                            Empréstimos
                        </a>
                    </li>
                </ul>
            </div>
            <form action="{{ route('search') }}" method="GET" class="d-flex align-items-center me-3">
                <input type="text" class="form-control search-input background-search" name="query" placeholder="Buscar livros...">
                <button type="submit" class="icon-button">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>
    </nav>

    @auth
    <!-- Modal de empréstimos do usuário logado -->
    <div class="modal fade" id="userLoansModal" tabindex="-1" aria-labelledby="userLoansModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-dark text-light-gray">
                <div class="modal-header">
                    <h5 class="modal-title" id="userLoansModalLabel">Meus Empréstimos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-dark table-bordered align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Livro</th>
                                    <th>Data do Empréstimo</th>
                                    <th>Data Prevista Devolução</th>
                                    <th>Status</th>
                                    <th>Finalizado em</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $userLoans = Auth::user()->loans()->with('book')->orderByDesc('created_at')->get();
                                @endphp
                                @forelse($userLoans as $loan)
                                <tr>
                                    <td>{{ $loan->id }}</td>
                                    <td>{{ $loan->book->title ?? '-' }}</td>
                                    <td>{{ $loan->loan_date ? \Carbon\Carbon::parse($loan->loan_date)->format('d/m/Y') : '-' }}</td>
                                    <td>{{ $loan->return_date ? \Carbon\Carbon::parse($loan->return_date)->format('d/m/Y') : '-' }}</td>
                                    <td>
                                        @if($loan->status === 'pendente')
                                        <span class="badge bg-secondary">Pendente</span>
                                        @elseif($loan->status === 'aprovado')
                                        <span class="badge bg-warning text-dark">Aprovado</span>
                                        @elseif($loan->status === 'devolvido')
                                        <span class="badge bg-success">Devolvido</span>
                                        @elseif($loan->status === 'atrasado')
                                        <span class="badge bg-danger">Atrasado</span>
                                        @else
                                        <span class="badge bg-light text-dark">{{ $loan->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($loan->returned_at)
                                        {{ \Carbon\Carbon::parse($loan->returned_at)->format('d/m/Y') }}
                                        @else
                                        <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Nenhum empréstimo registrado.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endauth

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