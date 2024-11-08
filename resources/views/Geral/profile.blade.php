<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENAI - Editar perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');
    .font-inter {
        font-family: 'Inter', sans-serif;
    }
</style>
<body class="font-inter bg-gray-100 min-h-screen">

    <div class="flex flex-col items-center mb-10 bg-gray-100"> 
        <div class="container mx-auto pt-2 flex justify-between items-center w-11/12">
            <!-- Logo SENAI e Secretaria -->
            <div class="flex items-center">
                <!-- Logo SENAI -->
                <a href="{{url('')}}"><img src="{{ asset('assets/img/senai.svg') }}" alt="SENAI Logo" class="senai-logo"></a>
                <!-- Texto "Secretaria" -->
                <span class="secretaria-text">Secretaria</span>
            </div>
        </div>
    
        <div class="w-11/12 h-0.5 bg-red-500 mb-2"></div>

        <div class="w-11/12 items-center mb-2"> <!-- Adjusted for positioning -->
            <h2 class="text-3x2 text-red-500 font-black uppercase">Alteração de perfil</h2>
        </div>
        
        <div class="w-11/12 h-0.5 bg-red-500 mb-4"></div> <!-- Red line -->

        <h2 class="text-3x2 font-black uppercase mb-4">Informações para alteração de perfil:</h2>

        <!-- Form Container -->
        <div class="bg-gray-200 p-8 rounded-md shadow-md w-full max-w-2xl"> <!-- Tornado responsivo com w-full -->
            <h2 class="text-lg font-bold mb-4"> Informações</h2>

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
        <button type="submit" class="px-4 py-2 bg-red-600 text-white font-semibold rounded border border-red-700 hover:bg-red-700 mb-4">
            Sair
        </button>
    </form>


    <!-- Navegação de acordo com o cargo -->
    <div>
        @if($funcionario->cargo == 1)
            <a href="{{ route('funcionarios.listar') }}" class="inline-block px-4 py-2 bg-blue-600 text-white font-semibold rounded border border-blue-700 hover:bg-blue-700">Voltar para o Dashboard RH</a>
        @elseif($funcionario->cargo == 2)
            <a href="{{ route('funcionarios.listar') }}" class="inline-block px-4 py-2 bg-blue-600 text-white font-semibold rounded border border-blue-700 hover:bg-blue-700">Voltar para o Dashboard Professor</a>
        @elseif($funcionario->cargo == 3)
            <a href="{{ route('funcionarios.listar') }}" class="inline-block px-4 py-2 bg-blue-600 text-white font-semibold rounded border border-blue-700 hover:bg-blue-700">Voltar para o Dashboard Gestor</a>
        @elseif($funcionario->cargo == 4)
            <a href="{{ route('funcionarios.listar') }}" class="inline-block px-4 py-2 bg-blue-600 text-white font-semibold rounded border border-blue-700 hover:bg-blue-700">Voltar para o Dashboard Master</a>
        @endif
    </div>
    </div>

</body>
</html>

