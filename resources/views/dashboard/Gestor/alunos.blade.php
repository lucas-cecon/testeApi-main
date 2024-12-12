{{-- resources/views/dashboard/gestor/alunos.blade.php --}}

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Alunos</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Adicione seu CSS aqui -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/img/senai.svg') }}">
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
        <form method="GET" action="{{ route('dashboard.gestor.alunos.pesquisa') }}" id="searchForm"
            style="margin-bottom: 20px;">
            <input type="text" id="searchInput" name="search" placeholder="Buscar por nome"
                value="{{ request()->input('search') }}">
            <button type="submit">Buscar</button>
            <button type="button"
                onclick="document.getElementById('searchInput').value = ''; document.getElementById('searchForm').submit();">Limpar</button>
        </form>

        <a href="{{ route('dashboard.gestor.alunos.criar') }}" class="btn btn-success">Criar Novo Aluno</a>

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
                                <a href="{{ route('dashboard.gestor.alunos.editar', $aluno->id_aluno) }}"
                                    class="btn btn-primary">Editar</a>
                                <a href="{{ route('dashboard.gestor.alunos.detalhes', $aluno->id_aluno) }}"
                                    class="btn btn-secondary">Visualizar</a>
                                <form action="{{ route('dashboard.gestor.alunos.deletar', $aluno->id_aluno) }}"
                                    method="POST" style="display:inline;">
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

        <a href="{{ route('dashboard.gestor') }}" class="btn btn-primary">Voltar para o Dashboard</a>
    </div>
</body>

</html>
