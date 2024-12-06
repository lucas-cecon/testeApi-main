@php
    $route = '';
    switch($cargo) {
        case 1:
            $route = route('dashboard.rh');
            break;
        case 2:
            $route = route('dashboard.professor');
            break;
        case 3:
            $route = route('dashboard.gestor');
            break;
        case 4:
            $route = route('dashboard.master');
            break;
    }
@endphp

{{ $route }}

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENAI - Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/img/senai.svg') }}">
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

        <a href="{{ route('$route') }}">
            <button style="margin-top: 20px;">Voltar para Lista de Funcionários</button>
        </a>
    </div>
</body>
</html>
