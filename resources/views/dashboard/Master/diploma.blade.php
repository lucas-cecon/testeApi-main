<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENAI - Diploma</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/img/senai.svg') }}">
</head>

<body class="font-inter bg-gray-100">
    <div class="flex flex-col items-center min-h-screen bg-gray-100 relative">
        @include('components.header', [
            'sectionTitle' => 'Secretaria',
            'pageTitle' => 'Diploma',
            'logoUrl' => route('dashboard.master'), // Defina a URL desejada
        ])

        <!-- Botões de Ação -->
        <div class="flex space-x-4 mt-4">
            <a href="{{ route('diploma.create.rh') }}">
                <button
                    class="new-order-btn flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="h-4 w-4 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Criar Novo Diploma
                </button>
            </a>

            <a href="{{ route('dashboard.master') }}">
                <button
                    class="new-order-btn text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2">
                    Voltar
                </button>
            </a>
        </div>

        <!-- Formulário de Pesquisa -->
        <div class="container mx-auto py-6 w-11/12">
            <div class="shadow-md rounded-lg overflow-hidden">
                <div class="overflow-x-auto bg-gray-100"> <!-- Fundo alterado -->
                    @if (!empty($error))
                        <div class="bg-red-500 text-white p-4 mb-4">{{ $error }}</div>
                    @else
                        <form method="GET" action="{{ route('diploma.pesquisa') }}" id="filterForm"
                            class="flex flex-col md:flex-row items-center justify-center mb-6">
                            <input type="text" name="search"
                                class="block w-full md:w-1/3 p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Buscar por Título do Diploma, Nome do Aluno, CPF ou RG"
                                value="{{ request('search') }}" />
                            <div class="flex gap-2 mt-4 md:mt-0 md:ml-4">
                                <button type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
                                    Filtrar
                                </button>
                                <button type="button"
                                    class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2"
                                    onclick="document.getElementById('filterForm').reset(); window.location.href='{{ route('diploma.pesquisa') }}';">
                                    Limpar
                                </button>
                            </div>
                        </form>

                        <h1 class="text-center text-xl font-semibold mb-4">Lista de Diploma</h1>

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
                                @foreach ($diploma as $diploma)
                                    <tr class="border-b">
                                        <td class="border border-gray-300 px-4 py-2">{{ $diploma->id }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $diploma->titulo }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $diploma->lote_diploma }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $diploma->quant_diploma }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $diploma->curso->curso }}</td>
                                        <td class="border border-gray-300 px-4 py-2">
                                            @if ($diploma->status == 1)
                                                Aberto
                                            @elseif($diploma->status == 2)
                                                Em andamento
                                            @elseif($diploma->status == 3)
                                                Concluído
                                            @else
                                                Desconhecido
                                            @endif
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2">
                                            <a href="{{ route('dashboard.rh.diploma.show', $diploma->id) }}"
                                                class="text-blue-600 hover:underline">
                                                Visualizar
                                            </a>
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
