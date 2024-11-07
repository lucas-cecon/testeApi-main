{{-- resources/views/dashboard/gestor/detalhes_ticket.blade.php --}}
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Ticket</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Detalhes do Ticket</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Informações do Ticket</h5>
                <p><strong>ID:</strong> {{ $ticket->id }}</p>
                <p><strong>Funcionário:</strong> {{ $ticket->funcionario->nome }}</p>
                <p><strong>Horário Antigo:</strong> {{ $ticket->horarioAntigo->codigo }} ({{ $ticket->horarioAntigo->hora_inicio }} - {{ $ticket->horarioAntigo->hora_fim }})</p>
                <p><strong>Horário Novo:</strong> {{ $ticket->horarioNovo->codigo }} ({{ $ticket->horarioNovo->hora_inicio }} - {{ $ticket->horarioNovo->hora_fim }})</p>
                <p><strong>Status:</strong> {{ $ticket->statusTicket->status }}</p>
                <p><strong>Data Início:</strong> {{ $ticket->data_inicio }}</p>
                <p><strong>Data Fim:</strong> {{ $ticket->data_fim }}</p>
                <a href="{{ route('dashboard.gestor') }}" class="btn btn-primary">Voltar</a>

                @if(!in_array($ticket->status_ticket, [2, 3, 4])) {{-- Verifica se o status é diferente de 3, 4 ou 5 --}}
                    <!-- Botões para aceitar ou negar o pedido -->
                    <form action="{{ route('dashboard.gestor.aprovar_ticket', $ticket->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success">Aceitar Pedido</button>
                    </form>
                    
                    <form action="{{ route('dashboard.gestor.rejeitar_ticket', $ticket->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Negar Pedido</button>
                    </form>
                @else
                    <p style="color: red;">Este pedido não pode ser alterado.</p>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
