<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aluno</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/img/senai.svg') }}">
</head>
<body>
    <h1>Editar Aluno</h1>

    <form action="{{ route('dashboard.rh.atualizar_aluno', $aluno->id_aluno) }}" method="POST">
        @csrf
        @method('POST')

        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="{{ $aluno->nome }}" required>

        <label for="cpf_aluno">CPF:</label>
        <input type="text" name="cpf_aluno" id="cpf_aluno" value="{{ $aluno->cpf_aluno }}" required>

        <label for="rg">RG:</label>
        <input type="text" name="rg" id="rg" value="{{ $aluno->rg }}">

        <label for="n_matricula">Número de Matrícula:</label>
        <input type="text" name="n_matricula" id="n_matricula" value="{{ $aluno->n_matricula }}" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="{{ $aluno->email }}" required>

        <label for="curso">Curso:</label>
        <select name="curso" id="curso" required>
            @foreach($cursos as $curso)
                <option value="{{ $curso->id }}" {{ $curso->id == $aluno->curso->id ? 'selected' : '' }}>
                    {{ $curso->curso }}
                </option>
            @endforeach
        </select>

        <label for="status_aluno">Status:</label>
        <select name="status_aluno" id="status_aluno" required>
            @foreach($statusAlunos as $status)
                <option value="{{ $status->id }}" {{ $status->id == $aluno->statusAluno->id ? 'selected' : '' }}>
                    {{ $status->status }}
                </option>
            @endforeach
        </select>

        <label for="apm_status">APM Status:</label>
        <select name="apm_status" id="apm_status" required>
            @foreach($apmStatuses as $apm)
                <option value="{{ $apm->id }}" {{ $apm->id == $aluno->apmStatus->id ? 'selected' : '' }}>
                    {{ $apm->status }}
                </option>
            @endforeach
        </select>

        <button type="submit">Salvar</button>
    </form>

    <a href="{{ route('dashboard.rh.apm') }}">Voltar para a lista</a>
</body>
</html>
