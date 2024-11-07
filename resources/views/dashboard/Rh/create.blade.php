<!-- resources/views/dashboard/rh/create.blade.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Diploma</title>
</head>
<body>
    <h1>Criar Novo Diploma</h1>

    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

<!-- resources/views/dashboard/rh/create.blade.php -->
<form method="POST" action="{{ route('diplomas.store') }}">
    @csrf
    <div>
        <label for="titulo">Título do Diploma:</label>
        <input type="text" id="titulo" name="titulo" required>
    </div>
    <div>
        <label for="lote_diploma">Lote do Diploma:</label>
        <input type="text" id="lote_diploma" name="lote_diploma" required>
    </div>
    <div>
        <label for="quant_diploma">Quantidade de Diplomas:</label>
        <input type="number" id="quant_diploma" name="quant_diploma" required min="1">
    </div>
    <div>
        <label for="turma_diploma">Turma:</label>
        <select id="turma_diploma" name="turma_diploma" required>
            <option value="">Selecione uma turma</option>
            @foreach ($cursos as $curso)
                <option value="{{ $curso->id }}">{{ $curso->curso }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <button type="submit">Criar Diploma</button>
    </div>
</form>


    <a href="{{ route('dashboard.rh') }}">
        <button>Voltar</button>
    </a>
</body>
</html>
