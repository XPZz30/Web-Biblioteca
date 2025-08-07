<?php

namespace App\Http\Controllers;

use App\Models\Book;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Book::select('author')
            ->distinct()
            ->orderBy('author')
            ->pluck('author');

        // dd($authors); // Para depurar e ver os autores retornados

        return view('authors.index', compact('authors'));  // Garante que $authors seja passado corretamente

    }
}
