<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENAI - Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
</head>
<body class="bg-gray-100">
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
