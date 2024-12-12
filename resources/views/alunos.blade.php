{{-- resources/views/alunos.blade.php --}}

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENAI - Diplomas</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/img/senai.svg') }}">
</head>

<body class="font-inter bg-gray-100">


    <div class="flex flex-col items-center min-h-screen bg-gray-100 relative">
        @include('components.header', [
            'sectionTitle' => 'Secretaria',
            'pageTitle' => 'Dashboard',
        ])



        <h1>Lista de Alunos</h1>

        <a href="{{ route('alunos.criar') }}"> <button class="new-order-btn"> <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>Criar Novo Aluno</button></a>

        <div class="container mx-auto py-6 w-11/12">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">




                <!-- Formulário de busca -->
                <form method="GET" action="{{ route('alunos.index') }}" id="searchForm">
                    <input type="text"
                        class="block w-1/3 p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        id="searchInput" name="search" placeholder="Buscar por nome ou CPF"
                        value="{{ request()->input('search') }}">
                    <button type="submit"
                        class="text-white end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buscar</button>
                    <button type="button"
                        class="text-white end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"onclick="document.getElementById('searchInput').value = ''; document.getElementById('searchForm').submit();">Limpar</button>
                </form>

                @if ($alunos->isEmpty())
                    <p>Nenhum aluno encontrado.</p>
                @else
                    <table class="min-w-full table-auto border-collapse border border-gray-200">
                        <thead class="bg-gray-100 text-gray-600 text-sm uppercase font-semibold">
                            <tr>
                                <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                                <!-- Adicionando o cabeçalho para ID -->
                                <th class="border border-gray-300 px-4 py-2 text-left">Nome</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">CPF</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">RG</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Matrícula</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Curso</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Apm Status</th>
                                <!-- Adicionando o cabeçalho para Apm Status -->
                                <th class="border border-gray-300 px-4 py-2 text-left">Email</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm">
                            @foreach ($alunos as $aluno)
                                <tr class="border-b">
                                    <td class="border border-gray-300 px-4 py-2">{{ $aluno->id_aluno }}</td>
                                    <!-- Exibindo o ID do aluno -->
                                    <td class="border border-gray-300 px-4 py-2">{{ $aluno->nome }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $aluno->cpf_aluno }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $aluno->rg }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $aluno->n_matricula }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $aluno->curso->curso ?? 'N/A' }}
                                    </td> <!-- Corrigido para 'curso' -->
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ $aluno->statusAluno->status ?? 'N/A' }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ $aluno->apmStatus->status ?? 'N/A' }}</td>
                                    <!-- Adicionando a exibição do Apm Status -->
                                    <td class="border border-gray-300 px-4 py-2">{{ $aluno->email }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        <a href="{{ route('alunos.editar', $aluno->id_aluno) }}"
                                            class="btn btn-primary">Editar</a>
                                        <a href="{{ route('alunos.show', $aluno->id_aluno) }}"
                                            class="btn btn-secondary">Visualizar</a>
                                        <!-- Certifique-se de que está assim -->
                                        <form action="{{ route('alunos.deletar', $aluno->id_aluno) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Tem certeza que deseja excluir este aluno?');">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif


                <a href="{{ route('funcionarios.listar') }}" class="btn btn-primary">Voltar para Lista de
                    Funcionários</a>

            </div>
        </div>
    </div>
</body>

</html>
