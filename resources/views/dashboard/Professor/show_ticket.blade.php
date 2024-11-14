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

        <h2 class="text-3x2 font-black uppercase mb-4">Informações para alteração de horário:</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4"> <!-- Responsivo: 1 coluna em telas pequenas, 2 colunas em telas maiores -->
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
</div>
