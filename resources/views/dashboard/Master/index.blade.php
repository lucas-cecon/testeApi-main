<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Load Inter font from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Load Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/img/senai.svg') }}">

    <title>SENAI - Dashboard Master</title>

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
            'logoUrl' => route('dashboard.master'), // Defina a URL desejada
        ])

        <!-- Title -->
        <h1 class="text-3x2 font-black mt-10 mb-20">Seja bem-vindo, {{ session('nome') }}!<br></h1>

        <!-- Responsive Grid for Icons -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-20"> <!-- Grid for responsivity -->
            <!-- Icon 1 -->
            <div class="flex flex-col items-center">
                <a href="{{ route('dashboard.master.funcionario') }}">
                    <div
                        class="w-32 h-32 flex items-center justify-center rounded-full shadow-lg bg-white transition transform hover:scale-110 hover:shadow-2xl">
                        <img src="{{ asset('assets/img/icone_dashboard_1.svg') }}" alt="Icon 1"
                            class="w-32 h-32 transition-opacity hover:opacity-80">
                    </div>
                </a>
                <a href="{{ url('diploma') }}">
                    <p class="mt-3 text-3x2 font-black text-center uppercase leading-snug h-16">Lista<br>Funcionários
                    </p>
                </a>
                <div class="w-16 h-1 bg-red-500 mt-5"></div>
            </div>

            <!-- Icon 2 -->
            <div class="flex flex-col items-center">
                <a href="{{ route('dashboard.master.alunos') }}">
                    <div
                        class="w-32 h-32 flex items-center justify-center rounded-full shadow-lg bg-white transition transform hover:scale-110 hover:shadow-2xl">
                        <img src="{{ asset('assets/img/icone_dashboard_1.svg') }}" alt="Icon 2"
                            class="w-32 h-32 transition-opacity hover:opacity-80">
                    </div>
                </a>
                <a href="{{ url('aapm') }}">
                    <p class="mt-3 text-3x2 font-black text-center uppercase leading-snug h-16">Lista<br>alunos</p>
                </a>
                <div class="w-16 h-1 bg-red-500 mt-5"></div>
            </div>

            {{-- <!-- Icon 3 -->
            <a href="{{ route('dashboard.master.pedidos_ticket')}}"><div class="flex flex-col items-center">
                <div class="w-32 h-32 flex items-center justify-center rounded-full shadow-lg bg-white transition transform hover:scale-110 hover:shadow-2xl">
                    <img src="{{ asset('assets/img/icone_dashboard_3.svg') }}" alt="Icon 3" class="w-32 h-32 transition-opacity hover:opacity-80">
                </div>
                <p class="mt-3 text-3x2 font-black text-center uppercase leading-snug h-16">Ponto<br>Virtual</p>
                <div class="w-16 h-1 bg-red-500 mt-5"></div>
            </div></a> --}}
        </div>

    </div>
</body>

</html>
