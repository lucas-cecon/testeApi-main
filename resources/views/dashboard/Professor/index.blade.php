<!-- Exibir mensagens de sucesso ou erro -->
@if (session('success'))
    <div style="color: green;">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div style="color: red;">
        {{ session('error') }}
    </div>
@endif

<!-- Exibir informações do token e nome do usuário logado -->
@if (session('token') && session('nome') && session('cargo'))
    <div style="color: blue;">
        Seu token: {{ session('token') }}<br>
        Seja bem-vindo, {{ session('nome') }}!<br>
        Seu cargo: {{ session('cargo') }}
    </div>
@endif

<div class="container">
    <h1>Dashboard do Professor</h1>

    <!-- Botão para criar uma nova requisição de troca de horário -->
    <a href="{{ route('dashboard.professor.create_ticket') }}" class="btn btn-primary">Solicitar troca de horário</a>

    <!-- Tabela para listar as trocas de horários -->
    <h3>Trocas de Horário Solicitadas</h3>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Horário Antigo</th>
                <th>Horário Novo</th>
                <th>Status</th>
                <th>Descrição</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->horarioAntigo->codigo }} ({{ $ticket->horarioAntigo->hora_inicio }} - {{ $ticket->horarioAntigo->hora_fim }})</td>
                    <td>{{ $ticket->horarioNovo->codigo }} ({{ $ticket->horarioNovo->hora_inicio }} - {{ $ticket->horarioNovo->hora_fim }})</td>
                    <td>{{ $ticket->statusTicket->status }}</td>
                    <td>{{ $ticket->descricao }}</td>
                    <td>
                        <a href="{{ route('dashboard.professor.show_ticket', $ticket->id) }}" class="btn btn-info">Ver</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>

    <a href="{{ route('perfil') }}">
        <button style="margin-bottom: 20px;">Ver Perfil</button>
    </a>
    
</div>
