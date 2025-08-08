@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-light-gray">Livros disponíveis</h1>

    <div class="row">
        @foreach($books as $book)
        <div class="col-md-3 mb-4">
            <div class="book-card text-center">
                <div class="book-cover">
                    <img src="{{ $book->cover }}" alt="{{ $book->title }}">
                </div>
                <div class="book-info mt-3">
                    <h5 class="book-title">{{ $book->title }}</h5>
                    <p class="book-author">Autor: {{ $book->author }}</p>
                    <p class="book-year">Ano: {{ $book->year }}</p>
                    <p class="book-stock"><small>Estoque: {{ $book->stock }}</small></p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

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
</div>
@endsection