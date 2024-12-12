<link rel="icon" type="image/svg+xml" href="{{ asset('assets/img/senai.svg') }}">
<h1>Detalhes do Diploma</h1>

<p><strong>ID:</strong> {{ $diploma->id }}</p>
<p><strong>Título:</strong> {{ $diploma->titulo }}</p>
<p><strong>Lote do Diploma:</strong> {{ $diploma->lote_diploma }}</p>
<p><strong>Quantidade:</strong> {{ $diploma->quant_diploma }}</p>
<p><strong>Turma:</strong> {{ $diploma->curso ? $diploma->curso->curso : 'Turma não encontrada' }}</p>
<p><strong>Status:</strong>
    @if ($diploma->status == 1)
        Aberto
    @elseif($diploma->status == 2)
        Em andamento
    @elseif($diploma->status == 3)
        Concluído
    @else
        Desconhecido
    @endif
</p>

<!-- Botão para atualizar o status do diploma -->
@if ($diploma->status < 3)
    <form method="POST" action="{{ route('diplomas.atualizarStatus', $diploma->id) }}" style="display:inline;"
        onsubmit="return confirmUpdate();">
        @csrf
        <button type="submit" id="updateStatusButton">Atualizar Status</button>
    </form>
@endif

<!-- Alunos Relacionados -->
<h2>Alunos Relacionados</h2>

@if ($alunosRelacionados->isEmpty())
    <p>Nenhum aluno associado a este diploma.</p>
@else
    <table>
        <thead>
            <tr>
                <th>ID do Aluno</th>
                <th>Nome do Aluno</th>
                <th>CPF do Aluno</th>
                <th>RG do Aluno</th>
                @if ($diploma->status < 3)
                    <!-- Exibe a coluna de Ações apenas se o status for menor que 3 -->
                    <th>Ações</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($alunosRelacionados as $relacao)
                <tr>
                    <td>{{ $relacao->aluno->id_aluno }}</td>
                    <td>{{ $relacao->aluno->nome }}</td>
                    <td>{{ $relacao->aluno->cpf_aluno }}</td>
                    <td>{{ $relacao->aluno->rg }}</td>
                    @if ($diploma->status < 3)
                        <!-- Apenas exibe o botão de Remover se o status for menor que 3 -->
                        <td>
                            <form method="POST" action="{{ route('diplomas.remover', $relacao->id) }}"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Tem certeza que deseja remover este aluno do diploma?');">Remover</button>
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

<!-- Formulário para adicionar um aluno ao diploma -->
@if ($diploma->status < 3)
    <!-- Exibe o formulário apenas se o status for menor que 3 -->
    <h2>Adicionar Aluno ao Diploma</h2>
    <form method="POST" action="{{ route('diplomas.associar', $diploma->id) }}">
        @csrf
        <div>
            <label for="aluno_id">Selecione um Aluno:</label>
            <select id="aluno_id" name="aluno_id" required>
                <option value="">Selecione um aluno</option>
                @foreach ($todosAlunos as $aluno)
                    <option value="{{ $aluno->id_aluno }}">{{ $aluno->nome }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <button type="submit">Adicionar Aluno</button>
        </div>
    </form>
@endif

<br>

<a href="{{ route('dashboard.master.diplomas') }}">Voltar para a lista de diplomas</a>

<!-- Script para confirmar a atualização do status -->
<script>
    function confirmUpdate() {
        return confirm('Tem certeza que deseja mudar o status deste diploma?');
    }
</script>
