<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\alert;

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
            // Se autenticado, redireciona para a página principal ou dashboard
            return redirect()->intended('/livros');
        }

        // Se falhar, redireciona de volta com erro
        return back()->withErrors(['email' => 'As credenciais fornecidas são inválidas.']) ;
        
    }
}
