@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-light-gray">Livros disponíveis</h1>

    <div class="row">
        @foreach($books as $book)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card book-card shadow-lg h-100 border-0 text-light position-relative">
                <div class="book-cover-container p-3 d-flex justify-content-center align-items-center" style="height: 320px;">
                    <img src="{{ $book->cover }}" alt="{{ $book->title }}" class="img-fluid rounded book-cover-img" style="max-height: 100%; max-width: 100%; object-fit: cover; box-shadow: 0 4px 16px rgba(0,0,0,0.2);">
                </div>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title mb-2 text-truncate" title="{{ $book->title }}">{{ $book->title }}</h5>
                    <p class="card-text mb-1"><i class="bi bi-person"></i> <span class="fw-semibold">{{ $book->author }}</span></p>
                    <p class="card-text mb-1"><i class="bi bi-calendar"></i> {{ $book->year ?? 'N/A' }}</p>
                    <p class="card-text mb-1"><i class="bi bi-collection"></i> Estoque: <span class="fw-bold {{ $book->stock > 0 ? 'text-success' : 'text-danger' }}">{{ $book->stock }}</span></p>
                    <div class="mt-auto">
                        <a href="{{ route('livros.show', $book->id) }}" class="btn btn-primary w-100 mt-2">
                            <i class="bi bi-book"></i> Ver detalhes
                        </a>
                    </div>
                </div>
                <!-- Removido badge de ID do livro -->
            </div>
        </div>
        @endforeach
    </div>
<!-- Estilos agora em custom.css -->

    @if(request()->has('category'))
    <div class="alert alert-info">
        Mostrando livros da categoria:
        <strong>
            @if(is_array(request()->category))
            @foreach(request()->category as $categoryId)
            {{ \App\Models\Category::find($categoryId)->name }}
            @if(!$loop->last) {{ ', ' }} @endif
            @endforeach
            @else
            {{ \App\Models\Category::find(request()->category)->name }}
            @endif
        </strong>
        <a href="{{ route('livros.index') }}" class="float-end">Limpar filtro</a>
    </div>
    @endif

    @if(request()->has('author'))
    <div class="alert alert-info">
        Mostrando livros do autor:
        <strong>
            @if(is_array(request('author')))
            {{ implode(', ', request('author')) }}
            @else
            {{ request('author') }}
            @endif
        </strong>
        <a href="{{ route('livros.index') }}" class="float-end">Limpar filtro</a>
    </div>
    @endif
</div>
@endsection