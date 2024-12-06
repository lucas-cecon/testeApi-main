{{-- resources/views/dashboard/master/alunos.blade.php --}}

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENAI - Alunos</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/img/senai.svg') }}">
</head>
<body class="font-inter bg-gray-100">
{{-- 
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

        <!-- Exibir informações do token e nome do usuário logado -->
        @if (session('token') && session('nome') && session('cargo'))
            <div style="color: blue;">
                Seu token: {{ session('token') }}<br>
                Seja bem-vindo, {{ session('nome') }}!<br>
                Seu cargo: {{ session('cargo') }}
            </div> --}}
        {{-- @endif --}}

    <div class="flex flex-col items-center min-h-screen bg-gray-100 relative">
        @include('components.header', [
            'sectionTitle' => 'Secretaria',
            'pageTitle' => 'Alunos',
            'logoUrl' => route('dashboard.master') // Defina a URL desejada
        ])

        <!-- Botões de Ação -->
        <div class="flex space-x-4 mt-4">
            <a href="{{ route('dashboard.master.alunos.criar') }}">
                <button class="new-order-btn flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Criar novo aluno
                </button>
            </a>

            <a href="{{ route('dashboard.master') }}">
                <button class="new-order-btn text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2">
                    Voltar
                </button>
            </a>
        </div>

        <!-- Formulário de Pesquisa -->
        <div class="container mx-auto py-6 w-11/12">
            <div class="rounded-lg overflow-hidden">
                <div class="overflow-x-auto bg-gray-100"> <!-- Fundo alterado -->
                    @if (!empty($error))
                        <div class="bg-red-500 text-white p-4 mb-4">{{ $error }}</div>
                    @else
                        <form method="GET" action="{{ route('dashboard.master.alunos.pesquisa') }}" id="filterForm" class="flex flex-col md:flex-row items-center justify-center mb-6">
                            <input 
                                type="text" 
                                name="search" 
                                class="block py-2 w-full md:w-1/3 p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                placeholder="Buscar por Nome do Aluno"
                                value="{{ request('search') }}"
                            />
                            <div class="flex gap-2 mt-4 md:mt-0 md:ml-4">
                                <button 
                                    type="submit" 
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
                                    Filtrar
                                </button>
                                <button 
                                    type="button" 
                                    class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2"
                                    onclick="document.getElementById('filterForm').reset(); window.location.href='{{ route('dashboard.master.alunos.pesquisa') }}';">
                                    Limpar
                                </button>
                            </div>
                        </form>

                        <h1 class="text-center text-xl font-semibold mb-4">Lista de Alunos</h1>
                                <div class="container mx-auto py-6 w-11/12 ">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="overflow-x-auto"> <!-- Permitir rolagem horizontal -->
                        <table class="min-w-full table-auto border-collapse border border-gray-200">
                            <thead class="bg-gray-100 text-gray-600 text-sm uppercase font-semibold">
                                <tr>
                                    <th class="border border-gray-300 px-2 py-2 text-left">ID</th>
                                    <th class="border border-gray-300 px-2 py-2 text-left">Nome</th>
                                    <th class="border border-gray-300 px-2 py-2 text-left">CPF</th>
                                    <th class="border border-gray-300 px-2 py-2 text-left">RG</th>
                                    <th class="border border-gray-300 px-2 py-2 text-left">Matrícula</th>
                                    <th class="border border-gray-300 px-2 py-2 text-left">Curso</th>
                                    <th class="border border-gray-300 px-2 py-2 text-left">Status</th>
                                    <th class="border border-gray-300 px-2 py-2 text-left">Aapm Status</th>
                                    <th class="border border-gray-300 px-2 py-2 text-left">Email</th>
                                    <th class="border border-gray-300 px-2 py-2 text-left">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700 text-sm">
                                @foreach($alunos as $aluno)
                                    <tr class="border-b">
                                        <td class="border border-gray-300 px-2 py-2">{{ $aluno->id_aluno }}</td>
                                        <td class="border border-gray-300 px-2 py-2">{{ $aluno->nome }}</td>
                                        <td class="border border-gray-300 px-2 py-2">{{ $aluno->cpf_aluno }}</td>
                                        <td class="border border-gray-300 px-2 py-2">{{ $aluno->rg }}</td>
                                        <td class="border border-gray-300 px-2 py-2">{{ $aluno->n_matricula }}</td>
                                        <td class="border border-gray-300 px-2 py-2">{{ $aluno->curso->curso ?? 'N/A' }}</td>
                                         <td class="border border-gray-300 px-2 py-2">{{ $aluno->statusAluno->status ?? 'N/A' }}</td>
                                        <td class="border border-gray-300 px-2 py-2">{{ $aluno->apmStatus->status ?? 'N/A' }}</td>
                                        <td class="border border-gray-300 px-2 py-2">{{ $aluno->email }}</td>
                                        </td>
                                        <td class="border border-gray-300 px-2 py-2">
                                           <a href="{{ route('dashboard.master.alunos.editar', $aluno->id_aluno) }}" class="btn text-blue-500 btn-primary text-decoration-line: underline">Editar</a>
                                <a href="{{ route('dashboard.master.alunos.detalhes', $aluno->id_aluno) }}" class="btn text-blue-500 btn-secondary text-decoration-line: underline">Visualizar</a>
                                <form action="{{ route('dashboard.master.alunos.deletar', $aluno->id_aluno) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn text-red-500 btn-danger text-decoration-line: underline" onclick="return confirm('Tem certeza que deseja excluir este aluno?');">Excluir</button>
                                </form>
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





























