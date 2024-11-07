<div class="container">
    <h1>Dashboard do Gestor</h1>

    <!-- Formulário de busca -->
    <form method="GET" action="{{ route('dashboard.gestor.pedidos') }}" id="searchForm" style="margin-bottom: 20px;">
        <input type="text" id="searchInput" name="search" placeholder="Buscar por funcionário" value="{{ request()->input('search') }}">
        <button type="submit">Buscar</button>
        <button type="button" onclick="document.getElementById('searchInput').value = ''; document.getElementById('searchForm').submit();">Limpar</button>
    </form>

    <!-- Tabela para listar os pedidos de troca de horário -->
    <h3>Pedidos de Troca de Horário</h3>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Funcionário</th>
                <th>Horário Antigo</th>
                <th>Horário Novo</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->funcionario->nome }}</td>
                    <td>{{ $ticket->horarioAntigo->codigo }} ({{ $ticket->horarioAntigo->hora_inicio }} - {{ $ticket->horarioAntigo->hora_fim }})</td>
                    <td>{{ $ticket->horarioNovo->codigo }} ({{ $ticket->horarioNovo->hora_inicio }} - {{ $ticket->horarioNovo->hora_fim }})</td>
                    <td>{{ $ticket->statusTicket->status }}</td>
                    <td>
                        <a href="{{ route('dashboard.gestor.detalhar_ticket', $ticket->id) }}" class="btn btn-info">Ver Detalhes</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Botão para visualizar todos os alunos -->
    <a href="{{ route('dashboard.gestor.alunos') }}" class="btn btn-primary" style="margin-top: 20px;">Ver Todos os Alunos</a>

    <br>

    <a href="{{ route('perfil') }}">
        <button style="margin-bottom: 20px;">Ver Perfil</button>
    </a>

</div>


