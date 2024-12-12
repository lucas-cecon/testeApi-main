<h1>Criar Novo Diploma</h1>

@if (session('success'))
    <div>{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('diplomas.salvar') }}">
    @csrf
    <div>
        <label for="titulo">Título do Diploma:</label>
        <input type="text" name="titulo" required>
    </div>
    <div>
        <label for="lote_diploma">Lote do Diploma:</label>
        <input type="text" name="lote_diploma" required>
    </div>
    <div>
        <label for="quant_diploma">Quantidade de Diplomas:</label>
        <input type="number" name="quant_diploma" required>
    </div>
    <div>
        <label for="turma_diploma">Turma:</label>
        <select name="turma_diploma" required>
            @foreach ($cursos as $curso)
                <option value="{{ $curso->id }}">{{ $curso->curso }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit">Criar Diploma</button>
</form>

<a href="{{ route('dashboard.rh') }}">
    <button>Voltar</button>
</a>
