<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENAI - Funcionários</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/img/senai.svg') }}">
</head>
<body class="font-inter bg-gray-100">
    

    <div class="flex flex-col items-center min-h-screen bg-gray-100 relative"> 
        @include('components.header', [
            'sectionTitle' => 'Secretaria',
            'pageTitle' => 'Funcionários',
            'logoUrl' => route('dashboard.master') // Defina a URL desejada
        ])

    <h1>Lista de Funcionários</h1>


    <!-- Botão para cadastrar novo funcionário -->
    <a href="{{ route('dashboard.master.cadastrar') }}"><button class="new-order-btn"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>Cadastrar novo Funcionário</button>
    </a>

    <div class="container mx-auto py-6 w-11/12">
            <div class=" rounded-lg overflow-hidden">

    <!-- Campo de pesquisa -->
    <form method="GET" action="{{ route('dashboard.master.funcionarios.listar') }}" id="searchForm" class="flex flex-col md:flex-row items-center justify-center mb-6">
        <input type="text" class="block w-1/3 p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mr-5" id="searchInput" name="search" placeholder="Buscar por nome ou CPF" value="{{ request()->input('search') }}">
        <button type="submit" class="text-white end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mr-5">Buscar</button>
        <button type="button" class="text-white end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" onclick="document.getElementById('searchInput').value = ''; document.getElementById('searchForm').submit();">Limpar</button>
    </form>

    <!-- Tabela de funcionários --> 
                                <div class="container mx-auto py-6 w-11/12 ">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="overflow-x-auto"> <!-- Permitir rolagem horizontal -->
    <table class="min-w-full table-auto border-collapse border border-gray-200">
        <thead class="bg-gray-100 text-gray-600 text-sm uppercase font-semibold">
            <tr>
                <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Nome</th>
                <th class="border border-gray-300 px-4 py-2 text-left">CPF</th>
                <th class="border border-gray-300 px-4 py-2 text-left">NIF</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Cargo</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Horário</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Ações</th>
            </tr>
        </thead>
        <tbody class="text-gray-700 text-sm">
            @if($funcionarios->isEmpty())
                <tr>
                    <td colspan="7">Nenhum funcionário encontrado</td>
                </tr>
            @else
                @foreach ($funcionarios as $funcionario)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $funcionario->ID_funcionario }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $funcionario->nome }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $funcionario->cpf }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $funcionario->nif }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $funcionario->cargo->descricao ?? 'Cargo não encontrado' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $funcionario->horario->hora_inicio ?? 'N/A' }} - {{ $funcionario->horario->hora_fim ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <a class="text-blue-500 text-decoration-line: underline" href="{{ route('dashboard.master.funcionarios.editar', ['id' => $funcionario->ID_funcionario]) }}">Editar</a>
                            <form action="{{ route('dashboard.master.funcionarios.deletar', ['id' => $funcionario->ID_funcionario]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 text-decoration-line: underline" onclick="return confirm('Tem certeza que deseja deletar este funcionário?')">Deletar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <br>

</div>
</div>
</div>
</body>
</html>
