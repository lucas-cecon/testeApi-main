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
    <title>SENAI - RH Dashboard</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/img/senai.svg') }}">
    
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
        
        @include('components.header', [
            'sectionTitle' => 'Secretaria',
            'pageTitle' => 'Dashboard',
            'logoUrl' => route('dashboard.rh')
        ])

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
                <a href="{{ route('dashboard.rh.pedidos') }}"><div class="w-32 h-32 flex items-center justify-center rounded-full shadow-lg bg-white transition transform hover:scale-110 hover:shadow-2xl">
                    <img src="{{ asset('assets/img/icone_dashboard_3.svg') }}" alt="Icon 3" class="w-32 h-32 transition-opacity hover:opacity-80">
                </div></a>
                <a href="{{ route('dashboard.rh.pedidos') }}"><p class="mt-3 text-3x2 font-black text-center uppercase leading-snug h-16">Ponto<br>Virtual</p></a>
                <div class="w-16 h-1 bg-red-500 mt-5"></div>
            </div>
        </div>

        
    </div>
</body>
</html>



    
        



