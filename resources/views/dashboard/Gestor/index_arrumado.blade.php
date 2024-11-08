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
        <div class="container mx-auto flex justify-between items-center w-11/12">
            <!-- Logo SENAI e Secretaria -->
            <div class="flex items-center">
                <!-- Logo SENAI -->
                <img src="{{ asset('assets/img/senai.svg') }}" alt="SENAI Logo" class="senai-logo">
                <!-- Texto "Secretaria" -->
                <span class="secretaria-text">Secretaria</span>
            </div>
        </div>
        <div class="w-11/12 h-0.5 bg-red-500 mb-2"></div>

        <div class="w-11/12 items-center mb-2"> <!-- Adjusted for positioning -->
            <h2 class="text-3x2 text-red-500 font-black uppercase">Dashboard</h2>
        </div>
        
        <div class="w-11/12 h-0.5 bg-red-500 mb-4"></div> <!-- Red line -->

        <!-- Title -->
        <h1 class="text-3x2 font-black mt-10 mb-20">Seja bem-vindo, {{ session('nome') }}!<br></h1>

        <!-- Responsive Grid for Icons -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-20"> <!-- Grid for responsivity -->
            <!-- Icon 1 -->
            <div class="flex flex-col items-center">
                <a href="{{url('diplomas')}}"><div class="w-32 h-32 flex items-center justify-center rounded-full shadow-lg bg-white transition transform hover:scale-110 hover:shadow-2xl">
                    <img src="{{ asset('assets/img/icone_dashboard_1.svg') }}" alt="Icon 1" class="w-32 h-32 transition-opacity hover:opacity-80">
                </div></a>
                <a href="{{url('diplomas')}}"><p class="mt-3 text-3x2 font-black text-center uppercase leading-snug h-16">Diplomas</p></a>
                <div class="w-16 h-1 bg-red-500 mt-5"></div>
            </div>

            <!-- Icon 2 -->
            <div class="flex flex-col items-center">
                <a href="{{url('aapm')}}"><div class="w-32 h-32 flex items-center justify-center rounded-full shadow-lg bg-white transition transform hover:scale-110 hover:shadow-2xl">
                    <img src="{{ asset('assets/img/icone_dashboard_2.svg') }}" alt="Icon 2" class="w-32 h-32 transition-opacity hover:opacity-80">
                </div></a>
                <a href="{{url('aapm')}}"><p class="mt-3 text-3x2 font-black text-center uppercase leading-snug h-16">Portal da<br>AAPM</p></a>
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
    </div>
</body>
</html>

