<div class="container">
    <h1>Detalhes do Ticket</h1>

    <table class="table">
        <tr>
            <th>ID do Ticket:</th>
            <td>{{ $ticket->id }}</td>
        </tr>
        <tr>
            <th>Funcionário:</th>
            <td>{{ $ticket->funcionario->nome }}</td>
        </tr>
        <tr>
            <th>Gerente Responsável:</th>
            <td>{{ $ticket->gerente->nome }}</td>
        </tr>
        <tr>
            <th>Horário Antigo:</th>
            <td>{{ $ticket->horarioAntigo->codigo }} ({{ $ticket->horarioAntigo->hora_inicio }} - {{ $ticket->horarioAntigo->hora_fim }})</td>
        </tr>
        <tr>
            <th>Horário Novo:</th>
            <td>{{ $ticket->horarioNovo->codigo }} ({{ $ticket->horarioNovo->hora_inicio }} - {{ $ticket->horarioNovo->hora_fim }})</td>
        </tr>
        <tr>
            <th>Status:</th>
            <td>{{ $ticket->statusTicket->status }}</td>
        </tr>
        <tr>
            <th>Descrição:</th>
            <td>{{ $ticket->descricao }}</td>
        </tr>
        <tr>
            <th>Data Início:</th>
            <td>{{ $ticket->data_inicio }}</td>
        </tr>
        <tr>
            <th>Data Fim:</th>
            <td>{{ $ticket->data_fim }}</td>
        </tr>

    </table>

    <!-- Botão para voltar -->
    <a href="{{ route('dashboard.professor') }}" class="btn btn-secondary">Voltar</a>
</div>
