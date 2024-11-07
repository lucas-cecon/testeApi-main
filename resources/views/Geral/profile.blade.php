<div class="container">
    <h1>Meu Perfil</h1>

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

    <!-- Informações do perfil -->
    <h3>Informações do Usuário</h3>
    <p><strong>Nome:</strong> {{ $funcionario->nome }}</p>
    <p><strong>Cargo:</strong> {{ session('cargo') }}</p>

    <!-- Botão de logout -->
    <form method="POST" action="{{ route('funcionarios.logout') }}">
        @csrf
        <button type="submit" style="margin-bottom: 20px;">Sair</button>
    </form>

    <!-- Navegação de acordo com o cargo -->
    <div>
        @if($funcionario->cargo == 1)
            <a href="{{ route('dashboard.rh') }}" class="btn btn-primary">Voltar para o Dashboard RH</a>
        @elseif($funcionario->cargo == 2)
            <a href="{{ route('dashboard.professor') }}" class="btn btn-primary">Voltar para o Dashboard Professor</a>
        @elseif($funcionario->cargo == 3)
            <a href="{{ route('dashboard.gestor') }}" class="btn btn-primary">Voltar para o Dashboard Gestor</a>
        @elseif($funcionario->cargo == 4)
            <a href="{{ route('funcionarios.listar') }}" class="btn btn-primary">Voltar para o Dashboard Master</a>
        @endif
    </div>
</div>
