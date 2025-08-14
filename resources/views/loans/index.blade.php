@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-light-gray">Empréstimos de Livros</h1>
    <div class="table-responsive bg-dark rounded shadow p-4">
        <table class="table table-dark table-bordered align-middle">
            <thead>
                <tr>
                        <th>ID</th>
                        <th>Livro</th>
                        <th>Usuário</th>
                        <th>Data do Empréstimo</th>
                        <th>Data Prevista Devolução</th>
                        <th>Status</th>
                        <th>Finalizado em</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loans as $loan)
                    <tr>
                        <td>{{ $loan->id }}</td>
                        <td>{{ $loan->book->title ?? '-' }}</td>
                        <td>{{ $loan->user->name ?? '-' }}</td>
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
                                {{ \Carbon\Carbon::parse($loan->returned_at)->format('d/m/Y H:i') }}
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
@endsection
