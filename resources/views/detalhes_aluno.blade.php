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
    <p><strong>Curso:</strong> {{ optional($aluno->curso)->curso ?? 'N/A' }}</p>
    <p><strong>Status:</strong> {{ optional($aluno->statusAluno)->status ?? 'N/A' }}</p>
    <p><strong>Apm Status:</strong> {{ optional($aluno->apmStatus)->status ?? 'N/A' }}</p>
    <p><strong>Email:</strong> {{ $aluno->getEmailFormatado() }}</p>
    
    <a href="{{ route('alunos.index') }}">Voltar para a lista</a>
    
    
</body>
</html>
