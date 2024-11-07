<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Solicitação</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container mt-5">
        <h1>Detalhes da Solicitação</h1>
        
        <p><strong>ID:</strong> {{ $ticket->id }}</p>
        <p><strong>Funcionário:</strong> {{ $ticket->funcionario->nome }}</p>
        <p><strong>Horário Antigo:</strong> {{ $ticket->horarioAntigo->codigo }} ({{ $ticket->horarioAntigo->hora_inicio }} - {{ $ticket->horarioAntigo->hora_fim }})</p>
        <p><strong>Horário Novo:</strong> {{ $ticket->horarioNovo->codigo }} ({{ $ticket->horarioNovo->hora_inicio }} - {{ $ticket->horarioNovo->hora_fim }})</p>
        <p><strong>Status:</strong> {{ $ticket->statusTicket->status }}</p>
        <p><strong>Data Inicio:</strong> {{ $ticket->data_inicio }}</p>
        <p><strong>Data fim</strong> {{ $ticket->data_fim }}</p>

        @if($ticket->status_ticket == 2)
            <div class="mt-3">
                <form action="{{ route('dashboard.rh.aprovar_ticket', $ticket->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-success">Aceitar</button>
                </form>
                
                <form action="{{ route('dashboard.rh.rejeitar_ticket', $ticket->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger">Negar Pedido</button>
                </form>
            </div>
        @else
            <p><strong>Observação:</strong> O status deste pedido não pode ser alterado.</p>
        @endif

        <a href="{{ route('dashboard.rh') }}" class="btn btn-primary mt-3">Voltar</a>
    </div>
</body>
</html>
