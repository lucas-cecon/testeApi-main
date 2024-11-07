<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Aluno</title>
</head>
<body>
    <h1>Detalhes do Aluno</h1>

    <p><strong>Nome:</strong> {{ $aluno->nome }}</p>
    <p><strong>CPF:</strong> {{ $aluno->cpf_aluno }}</p>
    <p><strong>RG:</strong> {{ $aluno->rg }}</p>
    <p><strong>Número de Matrícula:</strong> {{ $aluno->n_matricula }}</p>
    <p><strong>Curso:</strong> {{ $aluno->curso->curso ?? 'N/A' }}</p>
    <p><strong>Status:</strong> {{ $aluno->statusAluno->status ?? 'N/A' }}</p>
    <p><strong>APM Status:</strong> {{ $aluno->apmStatus->status ?? 'N/A' }}</p>
    <p><strong>Email:</strong> {{ $aluno->email }}</p>

    <a href="{{ route('dashboard.rh.editar_aluno', $aluno->id_aluno) }}" class="btn btn-warning">Editar informações</a>

    <br>

    <a href="{{ route('dashboard.rh.apm') }}">Voltar para a lista</a>
</body>
</html>
