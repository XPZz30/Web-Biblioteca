@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Editar Categoria</h2>
    <form action="{{ route('categories.update', $category->id) }}" method="POST" class="row g-3">
        @csrf
        @method('PUT')
        <div class="col-md-6">
            <label for="name" class="form-label">Nome da Categoria</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->name) }}" required>
        </div>
        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
        </div>
    </form>
</div>
@endsection
