<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Funcionários</title>
</head>
<body>
    <h1>Lista de Funcionários</h1>

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
            Seu cargo: {{ session('cargo') }} <br>
        </div>
    @endif

    <!-- Botão para cadastrar novo funcionário -->
    <a href="{{ route('funcionarios.cadastrar') }}">
        <button style="margin-bottom: 20px;">Cadastrar novo Funcionário</button>
    </a>

    <!-- Campo de pesquisa -->
    <form method="GET" action="{{ route('funcionarios.listar') }}" id="searchForm">
        <input type="text" id="searchInput" name="search" placeholder="Buscar por nome ou CPF" value="{{ request()->input('search') }}">
        <button type="submit">Buscar</button>
        <button type="button" onclick="document.getElementById('searchInput').value = ''; document.getElementById('searchForm').submit();">Limpar</button>
    </form>

    <!-- Tabela de funcionários -->
    <table border="1" style="margin-top: 20px;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>NIF</th>
                <th>Cargo</th>
                <th>Horário</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @if($funcionarios->isEmpty())
                <tr>
                    <td colspan="7">Nenhum funcionário encontrado</td>
                </tr>
            @else
                @foreach ($funcionarios as $funcionario)
                    <tr>
                        <td>{{ $funcionario->ID_funcionario }}</td>
                        <td>{{ $funcionario->nome }}</td>
                        <td>{{ $funcionario->cpf }}</td>
                        <td>{{ $funcionario->nif }}</td>
                        <td>{{ $funcionario->cargo->descricao ?? 'Cargo não encontrado' }}</td>
                        <td>{{ $funcionario->horario->hora_inicio ?? 'N/A' }} - {{ $funcionario->horario->hora_fim ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('funcionarios.editar', ['id' => $funcionario->ID_funcionario]) }}">Editar</a>
                            <form action="{{ route('api.funcionarios.deletar', ['id' => $funcionario->ID_funcionario]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Tem certeza que deseja deletar este funcionário?')">Deletar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <a href="{{ route('alunos.listar') }}">
        <button style="margin-bottom: 20px;">Ver Todos os Alunos</button>
    </a>

    <br>

    <a href="{{ route('perfil') }}">
        <button style="margin-bottom: 20px;">Ver Perfil</button>
    </a>


</body>
</html>
