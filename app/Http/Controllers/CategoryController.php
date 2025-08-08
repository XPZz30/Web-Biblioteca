<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        // Recupera todas as categorias ordenadas por nome
        $categories = Category::orderBy('name')->get(); // Isso retorna uma coleção, não uma string

        // Passa as categorias para a view
        return view('livros.index', compact('categories'));
    }

    public function filterByCategory(Request $request)
    {
        $categoryId = $request->input('category'); // Obtém o ID da categoria selecionada

        // Filtra os livros que pertencem à categoria selecionada
        $category = Category::find($categoryId);
        $books = $category ? $category->books : collect(); // Obtém os livros da categoria

        return view('livros.index', compact('books'));
    }
}
