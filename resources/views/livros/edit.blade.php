@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Editar Livro</h2>
    <form action="{{ route('livros.update', $book->id) }}" method="POST" class="row g-3">
        @csrf
        @method('PUT')
        <div class="col-md-6">
            <label for="title" class="form-label">Título</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $book->title) }}" required>
        </div>
        <div class="col-md-6">
            <label for="author" class="form-label">Autor</label>
            <input type="text" name="author" id="author" class="form-control" value="{{ old('author', $book->author) }}" required>
        </div>
        <div class="col-md-6">
            <label for="publisher" class="form-label">Editora</label>
            <input type="text" name="publisher" id="publisher" class="form-control" value="{{ old('publisher', $book->publisher) }}">
        </div>
        <div class="col-md-6">
            <label for="isbn" class="form-label">ISBN</label>
            <input type="text" name="isbn" id="isbn" class="form-control" value="{{ old('isbn', $book->isbn) }}">
        </div>
        <div class="col-md-3">
            <label for="year" class="form-label">Ano</label>
            <input type="number" name="year" id="year" class="form-control" value="{{ old('year', $book->year) }}" min="1000" max="9999">
        </div>
        <div class="col-md-3">
            <label for="stock" class="form-label">Estoque</label>
            <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock', $book->stock) }}" min="0" required>
        </div>
        <div class="col-12">
            <label class="form-label">Categorias</label>
            <div class="row g-1">
                @foreach($categories as $category)
                <div class="col-auto">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}" id="cat{{ $category->id }}"
                            {{ in_array($category->id, old('categories', $book->categories->pluck('id')->toArray())) ? 'checked' : '' }}>
                        <label class="form-check-label" for="cat{{ $category->id }}">{{ $category->name }}</label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-12">
            <label for="description" class="form-label">Descrição</label>
            <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $book->description) }}</textarea>
        </div>
        <div class="col-12">
            <label for="cover" class="form-label">URL da capa</label>
            <input type="text" name="cover" id="cover" class="form-control" value="{{ old('cover', $book->cover) }}">
        </div>
        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            <a href="{{ route('livros.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
        </div>
    </form>
</div>
@endsection
