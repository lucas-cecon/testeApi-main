<table class="table">
    <thead>
        <tr>
            <th>ID</th> <!-- Coluna para o ID do aluno -->
            <th>Nome</th>
            <th>CPF</th>
            <th>APM Status</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($alunos as $aluno)
            <tr>
                <td>{{ $aluno->id_aluno }}</td> <!-- Exibição do ID do aluno -->
                <td>{{ $aluno->nome }}</td>
                <td>{{ $aluno->cpf_aluno }}</td>
                <td>{{ $aluno->apmStatus->status ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('dashboard.rh.visualizar_aluno', $aluno->id_aluno) }}" class="btn btn-info">Visualizar</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


<a href="{{ route('dashboard.rh') }}">
    <button style="margin-bottom: 20px;">Voltar</button>
</a>
