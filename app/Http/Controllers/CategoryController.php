<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->get();
        return view('categories.index', compact('categories'));
    }

    // Store - cadastrar nova categoria
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        Category::create($validated);
        return redirect()->route('admin.dashboard')->with('success', 'Categoria cadastrada com sucesso!');
    }

    // Edit - exibir formulário de edição
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    // Update - atualizar categoria
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $category = Category::findOrFail($id);
        $category->update($validated);
        return redirect()->route('admin.dashboard')->with('success', 'Categoria atualizada com sucesso!');
    }

    // Destroy - excluir categoria
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Categoria excluída com sucesso!');
    }
    // Exclusão em massa de categorias
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('selected_categories', []);
        if (!empty($ids)) {
            Category::whereIn('id', $ids)->delete();
            return redirect()->route('admin.dashboard')->with('success', 'Categorias excluídas com sucesso!');
        }
        return redirect()->route('admin.dashboard')->with('error', 'Nenhuma categoria selecionada.');
    }
}
