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

    <div class="flex flex-col items-center bg-gray-100 relative"> 
            @include('components.header', ['sectionTitle' => 'Perfil', 'pageTitle' => 'Perfil'])
    </div>

    <div>
        <div class="bg-gray-100 flex items-center justify-center flex-col min-h-screen">

        <div class="bg-white p  -8 rounded-lg shadow-lg max-w-md w-full mb-5">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Informações do perfil</h2>
            <input type="text" placeholder="Nome" class="border-2 border-red-300 rounded-md p-2 w-full mb-4"/>
            <input type="email" placeholder="E-mail" class="border-2 border-red-300 rounded-md p-2 w-full mb-4"/>
            <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">Salvar</button>
        </div>
    
        </div>
    </div>

    <!-- Exibir mensagens de sucesso ou erro -->
    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif

    <!-- Informações do perfil -->
    <h3>Informações do Usuário</h3>
    <p><strong>Nome:</strong> {{ $funcionario->nome }}</p>
    <p><strong>Cargo:</strong> {{ session('cargo') }}</p>

    <!-- Botão de logout -->
    <form method="POST" action="{{ route('funcionarios.logout') }}">
        @csrf
        <button type="submit" style="margin-bottom: 20px;">Sair</button>
    </form>

    <!-- Navegação de acordo com o cargo -->
    <div>
        @if($funcionario->cargo == 1)
            <a href="{{ route('dashboard.rh') }}" class="btn btn-primary">Voltar para o Dashboard RH</a>
        @elseif($funcionario->cargo == 2)
            <a href="{{ route('dashboard.professor') }}" class="btn btn-primary">Voltar para o Dashboard Professor</a>
        @elseif($funcionario->cargo == 3)
            <a href="{{ route('dashboard.gestor') }}" class="btn btn-primary">Voltar para o Dashboard Gestor</a>
        @elseif($funcionario->cargo == 4)
            <a href="{{ route('funcionarios.listar') }}" class="btn btn-primary">Voltar para o Dashboard Master</a>
        @endif
    </div>
</div>
