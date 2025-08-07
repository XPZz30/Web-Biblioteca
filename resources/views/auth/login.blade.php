<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Virtual Library</title>

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body class="background-deep-blue">

    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card shadow-lg" style="width: 100%; max-width: 400px; padding: 20px;">
            <div class="text-center mb-4">
                <h2 class="text-light-gray">Virtual Library</h2>
            </div>

            <!-- Formulário de Login -->
            <form method="POST" class="form" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label text-light-gray">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label text-light-gray">Senha</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha" required>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <a href="#" class="text-light-gray">Esqueceu a senha?</a>
                    </div>
                    <button type="submit" class="btn btn-primary">Entrar</button>
                </div>
            </form>


            <div class="mt-4 text-center">
                <p class="text-light-gray">Não tem uma conta? <a href="#" class="text-primary">Cadastre-se</a></p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
