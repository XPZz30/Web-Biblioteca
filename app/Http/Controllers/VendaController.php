<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'book_id' => 'required|exists:books,id',
        // adicione outros campos necessários
    ]);

    // Verificar estoque
    $book = Book::find($request->book_id);
    if ($book->stock < 1) {
        return back()->with('error', 'Livro não disponível em estoque');
    }

    // Criar a venda
    $venda = Venda::create([
        'book_id' => $request->book_id,
        'user_id' => auth()->id(),
        'price' => $book->price,
        'date' => now(),
        // outros campos
    ]);

    // Atualizar estoque
    $book->decrement('stock');

    return redirect()->route('vendas.index')
        ->with('success', 'Compra realizada com sucesso!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
