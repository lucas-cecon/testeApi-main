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
            'pageTitle' => 'Dashboard',
            'logoUrl' => route('dashboard.rh'),
        ])




        <h2 class="text-3x2 font-black uppercase mb-4">Informações sobre meu pedido:</h2>



        <div class="bg-gray-200 p-8 rounded-md shadow-md w-full max-w-2xl"> <!-- Tornado responsivo com w-full -->
            <h2 class="text-lg font-bold mb-4">Pedido</h2>
            <!-- Form Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Responsivo: 1 coluna em telas pequenas, 2 colunas em telas maiores -->
                <!-- Id do Pedido -->
                <!-- Funcionário -->
                <div class="form-group flex flex-col">
                    <label for="horario_antigo" class="font-bold mb-2">Horário antigo:</label>
                    <input type="text" class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full"
                        value="{{ $ticket->horarioAntigo->codigo }} ({{ $ticket->horarioAntigo->hora_inicio }} - {{ $ticket->horarioAntigo->hora_fim }})"
                        readonly>
                </div>
                <div class="form-group flex flex-col">
                    <label for="horario_novo" class="font-bold mb-2">Horário novo:</label>
                    <input type="text" class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full"
                        value="{{ $ticket->horarioNovo->codigo }} ({{ $ticket->horarioNovo->hora_inicio }} - {{ $ticket->horarioNovo->hora_fim }})"
                        readonly>
                </div>

                <!-- Horário Antigo -->
                <div class="form-group flex flex-col">
                    <label for="gestor_responsavel" class="font-bold mb-2">Gestor Responsável:</label>
                    <input type="text" class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full"
                        value="{{ $ticket->gerente->nome }}" readonly>
                </div>

                <!-- Horário Novo -->
                <div class="form-group flex flex-col">
                    <label for="descricao" class="font-bold mb-2">Descrição:</label>
                    <input name="descricao" type="text"
                        class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full"
                        value="{{ $ticket->descricao }}" readonly>
                    </input>
                </div>

                <div class="form-group flex flex-col">
                    <label for="data-inicio" class="font-bold mb-2">Data de Início:</label>
                    <input type="date" name="data_inicio"
                        class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full"
                        value="{{ $ticket->data_inicio }}" readonly>
                    </input>
                </div>

                <div class="form-group flex flex-col">
                    <label for="data-fim" class="font-bold mb-2">Data de Fim:</label>
                    <input type="date" name="data_fim"
                        class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full"
                        value="{{ $ticket->data_fim }}" readonly>
                    </input>
                </div>

                <div class="form-group flex flex-col">
                    <label for="data-fim" class="font-bold mb-2">Status:</label>
                    <input type="text" name="data_fim"
                        class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full
                        @if ($ticket->statusTicket->status == 'Aberto') text-gray-600 
                        @elseif($ticket->statusTicket->status == 'Em Observação') text-yellow-500 
                        @elseif($ticket->statusTicket->status == 'Recusado') text-red-500 @endif"
                        value="{{ $ticket->statusTicket->status }}" readonly>

                    </input>
                </div>

                <div class="mt-3 form-group flex flex-col">
                </div>

                @if ($ticket->status_ticket == 2)
                    <div class="mt-3 form-group flex flex-col">
                        <form action="{{ route('dashboard.rh.aprovar_ticket', $ticket->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            <button type="submit"
                                class="mb-2 btn btn-primary w-full border bg-green-500 hover:bg-red-700 text-white border-green-500 p-2 rounded-md btn btn-success">Aceitar</button>
                        </form>
                    </div>
                    <div class="mt-3 form-group flex flex-col">
                        <form action="{{ route('dashboard.rh.rejeitar_ticket', $ticket->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            <button type="submit"
                                class="btn btn-primary w-full border bg-red-500 hover:bg-red-700 text-white border-red-500 p-2 rounded-md btn btn-danger">Negar
                                Pedido</button>
                        </form>
                    </div>
            </div>
        @else
            <p><strong>Observação:</strong> O status deste pedido não pode ser alterado.</p>
            @endif


            <!-- Confirmar -->
            <div class="
                     flex flex-col md:col"> <!-- Ocupa 2 colunas em telas maiores -->
                <label class="font-bold mb-2">‎ </label>
                <a href="{{ route('dashboard.rh.pedidos') }}" class="btn btn-secondary"><button
                        class=" btn btn-primary w-full border bg-red-500 hover:bg-red-700 text-white border-red-500 p-2 rounded-md">Voltar</button></a>
                <!-- Botão responsivo com w-full -->
            </div>
        </div>
        <br>
        <br>
        <br>
    </div>

    {{-- <div class="container mt-5">
        <h1>Detalhes da Solicitação</h1>
        
        <p><strong>ID:</strong> {{ $ticket->id }}</p>
        <p><strong>Funcionário:</strong> {{ $ticket->funcionario->nome }}</p>
        <p><strong>Horário Antigo:</strong> {{ $ticket->horarioAntigo->codigo }} ({{ $ticket->horarioAntigo->hora_inicio }} - {{ $ticket->horarioAntigo->hora_fim }})</p>
        <p><strong>Horário Novo:</strong> {{ $ticket->horarioNovo->codigo }} ({{ $ticket->horarioNovo->hora_inicio }} - {{ $ticket->horarioNovo->hora_fim }})</p>
        <p><strong>Status:</strong> {{ $ticket->statusTicket->status }}</p>
        <p><strong>Data Inicio:</strong> {{ $ticket->data_inicio }}</p>
        <p><strong>Data fim</strong> {{ $ticket->data_fim }}</p>

        @if ($ticket->status_ticket == 2)
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

    </div>
</body>
</html> --}}
