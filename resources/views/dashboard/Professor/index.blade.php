<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENAI - AAPM</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('../css/header.css') }}">
     <style>
      @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');
      .font-inter {
          font-family: 'Inter', sans-serif;
      }
    </style>
</head>
<body class="font-inter bg-gray-100">


   
    <div class="flex flex-col items-center min-h-screen bg-gray-100 relative"> 
       
        @include('components.header', [
            'sectionTitle' => 'Secretaria',
            'pageTitle' => 'Ponto Virtual',
            'logoUrl' => route('dashboard.professor')  // Defina a URL desejada
        ])

        <!-- Title -->
        <h1 class="text-3x2 font-black mt-10 mb-10">Seja bem-vindo, {{ session('nome') }}!<br></h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-20"> <!-- Grid for responsivity -->

            <div class="flex flex-col items-center">
                <a href="{{ route('dashboard.professor.create_ticket') }}">
                <div class="w-32 h-32 flex items-center justify-center rounded-full shadow-lg bg-white transition transform hover:scale-110 hover:shadow-2xl">
                    <img src="{{ asset('assets/img/icone_dashboard_3.svg') }}" alt="Icon 3" class="w-32 h-32 transition-opacity hover:opacity-80">
                </div>
                </a>
                <div class="w-16 h-1 bg-red-500 mt-5"></div>
                
                <p class="mt-3 text-3x2 font-black text-center uppercase leading-snug h-16">Pedido de<br>troca  de horário</p>
                
            </div>

        </div>




         <h1 class="text-3x2 font-black mt-10 mb-5">Meus pedidos</h1>

        <!-- Conteúdo da página (Tabela) -->
        <div class="container mx-auto py-6 w-11/12 ">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="overflow-x-auto"> <!-- Permitir rolagem horizontal -->
                    <table class="min-w-full table-auto border-collapse border border-gray-200">
                        <thead class="bg-gray-100 text-gray-600 text-sm uppercase font-semibold">
                            <tr>
                                <th class="border border-gray-300 px-4 py-2 text-left">Número</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Gestor</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Horário Atual</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Horário Solicitado</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm">
                            @foreach($tickets as $ticket)
                            <tr class="border-b">
                                <td class="border border-gray-300 px-4 py-2">{{ $ticket->id }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $ticket->gerente->nome }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $ticket->horarioAntigo->codigo }} ({{ $ticket->horarioAntigo->hora_inicio }} - {{ $ticket->horarioAntigo->hora_fim }})</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $ticket->horarioNovo->codigo }} ({{ $ticket->horarioNovo->hora_inicio }} - {{ $ticket->horarioNovo->hora_fim }})</td>
                                <td class="border border-gray-300 px-4 py-2 
                                    @if($ticket->statusTicket->status == 'Aberto') text-gray-600 
                                    @elseif($ticket->statusTicket->status == 'Em Observação') text-yellow-500 
                                    @elseif($ticket->statusTicket->status == 'Recusado') text-red-500 
                                    @endif">
                                    {{ $ticket->statusTicket->status }}
                                </td>

                                <td>
                                <a href="{{ route('dashboard.professor.show_ticket', $ticket->id) }}" class="text-blue-500 px-4 py-2 ">Visualizar</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>











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
{{-- 
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

</div>  --}}
