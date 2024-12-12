<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENAI - Ponto Virtual</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/img/senai.svg') }}">
</head>

<body class="font-inter bg-gray-100">

    <div class="flex flex-col items-center min-h-screen bg-gray-100 relative">
        @include('components.header', [
            'sectionTitle' => 'Secretaria',
            'pageTitle' => 'Dashboard',
            'logoUrl' => route('dashboard.rh'),
        ])

        <div class="container mx-auto py-6 w-11/12">
            <div class="rounded-lg overflow-hidden">
                <div class="overflow-x-auto bg-gray-100"> <!-- Fundo alterado para a mesma cor do resto da página -->
                    @if (!empty($error))
                        <div class="bg-red-500 text-white p-4 mb-4">{{ $error }}</div>
                    @else
                        <!-- Formulário de busca -->
                        <form method="GET" action="{{ route('dashboard.rh.pesquisar') }}" id="searchForm"
                            class="flex flex-col md:flex-row items-center justify-center mb-6">
                            <input type="text"
                                class="block w-full md:w-1/3 p-4 ps-10 mt-5 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                                id="searchInput" name="search" placeholder="Buscar por funcionário ou status"
                                value="{{ request()->input('search') }}" />
                            <div class="flex gap-2 mt-4 md:mt-0 md:ml-4">
                                <button type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
                                    Buscar
                                </button>
                                <button type="button"
                                    class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2"
                                    onclick="document.getElementById('searchInput').value = ''; document.getElementById('searchForm').submit();">
                                    Limpar
                                </button>
                                <a href="{{ route('dashboard.rh') }}"><button class="new-order-btn"
                                        stroke="currentColor">Voltar</button></a>
                            </div>
                        </form>

                        <h3 class="text-center text-xl font-semibold mb-4">Pedidos Pendentes</h3>
                        <div class="container mx-auto py-6 w-11/12 ">
                            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                                <div class="overflow-x-auto"> <!-- Permitir rolagem horizontal -->
                                    <table class="min-w-full table-auto border-collapse border border-gray-200">
                                        <thead class="bg-gray-100 text-gray-600 text-sm uppercase font-semibold">
                                            <tr>
                                                <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                                                <th class="border border-gray-300 px-4 py-2 text-left">Funcionário</th>
                                                <th class="border border-gray-300 px-4 py-2 text-left">Horário Antigo
                                                </th>
                                                <th class="border border-gray-300 px-4 py-2 text-left">Horário Novo</th>
                                                <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                                                <th class="border border-gray-300 px-4 py-2 text-left">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-gray-700 text-sm">
                                            @foreach ($tickets as $ticket)
                                                <tr class="border-b">
                                                    <td class="border border-gray-300 px-4 py-2">{{ $ticket->id }}
                                                    </td>
                                                    <td class="border border-gray-300 px-4 py-2">
                                                        {{ $ticket->funcionario->nome }}</td>
                                                    <td class="border border-gray-300 px-4 py-2">
                                                        {{ $ticket->horarioAntigo->codigo }}
                                                        ({{ $ticket->horarioAntigo->hora_inicio }} -
                                                        {{ $ticket->horarioAntigo->hora_fim }})
                                                    </td>
                                                    <td class="border border-gray-300 px-4 py-2">
                                                        {{ $ticket->horarioNovo->codigo }}
                                                        ({{ $ticket->horarioNovo->hora_inicio }} -
                                                        {{ $ticket->horarioNovo->hora_fim }})
                                                    </td>
                                                    <td class="border border-gray-300 px-4 py-2">
                                                        {{ $ticket->statusTicket->status }}</td>
                                                    <td class="border border-gray-300 px-4 py-2">
                                                        <a href="{{ route('dashboard.rh.show_ticket', $ticket->id) }}"
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