{{-- 

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Alunos</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Adicione seu CSS aqui -->
</head>
<body>
    <div class="container">
        <h1>Lista de Alunos</h1>

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

        <!-- Exibir informações do token e nome do usuário logado -->
        @if (session('token') && session('nome') && session('cargo'))
            <div style="color: blue;">
                Seu token: {{ session('token') }}<br>
                Seja bem-vindo, {{ session('nome') }}!<br>
                Seu cargo: {{ session('cargo') }}
            </div>
        @endif

        <!-- Formulário de busca -->
        <form method="GET" action="{{ route('dashboard.master.alunos.pesquisa') }}" id="searchForm" style="margin-bottom: 20px;">
            <input type="text" id="searchInput" name="search" placeholder="Buscar por nome" value="{{ request()->input('search') }}">
            <button type="submit">Buscar</button>
            <button type="button" onclick="document.getElementById('searchInput').value = ''; document.getElementById('searchForm').submit();">Limpar</button>
        </form>

        <a href="{{ route('dashboard.master.alunos.criar') }}" class="btn btn-success">Criar Novo Aluno</a>

        @if ($alunos->isEmpty())
            <p>Nenhum aluno encontrado.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>RG</th>
                        <th>Matrícula</th>
                        <th>Curso</th>
                        <th>Status</th>
                        <th>Apm Status</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alunos as $aluno)
                        <tr>
                            <td>{{ $aluno->id_aluno }}</td>
                            <td>{{ $aluno->nome }}</td>
                            <td>{{ $aluno->cpf_aluno }}</td>
                            <td>{{ $aluno->rg }}</td>
                            <td>{{ $aluno->n_matricula }}</td>
                            <td>{{ $aluno->curso->curso ?? 'N/A' }}</td>
                            <td>{{ $aluno->statusAluno->status ?? 'N/A' }}</td>
                            <td>{{ $aluno->apmStatus->status ?? 'N/A' }}</td>
                            <td>{{ $aluno->email }}</td>
                            <td>
                                <a href="{{ route('dashboard.master.alunos.editar', $aluno->id_aluno) }}" class="btn btn-primary">Editar</a>
                                <a href="{{ route('dashboard.master.alunos.detalhes', $aluno->id_aluno) }}" class="btn btn-secondary">Visualizar</a>
                                <form action="{{ route('dashboard.master.alunos.deletar', $aluno->id_aluno) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este aluno?');">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <a href="{{ route('dashboard.master') }}" class="btn btn-primary">Voltar para o Dashboard</a>
    </div>
</body>
</html> --}}
