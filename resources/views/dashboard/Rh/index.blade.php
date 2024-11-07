<div class="container">
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

    <h1>Dashboard do RH</h1>
    
    <!-- Formulário de busca -->
    <form method="GET" action="{{ route('dashboard.rh.pesquisar') }}" id="searchForm" class="form-inline" style="margin-bottom: 20px;">
        <input type="text" id="searchInput" name="search" placeholder="Buscar por funcionário ou status" value="{{ request()->input('search') }}" class="form-control">
        <button type="submit" class="btn btn-secondary">Buscar</button>
        <button type="button" class="btn btn-light" onclick="document.getElementById('searchInput').value = ''; document.getElementById('searchForm').submit();">Limpar</button>
    </form>

    <h3>Pedidos Pendentes</h3>
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
                        <a href="{{ route('dashboard.rh.show_ticket', $ticket->id) }}" class="btn btn-info">Visualizar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>

    <a href="{{ route('dashboard.rh.apm') }}">
        <button style="margin-bottom: 20px;">Ver Informações dos Alunos - APM</button>
    </a>

    <br>

    <a href="{{ route('dashboard.rh.diplomas') }}">
        <button style="margin-bottom: 20px;">Ver Informações dos Diplomas</button>
    </a>
    

    <br>

    <a href="{{ route('perfil') }}">
        <button style="margin-bottom: 20px;">Ver Perfil</button>
    </a>

</div>
