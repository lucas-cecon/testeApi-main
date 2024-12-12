<!-- Formulário de associação de aluno a diploma -->
<form action="{{ route('diplomas.associar') }}" method="POST">
    @csrf
    <div>
        <label for="diploma_id">Selecionar Diploma:</label>
        <select name="diploma_id" id="diploma_id" required>
            <option value="">Selecione um Diploma</option>
            @foreach ($diplomas as $diploma)
                <option value="{{ $diploma->id }}">{{ $diploma->titulo }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="aluno_id">Selecionar Aluno:</label>
        <select name="aluno_id" id="aluno_id" required>
            <option value="">Selecione um Aluno</option>
            @foreach ($alunos as $aluno)
                <option value="{{ $aluno->id_aluno }}">{{ $aluno->nome }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" style="margin-top: 20px;">Associar Aluno ao Diploma</button>
</form>

<!-- Link para voltar à lista de diplomas -->
<a href="{{ route('dashboard.master.diplomas') }}">
    <button style="margin-top: 20px;">Voltar</button>
</a>
