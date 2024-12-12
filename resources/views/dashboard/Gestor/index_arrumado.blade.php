<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/img/senai.svg') }}">
    <title>SENAI - Gestor Dashboard</title>
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
            'logoUrl' => route('dashboard.gestor.index_arrumado'), // Defina a URL desejada
        ])

        <!-- Title -->
        <h1 class="text-3x2 font-black mt-10 mb-2">Seja bem-vindo, {{ session('nome') }}!<br></h1>
        <main class="flex-grow flex items-center justify-center"> <!-- Centralização -->
            <div class="flex flex-col items-center">
                <a href="{{ route('dashboard.gestor.pedidos_ticket') }}">
                    <div class="flex flex-col items-center">
                        <!-- Ícone -->
                        <div
                            class="w-32 h-32 flex items-center justify-center rounded-full shadow-lg bg-white transition transform hover:scale-110 hover:shadow-2xl">
                            <img src="{{ asset('assets/img/icone_dashboard_3.svg') }}" alt="Icon 3"
                                class="w-32 h-32 transition-opacity hover:opacity-80">
                        </div>
                        <!-- Texto abaixo do ícone -->
                        <p class="mt-3 text-3x2 font-black text-center uppercase leading-snug h-16">Ponto<br>Virtual</p>
                        <div class="w-16 h-1 bg-red-500 mt-5"></div>
                    </div>
                </a>
            </div>
        </main>
</body>

</html>
