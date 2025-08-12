<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Virtual Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body class="auth-page">
    <div class="auth-container">
        <!-- Colocando o logo e título fora do formulário -->
        <div class="auth-header text-center">
            <div class="auth-img">
                <img src="image/logo.png" alt="Logo" class="img-fluid">
            </div>
            <h1>Virtual Library</h1>
        </div>

        <!-- Formulário de login dentro de um card -->
        <div class="auth-card">
            <form method="POST" action="{{ route('login') }}" class="auth-form">
                @csrf
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>

                <div class="auth-actions">
                    <a href="#" class="forgot-password">Esqueceu a senha?</a>
                    <button type="submit" class="btn btn-primary">Entrar</button>
                </div>
            </form>

            <div class="auth-footer">
                <p>Não tem uma conta? <a href="#" class="register-link">Cadastre-se</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
