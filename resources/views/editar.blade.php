<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Funcionário</title>
</head>
<body>
    <h1>Editar Funcionário</h1>

    <!-- Exibir mensagens de erro -->
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif 



    <form action="{{ route('funcionarios.atualizar', ['id' => $funcionario->ID_funcionario]) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="{{ old('nome', $funcionario->nome) }}" required>
        <br>

        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" value="{{ old('cpf', $funcionario->cpf) }}" required>
        <br>

        <label for="nif">NIF:</label>
        <input type="text" id="nif" name="nif" value="{{ old('nif', $funcionario->nif) }}" required>
        <br>

        <label for="cargo">Cargo:</label>
        <select id="cargo" name="cargo" required>
            @foreach($cargos as $cargo)
                <option value="{{ $cargo->id }}" {{ $funcionario->cargo == $cargo->id ? 'selected' : '' }}>
                    {{ $cargo->descricao }}
                </option>
            @endforeach
        </select>
        <br>

        <label for="horario">Horário:</label>
        <select id="horario" name="horario" required>
            @foreach($horarios as $horario)
                <option value="{{ $horario->id }}" {{ $funcionario->horario == $horario->id ? 'selected' : '' }}>
                    {{ $horario->hora_inicio }} - {{ $horario->hora_fim }}
                </option>
            @endforeach
        </select>
        <br>

        <label for="senha">Senha (deixe em branco para não alterar):</label>
        <input type="password" id="senha" name="senha">
        <br>

        <label for="senha_confirmation">Confirme a Senha:</label>
        <input type="password" id="senha_confirmation" name="senha_confirmation">
        <br>

        <button type="submit">Atualizar Funcionário</button>
    </form>

    <a href="{{ route('funcionarios.listar') }}">Voltar para lista</a>
</body>
</html>
