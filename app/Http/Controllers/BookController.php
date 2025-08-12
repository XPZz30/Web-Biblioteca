<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Category;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $author = $request->input('author');
        $categoryId = $request->input('category'); // Obtém o ID da categoria filtrada

        // Inicia a consulta para os livros
        $books = Book::query();

        // Se houver um filtro de categoria
        if ($categoryId) {
            // Filtra os livros que pertencem à categoria selecionada
            $books->whereHas('categories', function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId); // Filtra livros pela categoria
            });
        }

        // Se houver um filtro de autor
        if ($author) {
            $books->where('author', 'like', '%' . $author . '%');  // Usando LIKE para buscar parcialmente pelo autor
        }

        // Executa a consulta e obtém os livros
        $books = $books->get();

        // Passa os livros e as categorias para a view
        $categories = Category::orderBy('name')->get();
        return view('livros.index', compact('books', 'categories'));
    }


    public function search(Request $request)
    {
        $query = $request->input('query');
        $author = $request->input('author');

        $books = Book::query();

        if ($query) {
            $books->where('title', 'like', '%' . $query . '%');
        }

        if ($author) {
            $books->where('author', $author);
        }

        $books = $books->get();

        return view('livros.index', compact('books'));
    }

    public function show($id)
    {
        $book = Book::with('categories')->findOrFail($id);
        return view('livros.show', compact('book'));
    }
}
