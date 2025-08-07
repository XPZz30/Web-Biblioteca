<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $author = $request->input('author');

        if ($author) {
            $books = Book::where('author', $author)->get();
        } else {
            $books = Book::all();
        }

        return view('livros.index', compact('books'));
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
}
