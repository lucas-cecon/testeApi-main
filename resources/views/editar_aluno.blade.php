<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aluno</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/img/senai.svg') }}">
</head>

<body>
    <h1>Editar Aluno: {{ $aluno->nome }}</h1>
    <form action="{{ route('alunos.atualizar', $aluno->id_aluno) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="nome">Nome:</label>
        <input type="text" name="nome" value="{{ $aluno->nome }}" required>
        <br>

        <label for="cpf_aluno">CPF:</label>
        <input type="text" name="cpf_aluno" value="{{ $aluno->cpf_aluno }}" required>
        <br>

        <label for="rg">RG:</label>
        <input type="text" name="rg" value="{{ $aluno->rg }}" required>
        <br>

        <label for="n_matricula">Número de Matrícula:</label>
        <input type="text" name="n_matricula" value="{{ $aluno->n_matricula }}" required>
        <br>

        <label for="curso">Curso:</label>
        <select name="curso" required>
            @foreach ($cursos as $curso)
                <option value="{{ $curso->id }}" {{ $curso->id == $aluno->curso ? 'selected' : '' }}>
                    {{ $curso->curso }}
                </option>
            @endforeach
        </select>
        <br>

        <label for="status_aluno">Status:</label>
        <select name="status_aluno" required>
            @foreach ($statusAlunos as $status)
                <option value="{{ $status->id }}" {{ $status->id == $aluno->status_aluno ? 'selected' : '' }}>
                    {{ $status->status }}
                </option>
            @endforeach
        </select>
        <br>

        <label for="apm_status">APM Status:</label>
        <select name="apm_status" required>
            @foreach ($apmStatus as $apm)
                <option value="{{ $apm->id }}" {{ $apm->id == $aluno->apm_status ? 'selected' : '' }}>
                    {{ $apm->status }} <!-- Altere "status" se a propriedade correta for diferente -->
                </option>
            @endforeach
        </select>
        <br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="{{ $aluno->email }}" required>
        <br>

        <button type="submit">Atualizar Aluno</button>
    </form>
</body>

</html>
