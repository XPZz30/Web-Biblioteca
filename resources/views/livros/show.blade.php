@extends('layouts.app')

@section('content')
<div class="container py-5 background-deep-blue-show rounded shadow">
    <div class="row">

        <!-- Imagem do Livro -->
        <div class="col-md-4">
            <div class="book-cover-container mb-4"> <!-- Container adicional -->
                <img src="{{ $book->cover }}"
                    alt="Capa do livro: {{ $book->title }}"
                    class="book-cover-large"
                    onerror="this.onerror=null; this.src='https://via.placeholder.com/350x525/f5f5f5/cccccc?text=Capa+Não+Disponível'">
            </div>
        </div>

        <!-- Detalhes do Livro -->
        <div class="col-md-8">
            <h1 class="mb-3">{{ $book->title }}</h1>
            <p class="text-auhor-show show-author-title">por {{ $book->author }}</p>

            <div class="book-details mt-4">
                <p><strong>ISBN:</strong> {{ $book->isbn }}</p>
                <p><strong>Editora:</strong> {{ $book->publisher ?? 'Não informado' }}</p>
                <p><strong>Ano de Publicação:</strong> {{ $book->year ?? 'Não informado' }}</p>
                <p><strong>Preço:</strong> R$ {{ number_format($book->price, 2, ',', '.') }}</p>
                <p><strong>Estoque Disponível:</strong> {{ $book->stock }}</p>

                @if($book->categories->isNotEmpty())
                <p><strong>Categorias:</strong>
                    {{ $book->categories->pluck('name')->implode(', ') }}
                </p>
                @endif

                <p class="mt-4"><strong>Descrição:</strong></p>
                <div class="book-description p-3 bg-light rounded">
                    {{ $book->description ?? 'Descrição não disponível' }}
                </div>
            </div>

            <!-- Botão de Comprar -->
            <div class="mt-5 d-flex justify-content-between">
                @if($book->stock > 0)
                <form action="{{ route('vendas.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-cart-plus"></i> Comprar por R$ {{ number_format($book->price, 2, ',', '.') }}
                    </button>
                </form>
                @else
                <button class="btn btn-secondary btn-lg" disabled>
                    <i class="bi bi-exclamation-circle"></i> Indisponível para compra
                </button>
                @endif

                <a href="{{ route('livros.index') }}" class="btn btn-outline-secondary btn-lg ms-2">
                    <i class="bi bi-arrow-left"></i> Voltar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection