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
            'pageTitle' => 'Dashboard',
            'logoUrl' => route('dashboard.gestor.index_arrumado')  // Defina a URL desejada
        ])
     

     <form method="GET" action="{{ route('dashboard.gestor.pedidos_ticket') }}" id="searchForm" style="margin-bottom: 20px;">
        <input type="text" class="block w-1/1 p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="searchInput" name="search" placeholder="Buscar por funcionário" value="{{ request()->input('search') }}">
        <button type="submit" class="text-white end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buscar</button>
        <button type="button" class="text-white end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" onclick="document.getElementById('searchInput').value = ''; document.getElementById('searchForm').submit();">Limpar</button>
    </form>


        <!-- Conteúdo da página (Tabela) -->
        <div class="container mx-auto py-6 w-11/12 ">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="overflow-x-auto"> <!-- Permitir rolagem horizontal -->
                    <table class="min-w-full table-auto border-collapse border border-gray-200">
                        <thead class="bg-gray-100 text-gray-600 text-sm uppercase font-semibold">
                            <tr>
                                <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Funcionário</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Horário antigo</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Horário novo</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm">
                            @foreach($tickets as $ticket)
                            <tr class="border-b">
                                <td class="border border-gray-300 px-4 py-2">{{ $ticket->id }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $ticket->funcionario->nome }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $ticket->horarioAntigo->codigo }} ({{ $ticket->horarioAntigo->hora_inicio }} - {{ $ticket->horarioAntigo->hora_fim }})</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $ticket->horarioNovo->codigo }} ({{ $ticket->horarioNovo->hora_inicio }} - {{ $ticket->horarioNovo->hora_fim }})</td>
                                <td class="border border-gray-300 px-4 py-2
                                    @if($ticket->statusTicket->status == 'Aberto') text-gray-600 
                                    @elseif($ticket->statusTicket->status == 'Em Observação') text-yellow-500 
                                    @elseif($ticket->statusTicket->status == 'Recusado') text-red-500 
                                    @endif">{{ $ticket->statusTicket->status }}</td>
                                <td>
                                <a href="{{ route('dashboard.gestor.detalhar_ticket', $ticket->id) }}" class="btn btn-info px-4 py-2">Ver detalhes</a>
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



