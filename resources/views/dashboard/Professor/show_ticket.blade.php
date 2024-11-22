<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENAI - Ticket horário</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');
    .font-inter {
        font-family: 'Inter', sans-serif;
    }
</style>
<body class="font-inter bg-gray-100 min-h-screen">

    
    <div class="flex flex-col items-center min-h-screen bg-gray-100"> 
        <div class="container mx-auto pt-2 flex justify-between items-center w-11/12">
            <!-- Logo SENAI e Secretaria -->
            <div class="flex items-center">
                <!-- Logo SENAI -->
                <a href="{{url('')}}"><img src="{{ asset('assets/img/senai.svg') }}" alt="SENAI Logo" class="senai-logo"></a>
                <!-- Texto "Secretaria" -->
                <span class="secretaria-text">Secretaria</span>
            </div>
        </div>
    
        <div class="w-11/12 h-0.5 bg-red-500 mb-2"></div>

        
        <div class="w-11/12 items-center mb-2"> <!-- Adjusted for positioning -->
            <h2 class="text-3x2 text-red-500 font-black uppercase">Ponto virtual</h2>
        </div>
        
        <div class="w-11/12 h-0.5 bg-red-500 mb-4"></div> <!-- Red line -->

        <h2 class="text-3x2 font-black uppercase mb-4">Informações sobre meu pedido:</h2>



    <div class="bg-gray-200 p-8 rounded-md shadow-md w-full max-w-2xl"> <!-- Tornado responsivo com w-full -->
            <h2 class="text-lg font-bold mb-4">Pedido</h2>
                 <!-- Form Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4"> <!-- Responsivo: 1 coluna em telas pequenas, 2 colunas em telas maiores -->
                    <!-- Id do Pedido -->
                    <!-- Funcionário -->
                    <div class="form-group flex flex-col">
                        <label for="horario_antigo" class="font-bold mb-2">Horário antigo:</label>
                        <input type="text"  class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" value="{{ $ticket->horarioAntigo->codigo }} ({{ $ticket->horarioAntigo->hora_inicio }} - {{ $ticket->horarioAntigo->hora_fim }})" readonly>
                    </div>
                    <div class="form-group flex flex-col">
                        <label for="horario_novo" class="font-bold mb-2">Horário novo:</label>
                        <input type="text"  class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" value="{{ $ticket->horarioNovo->codigo }} ({{ $ticket->horarioNovo->hora_inicio }} - {{ $ticket->horarioNovo->hora_fim }})" readonly>
                    </div>

                    <!-- Horário Antigo -->
                    <div class="form-group flex flex-col">
                        <label for="gestor_responsavel" class="font-bold mb-2">Gestor Responsável:</label>
                        <input type="text"  class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" value="{{ $ticket->gerente->nome }}" readonly>
                    </div>

                    <!-- Horário Novo -->
                    <div class="form-group flex flex-col">
                        <label for="descricao" class="font-bold mb-2">Descrição:</label>
                        <input name="descricao" type="text" class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" value="{{ $ticket->descricao }}">
                    </input>
                    </div>

                    <div class="form-group flex flex-col">
                        <label for="data-inicio" class="font-bold mb-2">Data de Início:</label>
                        <input type="date" name="data_inicio" class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" value="{{ $ticket->data_inicio }}" readonly>
                    </input>
                    </div>

                    <div class="form-group flex flex-col">
                        <label for="data-fim" class="font-bold mb-2">Data de Fim:</label>
                        <input type="date" name="data_fim" class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" value="{{ $ticket->data_fim }}" readonly>
                    </input>
                    </div>

                    <div class="form-group flex flex-col">
                        <label for="data-fim" class="font-bold mb-2">Status:</label>
                        <input type="text" name="data_fim" class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full
                        @if($ticket->statusTicket->status == 'Aberto') text-gray-600 
                        @elseif($ticket->statusTicket->status == 'Em Observação') text-yellow-500 
                        @elseif($ticket->statusTicket->status == 'Recusado') text-red-500 
                        @endif"
                        value="{{ $ticket->statusTicket->status }}" readonly>
                        
                    </input>
                    </div>

                    <!-- Confirmar -->
                    <div class="
                     flex flex-col md:col"> <!-- Ocupa 2 colunas em telas maiores -->
                        <label class="font-bold mb-2">‎ </label>
                        <a href="{{ route('dashboard.professor') }}" class="btn btn-secondary"><button  class=" btn btn-primary w-full border bg-red-500 hover:bg-red-700 text-white border-red-500 p-2 rounded-md">Voltar</button></a> <!-- Botão responsivo com w-full -->
                    </div>
                </div>
        </div>    





{{-- 
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

    </div>

    <!-- Botão para voltar -->
    <a href="{{ route('dashboard.professor') }}" class="btn btn-secondary">Voltar</a>
</div> --}}
