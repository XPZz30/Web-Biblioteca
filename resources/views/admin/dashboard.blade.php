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
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <h1 class="mb-4 text-light-gray">Dashboard do Administrador</h1>

        <div class="row mb-4 g-3">
            <!-- Livros -->
            <div class="col-md-12">
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
                                <input type="text" name="publisher" class="form-control form-control-sm" placeholder="Editora">
                            </div>
                            <div class="col">
                                <input type="text" name="isbn" id="isbn-input" class="form-control form-control-sm" placeholder="ISBN">
                            </div>
                            <div class="col">
                                <input type="number" name="year" class="form-control form-control-sm" placeholder="Ano" min="1000" max="9999">
                            </div>
                            <div class="col">
                                <input type="number" name="stock" class="form-control form-control-sm" placeholder="Estoque" min="0" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-light-gray mb-2">Categorias</label>
                                <!-- Removido input hidden para evitar envio de valor vazio -->
                                <div class="row g-1">
                                    @foreach($categories as $category)
                                    <div class="col-auto">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}" id="cat{{ $category->id }}">
                                            <label class="form-check-label" for="cat{{ $category->id }}">{{ $category->name }}</label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
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
                            <form id="delete-books-form" action="{{ route('livros.bulkDelete') }}" method="POST">
                                @csrf
                                <table class="table table-dark table-sm table-bordered align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="select-all-books"></th>
                                            <th>Título</th>
                                            <th>Autor</th>
                                            <th>Ano</th>
                                            <th>Estoque</th>
                                            <th style="width:90px">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($books as $book)
                                        <tr>
                                            <td><input type="checkbox" name="selected_books[]" value="{{ $book->id }}" class="book-checkbox"></td>
                                            <td>{{ $book->title }}</td>
                                            <td>{{ $book->author }}</td>
                                            <td>{{ $book->year }}</td>
                                            <td>{{ $book->stock }}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#editBookModal{{ $book->id }}">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <form action="{{ route('livros.destroy', $book->id) }}" method="POST" style="display:inline-block">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Excluir livro?')"><i class="bi bi-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @foreach($users->sortByDesc('id') as $user)
                                        <!-- Modal de edição de usuário -->
                                        <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content bg-dark text-light-gray">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">Editar Usuário</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="name{{ $user->id }}" class="form-label">Nome</label>
                                                                <input type="text" name="name" id="name{{ $user->id }}" class="form-control" value="{{ $user->name }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="email{{ $user->id }}" class="form-label">Email</label>
                                                                <input type="email" name="email" id="email{{ $user->id }}" class="form-control" value="{{ $user->email }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="role{{ $user->id }}" class="form-label">Tipo</label>
                                                                <select name="role" id="role{{ $user->id }}" class="form-select" required>
                                                                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>Usuário</option>
                                                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="password{{ $user->id }}" class="form-label">Senha (deixe em branco para não alterar)</label>
                                                                <input type="password" name="password" id="password{{ $user->id }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @foreach($categories as $category)
                                        <!-- Modal de edição de categoria -->
                                        <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1" aria-labelledby="editCategoryModalLabel{{ $category->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content bg-dark text-light-gray">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editCategoryModalLabel{{ $category->id }}">Editar Categoria</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('categories.update', $category->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="name{{ $category->id }}" class="form-label">Nome da Categoria</label>
                                                                <input type="text" name="name" id="name{{ $category->id }}" class="form-control" value="{{ $category->name }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @foreach($books as $book)
                                        <!-- Modal de edição de livro -->
                                        <div class="modal fade" id="editBookModal{{ $book->id }}" tabindex="-1" aria-labelledby="editBookModalLabel{{ $book->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content bg-dark text-light-gray">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editBookModalLabel{{ $book->id }}">Editar Livro</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('livros.update', $book->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="row g-3">
                                                                <div class="col-md-6">
                                                                    <label for="title{{ $book->id }}" class="form-label">Título</label>
                                                                    <input type="text" name="title" id="title{{ $book->id }}" class="form-control" value="{{ $book->title }}" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="author{{ $book->id }}" class="form-label">Autor</label>
                                                                    <input type="text" name="author" id="author{{ $book->id }}" class="form-control" value="{{ $book->author }}" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="publisher{{ $book->id }}" class="form-label">Editora</label>
                                                                    <input type="text" name="publisher" id="publisher{{ $book->id }}" class="form-control" value="{{ $book->publisher }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="isbn{{ $book->id }}" class="form-label">ISBN</label>
                                                                    <input type="text" name="isbn" id="isbn{{ $book->id }}" class="form-control" value="{{ $book->isbn }}">
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label for="year{{ $book->id }}" class="form-label">Ano</label>
                                                                    <input type="number" name="year" id="year{{ $book->id }}" class="form-control" value="{{ $book->year }}" min="1000" max="9999">
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label for="stock{{ $book->id }}" class="form-label">Estoque</label>
                                                                    <input type="number" name="stock" id="stock{{ $book->id }}" class="form-control" value="{{ $book->stock }}" min="0" required>
                                                                </div>
                                                                <div class="col-12">
                                                                    <label class="form-label">Categorias</label>
                                                                    <div class="row g-1">
                                                                        @foreach($categories as $category)
                                                                        <div class="col-auto">
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}" id="catEdit{{ $book->id }}_{{ $category->id }}"
                                                                                    {{ $book->categories->contains($category->id) ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="catEdit{{ $book->id }}_{{ $category->id }}">{{ $category->name }}</label>
                                                                            </div>
                                                                        </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="description{{ $book->id }}" class="form-label">Descrição</label>
                                                                    <textarea name="description" id="description{{ $book->id }}" class="form-control" rows="3">{{ $book->description }}</textarea>
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="cover{{ $book->id }}" class="form-label">URL da capa</label>
                                                                    <input type="text" name="cover" id="cover{{ $book->id }}" class="form-control" value="{{ $book->cover }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-danger btn-sm mt-2" onclick="return confirm('Excluir livros selecionados?')">Excluir Selecionados</button>
                            </form>
                            <script>
                                document.getElementById('select-all-books').addEventListener('change', function() {
                                    const checked = this.checked;
                                    document.querySelectorAll('.book-checkbox').forEach(cb => cb.checked = checked);
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Categorias -->
            <div class="col-md-12">
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
                        <form id="delete-categories-form" action="{{ route('categories.bulkDelete') }}" method="POST">
                            @csrf
                            <div class="table-responsive">
                                <table class="table table-dark table-sm table-bordered align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="select-all-categories"></th>
                                            <th>Nome</th>
                                            <th style="width:90px">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($categories as $category)
                                        <tr>
                                            <td><input type="checkbox" name="selected_categories[]" value="{{ $category->id }}" class="category-checkbox"></td>
                                            <td>{{ $category->name }}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#editCategoryModal{{ $category->id }}">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline-block">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Excluir categoria?')"><i class="bi bi-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-danger btn-sm mt-2" onclick="return confirm('Excluir categorias selecionadas?')">Excluir Selecionadas</button>
                            </div>
                        </form>
                        <script>
                            document.getElementById('select-all-categories').addEventListener('change', function() {
                                const checked = this.checked;
                                document.querySelectorAll('.category-checkbox').forEach(cb => cb.checked = checked);
                            });
                        </script>
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
                        <form id="delete-users-form" action="{{ route('users.bulkDelete') }}" method="POST">
                            @csrf
                            <div class="table-container">
                                <table class="table table-dark table-sm table-bordered align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="select-all-users"></th>
                                            <th>Nome</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th style="width:90px">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users->sortByDesc('id') as $user)
                                        <tr>
                                            <td><input type="checkbox" name="selected_users[]" value="{{ $user->id }}" class="user-checkbox"></td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role }}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
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
                                <button type="submit" class="btn btn-danger btn-sm mt-2" onclick="return confirm('Excluir usuários selecionados?')">Excluir Selecionados</button>
                            </div>
                        </form>
                        <script>
                            document.getElementById('select-all-users').addEventListener('change', function() {
                                const checked = this.checked;
                                document.querySelectorAll('.user-checkbox').forEach(cb => cb.checked = checked);
                            });
                        </script>
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

        <footer class="text-center py-4">
            <p class="mb-0">© {{ date('Y') }} Virtual Library. Todos os direitos reservados.</p>
            <p class="mb-0">Desenvolvido por Samuel Leal</p>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            <script>
            document.getElementById('isbn-input').addEventListener('blur', function() {
                const isbn = this.value.trim();
                if (!isbn) return;
                fetch(`https://www.googleapis.com/books/v1/volumes?q=isbn:${isbn}&key=AIzaSyCrkAZviDtzYaxxxCbTxHvlszxDWJK1fHY`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.totalItems > 0) {
                            const info = data.items[0].volumeInfo;
                            if (info.title) document.querySelector('input[name="title"]').value = info.title;
                            if (info.authors && info.authors.length) document.querySelector('input[name="author"]').value = info.authors.join(', ');
                            if (info.publisher) document.querySelector('input[name="publisher"]').value = info.publisher;
                            if (info.publishedDate) {
                                const year = info.publishedDate.split('-')[0];
                                document.querySelector('input[name="year"]').value = year;
                            }
                            if (info.description) document.getElementById('description').value = info.description;
                            if (info.imageLinks && info.imageLinks.thumbnail) document.querySelector('input[name="cover"]').value = info.imageLinks.thumbnail;
                        } else {
                            alert('Livro não encontrado na Google Books API.');
                        }
                    })
                    .catch(() => alert('Erro ao buscar dados na Google Books API.'));
            });
            </script>
</body>

</html>