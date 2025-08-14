<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use App\Models\Venda;
use App\Models\Loan;

class AuthController extends Controller
{
    // Exibir a página de login
    public function showLoginForm()
    {
        return view('auth.login'); // Certifique-se de que o arquivo de login está em 'resources/views/auth/login.blade.php'
    }

    // Processar o login
    public function login(Request $request)
    {
        // Validar os dados de login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Tentar autenticar o usuário
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Se autenticado, verifica o role do usuário
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->intended('/dashboard');
            } else {
                return redirect()->intended('/livros');
            }
        }

        // Se falhar, redireciona de volta com erro
        return back()->withErrors(['email' => 'As credenciais fornecidas são inválidas.']) ;
        
    }

    // Dashboard admin com dados e livros
    public function dashboardAdmin()
    {
        $booksCount = Book::count();
        $categoriesCount = Category::count();
        $usersCount = User::where('role', 'user')->count();
        $adminsCount = User::where('role', 'admin')->count();
        $loansCount = Loan::count();
        $books = Book::orderBy('created_at', 'desc')->get();
        $categories = Category::orderBy('name')->get();
        $users = User::orderBy('name')->get();
        $loans = Loan::with('book','user')->orderByDesc('created_at')->take(10)->get();
        return view('admin.dashboard', compact('booksCount', 'categoriesCount', 'usersCount', 'adminsCount', 'loansCount', 'books', 'categories', 'users', 'loans'));
    }
}
