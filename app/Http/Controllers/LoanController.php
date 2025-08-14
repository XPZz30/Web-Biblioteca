<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    // Listar empréstimos (admin)
    public function index()
    {
        $loans = Loan::with('book', 'user')->orderByDesc('created_at')->get();
        return view('loans.index', compact('loans'));
    }

    // Solicitar empréstimo (usuário comum)
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);
        $book = Book::findOrFail($request->book_id);
        if ($book->stock < 1) {
            return back()->withErrors(['book_id' => 'Livro indisponível para empréstimo.']);
        }
        $loan = Loan::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'loan_date' => now()->toDateString(),
            'return_date' => now()->addDays(7)->toDateString(), // exemplo: 7 dias para devolução
            'status' => 'pendente',
        ]);
        $book->decrement('stock');
        return back()->with('success', 'Empréstimo realizado com sucesso!');
    }

    // Aprovar empréstimo (admin)
    public function finish($id)
    {
        $loan = Loan::findOrFail($id);
        if ($loan->status === 'pendente') {
            $loan->status = 'aprovado';
            $loan->save();
            return back()->with('success', 'Empréstimo aprovado com sucesso!');
        }
        // Se já aprovado, marcar como devolvido
        if ($loan->status === 'aprovado') {
            $loan->status = 'devolvido';
            $loan->returned_at = now()->toDateString();
            $loan->save();
            $loan->book->increment('stock');
            return back()->with('success', 'Livro devolvido com sucesso!');
        }
        return back()->with('info', 'Ação não permitida para este status.');
    }
}
