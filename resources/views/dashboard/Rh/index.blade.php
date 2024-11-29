<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Load Inter font from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Load Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    
    <title>Center Icons</title>
    
    <!-- Custom Tailwind Setup for Inter Font -->
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');
      .font-inter {
          font-family: 'Inter', sans-serif;
      }
    </style>
</head>
<body class="font-inter"> <!-- Apply Inter to the entire body -->

    <div class="flex flex-col items-center min-h-screen bg-gray-100"> 
        
        @include('components.header', ['sectionTitle' => 'Secretaria', 'pageTitle' => 'Dashboard'])

        <!-- Title -->
        <h1 class="text-3x2 font-black mt-10 mb-20">Bem-vindo, {{ session('nome') }}!</h1>

        <!-- Responsive Grid for Icons -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-20"> <!-- Grid for responsivity -->
            <!-- Icon 1 -->
            <div class="flex flex-col items-center">
                <a href="{{ route('dashboard.rh.diplomas') }}"><div class="w-32 h-32 flex items-center justify-center rounded-full shadow-lg bg-white transition transform hover:scale-110 hover:shadow-2xl">
                    <img src="{{ asset('assets/img/icone_dashboard_1.svg') }}" alt="Icon 1" class="w-32 h-32 transition-opacity hover:opacity-80">
                </div></a>
                <a href="{{ route('dashboard.rh.diplomas') }}"><p class="mt-3 text-3x2 font-black text-center uppercase leading-snug h-16">Diplomas</p></a>
                <div class="w-16 h-1 bg-red-500 mt-5"></div>
            </div>

            <!-- Icon 2 -->
            <div class="flex flex-col items-center">
                <a href="{{ route('dashboard.rh.apm') }}"><div class="w-32 h-32 flex items-center justify-center rounded-full shadow-lg bg-white transition transform hover:scale-110 hover:shadow-2xl">
                    <img src="{{ asset('assets/img/icone_dashboard_2.svg') }}" alt="Icon 2" class="w-32 h-32 transition-opacity hover:opacity-80">
                </div></a>
                <a href="{{ route('dashboard.rh.apm') }}"><p class="mt-3 text-3x2 font-black text-center uppercase leading-snug h-16">Portal da<br>AAPM</p></a>
                <div class="w-16 h-1 bg-red-500 mt-5"></div>
            </div>

            <!-- Icon 3 -->
            <div class="flex flex-col items-center">
                <div class="w-32 h-32 flex items-center justify-center rounded-full shadow-lg bg-white transition transform hover:scale-110 hover:shadow-2xl">
                    <img src="{{ asset('assets/img/icone_dashboard_3.svg') }}" alt="Icon 3" class="w-32 h-32 transition-opacity hover:opacity-80">
                </div>
                <p class="mt-3 text-3x2 font-black text-center uppercase leading-snug h-16">Ponto<br>Virtual</p>
                <div class="w-16 h-1 bg-red-500 mt-5"></div>
            </div>
        </div>

        <div class="container mx-auto py-6 w-11/12">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="overflow-x-auto"> <!-- Permitir rolagem horizontal -->
                    @if (!empty($error))
                        <div class="bg-red-500 text-white p-4 mb-4">{{ $error }}</div>
                    @else
        <!-- Formulário de busca -->
    <form method="GET" action="{{ route('dashboard.rh.pesquisar') }}" id="searchForm" class="form-inline" style="margin-bottom: 20px;">
        <input type="text" class="block w-1/3 p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="searchInput" name="search" placeholder="Buscar por funcionário ou status" value="{{ request()->input('search') }}" class="form-control">
        <button type="submit" class="text-white end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buscar</button>
        <button type="button" class="text-white end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" onclick="document.getElementById('searchInput').value = ''; document.getElementById('searchForm').submit();">Limpar</button>
    </form>

    <h3 class="text-center">Pedidos Pendentes</h3>
    <table class="min-w-full table-auto border-collapse border border-gray-200">
        <thead class="bg-gray-100 text-gray-600 text-sm uppercase font-semibold">
            <tr>
                <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Funcionário</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Horário Antigo</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Horário Novo</th>
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
                    <td class="border border-gray-300 px-4 py-2">{{ $ticket->statusTicket->status }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <a href="{{ route('dashboard.rh.show_ticket', $ticket->id) }}" class="btn btn-info">Visualizar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>



    
        



