{{-- resources/views/alunos.blade.php --}}

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

        <a href="{{ route('alunos.criar') }}" class="btn btn-success">Criar Novo Aluno</a>

        <!-- Formulário de busca -->
        <form method="GET" action="{{ route('alunos.index') }}" id="searchForm">
            <input type="text" id="searchInput" name="search" placeholder="Buscar por nome ou CPF" value="{{ request()->input('search') }}">
            <button type="submit">Buscar</button>
            <button type="button" onclick="document.getElementById('searchInput').value = ''; document.getElementById('searchForm').submit();">Limpar</button>
        </form>

        @if ($alunos->isEmpty())
            <p>Nenhum aluno encontrado.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th> <!-- Adicionando o cabeçalho para ID -->
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>RG</th>
                        <th>Matrícula</th>
                        <th>Curso</th>
                        <th>Status</th>
                        <th>Apm Status</th> <!-- Adicionando o cabeçalho para Apm Status -->
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alunos as $aluno)
                        <tr>
                            <td>{{ $aluno->id_aluno }}</td> <!-- Exibindo o ID do aluno -->
                            <td>{{ $aluno->nome }}</td>
                            <td>{{ $aluno->cpf_aluno }}</td>
                            <td>{{ $aluno->rg }}</td>
                            <td>{{ $aluno->n_matricula }}</td>
                            <td>{{ $aluno->curso->curso ?? 'N/A' }}</td> <!-- Corrigido para 'curso' -->
                            <td>{{ $aluno->statusAluno->status ?? 'N/A' }}</td>
                            <td>{{ $aluno->apmStatus->status ?? 'N/A' }}</td> <!-- Adicionando a exibição do Apm Status -->
                            <td>{{ $aluno->email }}</td>
                            <td>
                                <a href="{{ route('alunos.editar', $aluno->id_aluno) }}" class="btn btn-primary">Editar</a>
                                <a href="{{ route('alunos.show', $aluno->id_aluno) }}" class="btn btn-secondary">Visualizar</a> <!-- Certifique-se de que está assim -->
                                <form action="{{ route('alunos.deletar', $aluno->id_aluno) }}" method="POST" style="display:inline;">
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

        <a href="{{ route('funcionarios.listar') }}" class="btn btn-primary">Voltar para Lista de Funcionários</a>

    </div>
</body>
</html>
