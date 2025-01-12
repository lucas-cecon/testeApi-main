<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENAI - AAPM</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('../css/header.css') }}">
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
            <div class=" rounded-lg overflow-hidden">


                <form method="GET" action="{{ route('alunos.pesquisar') }}" id="filterForm"
                    class="flex flex-col md:flex-row items-center justify-center mb-6">
                    <input type="text" name="search"
                        class="block w-full md:w-1/4 p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Buscar por Título do Diploma, Nome do Aluno, CPF ou RG"
                        value="{{ request('search') }}" />
                    <div class="flex gap-2 mt-4 md:mt-0 md:ml-4">
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
                            Filtrar
                        </button>
                        <button type="button"
                            class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2"
                            onclick="document.getElementById('filterForm').reset(); window.location.href='{{ route('dashboard.rh.apm') }}';">
                            Limpar
                        </button>
                        <a href="{{ route('dashboard.rh') }}"><button class="new-order-btn" stroke="currentColor">
                                Voltar
                            </button></a>
                    </div>
                </form>

                <!-- Conteúdo da página (Tabela) -->
                <div class="container mx-auto py-6 w-11/12 ">
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="overflow-x-auto"> <!-- Permitir rolagem horizontal -->
                            <table class="min-w-full table-auto border-collapse border border-gray-200">
                                <thead class="bg-gray-100 text-gray-600 text-sm uppercase font-semibold">
                                    <tr>
                                        <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">Aluno</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">CPF</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">AAPM status</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">Ações</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-700 text-sm">
                                    @foreach ($alunos as $aluno)
                                        <tr class="border-b">
                                            <td class="border border-gray-300 px-4 py-2">{{ $aluno->id_aluno }}</td>
                                            <td class="border border-gray-300 px-4 py-2">{{ $aluno->nome }}</td>
                                            <td class="border border-gray-300 px-4 py-2">{{ $aluno->cpf_aluno }}</td>
                                            <td class="border border-gray-300 px-4 py-2">
                                                {{ $aluno->apmStatus->status ?? 'N/A' }}</td>
                                            <td class="border border-gray-300 px-4 py-2">
                                                <a href="{{ route('dashboard.rh.visualizar_aluno', $aluno->id_aluno) }}"
                                                    class="btn btn-info">Visualizar</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

</body>

</html>
