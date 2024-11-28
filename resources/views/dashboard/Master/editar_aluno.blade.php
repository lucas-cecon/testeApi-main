<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aluno</title>
</head>
<body>
    <h1>Editar Aluno: {{ $aluno->nome }}</h1>
    <form action="{{ route('dashboard.master.alunos.atualizar', $aluno->id_aluno) }}" method="POST">
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
            @foreach($cursos as $curso)
                <option value="{{ $curso->id }}" {{ $curso->id == $aluno->curso ? 'selected' : '' }}>
                    {{ $curso->curso }}
                </option>
            @endforeach
        </select>
        <br>

        <label for="status_aluno">Status:</label>
        <select name="status_aluno" required>
            @foreach($statusAlunos as $status)
                <option value="{{ $status->id }}" {{ $status->id == $aluno->status_aluno ? 'selected' : '' }}>
                    {{ $status->status }}
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
