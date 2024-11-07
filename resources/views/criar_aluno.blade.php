<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Novo Aluno</title>
</head>
<body>
    <h1>Criar Novo Aluno</h1>
    <form action="{{ route('alunos.armazenar') }}" method="POST">
        @csrf
        
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required>
        <br>

        <label for="cpf_aluno">CPF:</label>
        <input type="text" name="cpf_aluno" required>
        <br>

        <label for="rg">RG:</label>
        <input type="text" name="rg" required>
        <br>

        <label for="n_matricula">Número de Matrícula:</label>
        <input type="text" name="n_matricula" required>
        <br>

        <label for="curso_id">Curso:</label>
        <select name="curso" required> <!-- Alterado para 'curso' -->
            @foreach ($cursos as $curso)
                <option value="{{ $curso->id }}">{{ $curso->curso }}</option>
            @endforeach
        </select>
        
        <br>

        <label for="status_aluno_id">Status:</label>
        <select name="status_aluno_id" required>
            @foreach ($statusAlunos as $status)
                <option value="{{ $status->id }}">{{ $status->status }}</option>
            @endforeach
        </select>
        <br>

        <label for="apm_status_id">APM Status:</label>
        <select name="apm_status_id" required>
            @foreach ($apmStatus as $apm)
                <option value="{{ $apm->id }}">{{ $apm->status }}</option>
            @endforeach
        </select>
        <br>

        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br>

        <button type="submit">Criar Aluno</button>
    </form>
</body>
</html>
