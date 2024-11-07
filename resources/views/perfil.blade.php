{{-- resources/views/perfil.blade.php --}}

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Funcionário</title>
</head>
<body>
    <div class="container">
        <h1>Perfil do Funcionário</h1>

        <!-- Exibir informações do usuário logado -->
        @if ($funcionario)
            <div style="color: blue;">
                <strong>Nome:</strong> {{ $funcionario->nome }}<br>
                <strong>CPF:</strong> {{ $funcionario->cpf }}<br> <!-- Exibindo o CPF do funcionário -->
            </div>
        @else
            <p>Nenhuma informação do funcionário encontrada.</p>
        @endif

        <a href="{{ route('funcionarios.listar') }}">
            <button style="margin-top: 20px;">Voltar para Lista de Funcionários</button>
        </a>
    </div>
</body>
</html>
