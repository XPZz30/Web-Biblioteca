@extends('layouts.show')

<head>
    <link rel="stylesheet" href="{{ asset('css/livro-show.css') }}">
</head>

@section('content')
<div class="container background-deep-blue-show rounded shadow" style="max-width: 80%; margin: 0 auto;">
    <div class="row align-items-center">
        <!-- Título, autor e capa -->
        <div class="col-md-12 d-flex flex-row align-items-start justify-content-start">
            <div class="flex-grow-1">
                <h2 class="mb-1 fw-bold text-light" style="font-size:2rem;">{{ $book->title }}</h2>
                <div class="mb-2">
                    <span class="text-light" style="font-size:1.1rem;">Por {{ $book->author }}</span>
                    <span class="text-light ms-2" style="font-size:1.1rem;">· {{ $book->year ?? '' }}</span>
                </div>
            </div>
            <div class="book-cover-small ms-4 d-flex justify-content-start">
                <img src="{{ $book->cover ?? 'https://via.placeholder.com/60x90/f5f5f5/cccccc?text=Capa+Não+Disponível' }}"
                    alt="Capa do livro: {{ $book->title }}"
                    class="shadow rounded"
                    style="object-fit:cover; width: auto; height: auto;"
                    onerror="this.onerror=null; this.src='https://via.placeholder.com/60x90/f5f5f5/cccccc?text=Capa+Não+Disponível'">
            </div>
        </div>

        <!-- Informações do Livro -->
        <div class="col-12 mt-4">
            <div class="info-container-show mb-3">
                <div class="info-container-show-inner">
                    <div class="info-container-show-title">Sobre esta edição</div>
                    <div class="table-responsive table-show">
                        <table class="info-container-show-table table table-borderless table-sm mb-0">
                            <tbody>
                                <tr>
                                    <td class="fw-bold">ISBN:</td>
                                    <td>{{ $book->isbn }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Publicação:</td>
                                    <td>{{ $book->year ?? 'Não informado' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Editora:</td>
                                    <td>{{ $book->publisher ?? 'Não informado' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Autor:</td>
                                    <td>{{ $book->author ?? 'Não informado' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Número de páginas:</td>
                                    <td>{{ $book->pages ?? 'Não informado' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Categorias:</td>
                                    <td colspan="3">
                                        @if($book->categories && $book->categories->count())
                                        @foreach($book->categories as $category)
                                        <span class="badge bg-primary me-1">{{ $category->name }}</span>
                                        @endforeach
                                        @else
                                        <span class="text-muted">Nenhuma categoria</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="desc-container-show mb-4">
                <div class="desc-container-show-inner">
                    <span id="desc-short">
                        {{ Str::limit($book->description ?? 'Descrição não disponível', 300) }}
                        @if(strlen($book->description ?? '') > 300)
                        ...
                        @endif
                        <div class="desc-container-show-source">Fonte: Editor</div>
                    </span>
                    <span id="desc-full" style="display:none;">
                        {{ $book->description ?? 'Descrição não disponível' }}
                        <div class="desc-container-show-source">Fonte: Editor</div>
                    </span>
                </div>
                <button class="desc-container-show-btn" id="btn-read-more" onclick="toggleDesc()">
                    <span id="btn-arrow" class="me-2" style="font-size:1.3rem;">&#x25BC;</span>
                    <span id="btn-label">Mais sobre esta edição</span>
                </button>
                <script>
                    function toggleDesc() {
                        var short = document.getElementById('desc-short');
                        var full = document.getElementById('desc-full');
                        var btnLabel = document.getElementById('btn-label');
                        var btnArrow = document.getElementById('btn-arrow');
                        if (short.style.display !== 'none') {
                            short.style.display = 'none';
                            full.style.display = 'block';
                            btnLabel.textContent = 'Menos sobre esta edição';
                            btnArrow.innerHTML = '&#x25B2;';
                        } else {
                            short.style.display = 'block';
                            full.style.display = 'none';
                            btnLabel.textContent = 'Mais sobre esta edição';
                            btnArrow.innerHTML = '&#x25BC;';
                        }
                    }
                </script>
            </div>
        </div>
        <!-- Botões de ação -->
        <div class="row mt-4">
            <div class="col-12 d-flex flex-row justify-content-between align-items-center" style="gap: 1rem;">
                @if($book->stock > 0)
                <form action="{{ route('loans.store') }}" method="POST" style="max-width: 260px; flex: 1;">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <button type="submit" class="btn btn-primary btn-lg px-4 py-2 shadow text-nowrap w-100" style="margin-top: 1rem;">
                        <i class="bi bi-journal-arrow-up me-2"></i> Solicitar Empréstimo
                    </button>
                </form>
                @else
                <button class="btn btn-secondary btn-lg px-4 py-2 shadow text-nowrap w-100" style="max-width: 260px;" disabled>
                    <i class="bi bi-exclamation-circle me-2"></i> Indisponível para empréstimo
                </button>
                @endif
                <a href="{{ route('livros.index') }}" class="btn btn-outline-secondary btn-lg px-4 py-2 shadow text-nowrap w-100" style="max-width: 220px; flex: 1;">
                    <i class="bi bi-arrow-left me-2"></i> Voltar
                </a>
            </div>
        </div>

    </div>
</div>
</div>
@endsection