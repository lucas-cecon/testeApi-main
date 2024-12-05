<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENAI - Ponto Virtual</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/img/senai.svg') }}">
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');
    .font-inter {
        font-family: 'Inter', sans-serif;
    }
</style>
<body class="font-inter bg-gray-100 min-h-screen">

    <div class="flex flex-col items-center min-h-screen bg-gray-100"> 
        @include('components.header', [
            'sectionTitle' => 'Secretaria',
            'pageTitle' => 'Ponto Virtual',
            'logoUrl' => route('dashboard.professor')  // Defina a URL desejada
        ])


        <h2 class="text-3x2 font-black uppercase mb-4">Informações para alteração de horário:</h2>

        
        

        <!-- Form Container -->
        <div class="bg-gray-200 p-8 rounded-md shadow-md w-full max-w-2xl"> <!-- Tornado responsivo com w-full -->
            <h2 class="text-lg font-bold mb-4">Pedido</h2>
          
             @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('dashboard.professor.store_ticket') }}" method="POST">
            @csrf

                <!-- Form Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4"> <!-- Responsivo: 1 coluna em telas pequenas, 2 colunas em telas maiores -->
                    <!-- Id do Pedido -->
                    <!-- Funcionário -->
                    <div class="form-group flex flex-col">
                        <label for="horario_antigo" class="font-bold mb-2">Horário antigo:</label>
                        <input type="text"  class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" value="{{ $horarioAtual->codigo }} ({{ $horarioAtual->hora_inicio }} - {{ $horarioAtual->hora_fim }})" readonly>
                        <input type="hidden" name="horario_antigo" value="{{ $horarioAtual->id }}">
                    </div>
                    <div class="form-group flex flex-col">
                        <label for="horario_novo" class="font-bold mb-2">Horário desejado:</label>
                        <select name="horario_novo"  class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full">
                        @foreach ($horarios as $horario)
                        <option value="{{ $horario->id }}">{{ $horario->codigo }} ({{ $horario->hora_inicio }} - {{ $horario->hora_fim }})</option>
                        @endforeach
                        </select>
                    </div>

                    <!-- Horário Antigo -->
                    <div class="form-group flex flex-col">
                        <label for="gestor_responsavel" class="font-bold mb-2">Seu Gerente:</label>
                        <select name="gestor_responsavel"  class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full">
                        @foreach ($gestores as $gestor)
                        <option value="{{ $gestor->ID_funcionario }}">{{ $gestor->nome }}</option>
                        @endforeach
                    </select>
                    </div>

                    <!-- Horário Novo -->
                    <div class="form-group flex flex-col">
                        <label for="descricao" class="font-bold mb-2">Descrição:</label>
                        <textarea name="descricao" type="text" class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full">
                        </textarea>
                    </div>

                    <div class="form-group flex flex-col">
                        <label for="data-inicio" class="font-bold mb-2">Data de Início:</label>
                        <input type="date" name="data_inicio" class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" required>
                    </input>
                    </div>

                    <div class="form-group flex flex-col">
                        <label for="data-fim" class="font-bold mb-2">Data de Fim:</label>
                        <input type="date" name="data_fim" class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" required>
                    </input>
                    </div>

                    <!-- Confirmar -->
                    <div class="flex flex-col md:col"> <!-- Ocupa 2 colunas em telas maiores -->
                        <label class="font-bold mb-2">‎ </label>
                        <button type="submit" id="botao" class=" btn btn-primary w-full border bg-red-500 hover:bg-red-700 text-white border-red-500 p-2 rounded-md">Enviar Solicitação</button> <!-- Botão responsivo com w-full -->
                    </div>
                    <div class="
                     flex flex-col md:col"> <!-- Ocupa 2 colunas em telas maiores -->
                        <label class="font-bold mb-2">‎ </label>
                        <a href="{{ route('dashboard.professor') }}"><button type="button" class="btn btn-secondary w-full border bg-red-500 hover:bg-red-700 text-white border-red-500 p-2 rounded-md">Voltar</button></a> <!-- Botão responsivo com w-full -->
                    </div>
                </div>
            </form>
        </div>
    <br>
    <br>
        
    </div>

</body>
</html>










{{-- 
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
</div>  --}}
