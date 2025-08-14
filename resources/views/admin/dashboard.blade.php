<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Dashboard do Administrador</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .table-container {
            max-height: 400px;
            ;
            /* Ajuste conforme necessário */
            overflow-y: auto;
        }
    </style>
</head>

<body class="background-deep-blue text-light-gray">
    <div class="container py-5">
        <h1 class="mb-4 text-light-gray">Dashboard do Administrador</h1>

        <div class="row mb-4 g-3">
            <!-- Livros -->
            <div class="col-md-6">
                <div class="card bg-dark text-light-gray shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Livros</h5>
                        <p class="card-text display-6">{{ $booksCount ?? '...' }}</p>

                        <form action="{{ route('livros.store') }}" method="POST" class="row g-2 mb-3">
                            @csrf
                            <div class="col">
                                <input type="text" name="title" class="form-control form-control-sm" placeholder="Título" required>
                            </div>
                            <div class="col">
                                <input type="text" name="author" class="form-control form-control-sm" placeholder="Autor" required>
                            </div>
                            <div class="col">
                                <input type="text" name="isbn" class="form-control form-control-sm" placeholder="ISBN">
                            </div>
                            <div class="col">
                                <input type="number" name="year" class="form-control form-control-sm" placeholder="Ano" min="1000" max="9999">
                            </div>
                            <div class="col">
                                <input type="number" name="stock" class="form-control form-control-sm" placeholder="Estoque" min="0" required>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-12">
                                <label for="description" class="form-label text-light-gray">Descrição do livro</label>
                                <textarea name="description" id="description" class="form-control" rows="2" placeholder="Descrição do livro"></textarea>
                            </div>
                            <div class="col">
                                <input type="text" name="cover" class="form-control form-control-sm" placeholder="URL da capa">
                            </div>
                            <div class="col-auto mt-2 margin-down-5">
                                <button type="submit" class="btn btn-success btn-sm">Cadastrar Livro</button>
                            </div>
                        </form>
                        <div class="table-container">
                            <table class="table table-dark table-sm table-bordered align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Título</th>
                                        <th>Autor</th>
                                        <th>Ano</th>
                                        <th>Estoque</th>
                                        <!-- Preço removido -->
                                        <th style="width:90px">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($books->take(10) as $book) <!-- Limita a 10 livros -->
                                    <tr>
                                        <td>{{ $book->title }}</td>
                                        <td>{{ $book->author }}</td>
                                        <td>{{ $book->year }}</td>
                                        <td>{{ $book->stock }}</td>
                                        <!-- Preço removido -->
                                        <td class="text-center">
                                            <a href="{{ route('livros.edit', $book->id) }}" class="btn btn-warning btn-sm me-1"><i class="bi bi-pencil"></i></a>
                                            <form action="{{ route('livros.destroy', $book->id) }}" method="POST" style="display:inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Excluir livro?')"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Categorias -->
            <div class="col-md-6">
                <div class="card bg-dark text-light-gray shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Categorias</h5>
                        <p class="card-text display-6">{{ $categoriesCount ?? '...' }}</p>
                        <!-- CRUD compacto de categorias -->
                        <form action="{{ route('categories.store') }}" method="POST" class="row g-2 mb-3">
                            @csrf
                            <div class="col">
                                <input type="text" name="name" class="form-control form-control-sm" placeholder="Nome da categoria" required>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-success btn-sm">+</button>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-dark table-sm table-bordered align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th style="width:90px">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm me-1"><i class="bi bi-pencil"></i></a>
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Excluir categoria?')"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CRUD exclusivo de Usuários -->
            <div class="col-12">
                <div class="card bg-dark text-light-gray shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Usuários</h5>
                        <p class="card-text display-6">{{ ($usersCount ?? 0) + ($adminsCount ?? 0) }}</p>
                        <form action="{{ route('users.store') }}" method="POST" class="row g-2 mb-3">
                            @csrf
                            <div class="col">
                                <input type="text" name="name" class="form-control form-control-sm" placeholder="Nome" required>
                            </div>
                            <div class="col">
                                <input type="email" name="email" class="form-control form-control-sm" placeholder="Email" required>
                            </div>
                            <div class="col">
                                <input type="password" name="password" class="form-control form-control-sm" placeholder="Senha" required>
                            </div>
                            <div class="col">
                                <select name="role" class="form-select form-select-sm" required>
                                    <option value="user">Usuário</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-success btn-sm">+</button>
                            </div>
                        </form>
                        <div class="table-container">
                            <table class="table table-dark table-sm table-bordered align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th style="width:90px">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users->sortByDesc('id') as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm me-1"><i class="bi bi-pencil"></i></a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Excluir usuário?')"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empréstimos -->
        <div class="col-12">
            <div class="card bg-dark text-light-gray shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title">Últimos Empréstimos</h5>
                    <div class="table-container">
                        <table class="table table-dark table-sm table-bordered align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Livro</th>
                                    <th>Usuário</th>
                                    <th>Data</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($loans as $loan)
                                <tr>
                                    <td>{{ $loan->id }}</td>
                                    <td>{{ $loan->book->title ?? '-' }}</td>
                                    <td>{{ $loan->user->name ?? '-' }}</td>
                                    <td>{{ $loan->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        @if($loan->status === 'pendente')
                                            <span class="badge bg-secondary text-white px-4 py-2 rounded-pill">Pendente</span>
                                        @elseif($loan->status === 'aprovado')
                                            <span class="badge bg-warning text-dark px-4 py-2 rounded-pill">Aprovado</span>
                                        @elseif($loan->status === 'devolvido')
                                            <span class="badge bg-success text-white px-4 py-2 rounded-pill">Devolvido</span>
                                        @elseif($loan->status === 'atrasado')
                                            <span class="badge bg-danger text-white px-4 py-2 rounded-pill">Atrasado</span>
                                        @else
                                            <span class="badge bg-light text-dark px-4 py-2 rounded-pill">{{ $loan->status }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($loan->status === 'pendente')
                                            <form action="{{ route('loans.finish', $loan->id) }}" method="POST" class="d-inline-block m-0">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-success btn-sm rounded-3 px-4 py-2">
                                                    <i class="bi bi-check-circle me-2"></i>Aprovar
                                                </button>
                                            </form>
                                        @elseif($loan->status === 'aprovado')
                                            <form action="{{ route('loans.finish', $loan->id) }}" method="POST" class="d-inline-block m-0">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-primary btn-sm rounded-3 px-4 py-2">
                                                    <i class="bi bi-arrow-repeat me-2"></i>Finalizar
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>

                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Nenhum empréstimo encontrado.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>