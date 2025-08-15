@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Editar Usuário</h2>
    <form action="{{ route('users.update', $user->id) }}" method="POST" class="row g-3">
        @csrf
        @method('PUT')
        <div class="col-md-6">
            <label for="name" class="form-label">Nome</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>
        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>
        <div class="col-md-6">
            <label for="role" class="form-label">Tipo</label>
            <select name="role" id="role" class="form-select" required>
                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>Usuário</option>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="password" class="form-label">Senha (deixe em branco para não alterar)</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
        </div>
    </form>
</div>
@endsection
