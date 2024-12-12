<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <h1>Detalhes do Aluno</h1>

    <p><strong>Nome:</strong> {{ $aluno->nome }}</p>
    <p><strong>CPF:</strong> {{ $aluno->cpf_aluno }}</p>
    <p><strong>RG:</strong> {{ $aluno->rg }}</p>
    <p><strong>Matrícula:</strong> {{ $aluno->n_matricula }}</p>
    <p><strong>Curso:</strong> {{ $aluno->curso->nome ?? 'N/A' }}</p>
    <p><strong>Status:</strong> {{ $aluno->statusAluno->nome ?? 'N/A' }}</p>
    <p><strong>Apm Status:</strong> {{ $aluno->apmStatus->nome ?? 'N/A' }}</p>
    <p><strong>Email:</strong> {{ $aluno->email }}</p>

    <a href="{{ route('dashboard.gestor.alunos') }}" class="btn btn-primary" style="margin-top: 20px;">Voltar</a>

</body>

</html>
