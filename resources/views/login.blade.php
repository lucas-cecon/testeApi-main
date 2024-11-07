<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    
    <!-- Exibe mensagens de erro se houver -->
    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <!-- Formulário de login -->
    <form action="{{ route('funcionarios.autenticar') }}" method="POST">
        @csrf <!-- Gera um token CSRF para proteger o formulário -->
        
        <label for="cpf_nif">CPF ou NIF:</label>
        <input type="text" id="cpf_nif" name="cpf_nif" required><br><br>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>
