<div class="container">
    <h1>Solicitar Troca de Horário</h1>

    <!-- Exibição de erros de validação -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulário para criar um novo ticket -->
    <form action="{{ route('dashboard.professor.store_ticket') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="horario_antigo">Horário Antigo</label>
            <input type="text" class="form-control" value="{{ $horarioAtual->codigo }} ({{ $horarioAtual->hora_inicio }} - {{ $horarioAtual->hora_fim }})" readonly>
            <input type="hidden" name="horario_antigo" value="{{ $horarioAtual->id }}">
        </div>

        <div class="form-group">
            <label for="horario_novo">Horário Novo</label>
            <select name="horario_novo" class="form-control">
                @foreach ($horarios as $horario)
                    <option value="{{ $horario->id }}">{{ $horario->codigo }} ({{ $horario->hora_inicio }} - {{ $horario->hora_fim }})</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea name="descricao" class="form-control" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="gestor_responsavel">Selecione o Gestor Responsável</label>
            <select name="gestor_responsavel" class="form-control">
                @foreach ($gestores as $gestor)
                    <option value="{{ $gestor->ID_funcionario }}">{{ $gestor->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="data_inicio">Data de Início</label>
            <input type="date" name="data_inicio" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="data_fim">Data de Fim</label>
            <input type="date" name="data_fim" class="form-control" required>
        </div>
        

        <button type="submit" class="btn btn-primary">Enviar Solicitação</button>
    </form>
</div>
