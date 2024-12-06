<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Funcionário</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/img/senai.svg') }}">
</head>
<body>
    <h1>Cadastrar Funcionário</h1>

    <a href="{{ route('funcionarios.listar') }}">Voltar</a>

    <!-- Exibe mensagens de sucesso ou erro -->
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <!-- Exibe os erros de validação -->
    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('funcionarios.adicionar') }}" method="POST">
        @csrf
        <label for="nome">Nome:</label>
        <input type="text" name="nome" value="{{ old('nome') }}">
        <br>

        <label for="cpf">CPF:</label>
        <input type="text" name="cpf" value="{{ old('cpf') }}">
        <br>

        <label for="nif">NIF:</label>
        <input type="text" name="nif" value="{{ old('nif') }}">
        <br>

        <label for="cargo">Cargo:</label>
        <select name="cargo">
            @foreach($cargos as $cargo)
                <option value="{{ $cargo->id }}" {{ old('cargo') == $cargo->id ? 'selected' : '' }}>{{ $cargo->descricao }}</option>
            @endforeach
        </select>
        <br>

        <label for="horario">Horário:</label>
        <select name="horario">
            @foreach($horarios as $horario)
                <option value="{{ $horario->id }}" {{ old('horario') == $horario->id ? 'selected' : '' }}>
                    {{ $horario->hora_inicio }} - {{ $horario->hora_fim }}
                </option>
            @endforeach
        </select>
        <br>

        <label for="senha">Senha:</label>
        <input type="password" name="senha">
        <br>

        <label for="senha_confirmation">Confirme a Senha:</label>
        <input type="password" name="senha_confirmation">
        <br>

        <button type="submit">Cadastrar Funcionário</button>
    </form>
</body>
</html>
