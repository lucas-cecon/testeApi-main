<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENAI - Diplomas</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
</head>
<body class="font-inter bg-gray-100">
    

    <div class="flex flex-col items-center min-h-screen bg-gray-100 relative"> 
        @include('components.header', ['sectionTitle' => 'Secretaria', 'pageTitle' => 'Diplomas'])
        <div class="flex space-x-2">
        <a href="{{ route('diplomas.create') }}">
    <button class="new-order-btn">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Criar Novo Diploma</button>
</a>


<a href="{{ route('dashboard.rh') }}">
    <button class="new-order-btn" stroke="currentColor">Voltar</button>
</a>
</div>
        <div class="container mx-auto py-6 w-11/12">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="overflow-x-auto"> <!-- Permitir rolagem horizontal -->
                    @if (!empty($error))
                        <div class="bg-red-500 text-white p-4 mb-4">{{ $error }}</div>
                    @else
                    
                    <form method="GET" action="{{ route('diplomas.pesquisa') }}" id="filterForm">
    <input type="text" name="search" class="block w-1/3 p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar por Título do Diploma, Nome do Aluno, CPF ou RG" value="{{ request('search') }}">
    <button type="submit" class="text-white end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Filtrar</button>
    <button type="button" class="text-white end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" onclick="document.getElementById('filterForm').reset(); window.location.href='{{ route('diplomas.pesquisa') }}';">Limpar</button>
</form>

<h1 class="text-sm uppercase font-semibold text-center">Lista de Diplomas</h1>


<table class="min-w-full table-auto border-collapse border border-gray-200">
                            <thead class="bg-gray-100 text-gray-600 text-sm uppercase font-semibold">
        <tr>
            <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
            <th class="border border-gray-300 px-4 py-2 text-left">Título do Diploma</th>
            <th class="border border-gray-300 px-4 py-2 text-left">Lote</th>
            <th class="border border-gray-300 px-4 py-2 text-left">Quantidade</th>
            <th class="border border-gray-300 px-4 py-2 text-left">Turma</th>
            <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
            <th class="border border-gray-300 px-4 py-2 text-left">Ações</th>
        </tr>
    </thead>
    <tbody class="text-gray-700 text-sm">
        @foreach($diplomas as $diploma)
            <tr class="border-b">
                <td class="border border-gray-300 px-4 py-2">{{ $diploma->id }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $diploma->titulo }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $diploma->lote_diploma }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $diploma->quant_diploma }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $diploma->curso->curso }}</td>
                <td class="border border-gray-300 px-4 py-2">
                    @if($diploma->status == 1)
                        Aberto
                    @elseif($diploma->status == 2)
                        Em andamento
                    @elseif($diploma->status == 3)
                        Concluído
                    @else
                        Desconhecido
                    @endif
                </td>
                <td>
                    <a href="{{ route('dashboard.rh.diplomas.show', $diploma->id) }}">Visualizar</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


@endif
                </div>
            </div>
        </div>
    </div>

</body>
</html>