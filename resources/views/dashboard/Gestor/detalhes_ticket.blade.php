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
        @include('components.header', [
            'sectionTitle' => 'Secretaria',
            'pageTitle' => 'Dashboard',
            'logoUrl' => route('dashboard.gestor.index_arrumado')  // Defina a URL desejada
        ])

        <h2 class="text-3x2 font-black uppercase mb-4">Detalhes do Pedido:</h2>

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

                <div class="form-group flex flex-col">
                    <label for="horario_antigo" class="font-bold mb-2">ID:</label>
                    <input type="text"  class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" value="{{ $ticket->id }}" readonly>
                </div>

                <div class="form-group flex flex-col">
                    <label for="horario_antigo" class="font-bold mb-2">Funcionário:</label>
                    <input type="text"  class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" value="{{ $ticket->funcionario->nome }}" readonly>
                </div>

                <div class="form-group flex flex-col">
                    <label for="horario_antigo" class="font-bold mb-2">Horário Antigo:</label>
                    <input type="text"  class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" value="{{ $ticket->horarioAntigo->codigo }} ({{ $ticket->horarioAntigo->hora_inicio }} - {{ $ticket->horarioAntigo->hora_fim }})" readonly>
                </div>

                <div class="form-group flex flex-col">
                    <label for="horario_antigo" class="font-bold mb-2">Horário Novo:</label>
                    <input type="text"  class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" value="{{ $ticket->horarioNovo->codigo }} ({{ $ticket->horarioNovo->hora_inicio }} - {{ $ticket->horarioNovo->hora_fim }}) " readonly>
                </div>

                <div class="form-group flex flex-col">
                    <label for="horario_antigo" class="font-bold mb-2">Status:</label>
                    <input type="text"  class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" value="{{ $ticket->statusTicket->status }}" readonly>
                </div>
                
                <div class="form-group flex flex-col">
                    <label for="horario_antigo" class="font-bold mb-2">Data Início:</label>
                    <input type="text"  class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" value="{{ $ticket->data_inicio }}" readonly>
                </div>
                
                <div class="form-group flex flex-col">
                    <label for="horario_antigo" class="font-bold mb-2">Data Fim:</label>
                    <input type="text"  class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" value="{{ $ticket->data_fim }}" readonly>
                </div>
    
                <div class="flex flex-col md:col"> <!-- Ocupa 2 colunas em telas maiores -->
                <label class="font-bold mb-2">‎ </label>
                <a href="{{ route('dashboard.gestor.pedidos_ticket') }}"><button type="button" class="btn btn-secondary w-full border bg-red-500 hover:bg-red-700 text-white border-red-500 p-2 rounded-md">Voltar</button></a> <!-- Botão responsivo com w-full -->
                </div>

                @if(!in_array($ticket->status_ticket, [2, 3, 4])) {{-- Verifica se o status é diferente de 3, 4 ou 5 --}}
                    <!-- Botões para aceitar ou negar o pedido -->
                                         
                    <div class="flex flex-col md:col">
                    <form action="{{ route('dashboard.gestor.aprovar_ticket', $ticket->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary w-full border bg-green-500 hover:bg-green-700 text-white border-green-500 p-2 rounded-md">Aceitar Pedido</button>
                    </form>
                    </div>
                    
                    <div class="flex flex-col md:col">
                    <form action="{{ route('dashboard.gestor.rejeitar_ticket', $ticket->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary w-full border bg-red-500 hover:bg-red-700 text-white border-red-500 p-2 rounded-md">Negar Pedido</button>
                    </form>
                @else
                    <p style="color: red;">Este pedido não pode ser alterado.</p>
                @endif
            </div>
        </div>
    </div>
    <br>
    <br>
</body>
</html>
