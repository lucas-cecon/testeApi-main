<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENAI - Criar diploma</title>
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
            'pageTitle' => 'Diplomas',
            'logoUrl' => route('dashboard.rh')  // Defina a URL desejada
        ])

        <h2 class="text-3x2 font-black uppercase mb-4">Informações para criação de diploma:</h2>

        
        

        <!-- Form Container -->
        <div class="bg-gray-200 p-8 rounded-md shadow-md w-full max-w-2xl"> <!-- Tornado responsivo com w-full -->
            <h2 class="text-lg font-bold mb-4">Pedido</h2>
          
             @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                </ul>
            </div>
            @endif

            <form action="{{ route('diplomas.salvar') }}" method="POST">
            @csrf

                <!-- Form Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4"> <!-- Responsivo: 1 coluna em telas pequenas, 2 colunas em telas maiores -->
                    <!-- Id do Pedido -->
                    <!-- Funcionário -->
                    <div class="form-group flex flex-col">
                        <label for="horario_novo" class="font-bold mb-2">Título do Diploma:</label>
                        <input type="text" name="titulo"  class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" required>
                    </div>

                    <!-- Horário Antigo -->
                    <div class="form-group flex flex-col">
                        <label for="gestor_responsavel" class="font-bold mb-2">Lote do Diploma:</label>
                        <input type="text" name="lote_diploma" class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" required>
                    
                    </div>

                    <!-- Horário Novo -->
                    <div class="form-group flex flex-col">
                        <label for="descricao" class="font-bold mb-2">Quantidade de Diplomas:</label>
                        <input type="number" name="quant_diploma" class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full">
                    </div>

                    <div class="form-group flex flex-col">
                        <label for="data-inicio" class="font-bold mb-2">Turma:</label>
                        <select id="turma_diploma" name="turma_diploma" class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" required>
                        <option value="">Selecione uma turma</option>
                        @foreach ($cursos as $curso)
                            <option value="{{ $curso->id }}">{{ $curso->curso }}</option>
                        @endforeach
                        </select>
                    </div>

                    <!-- Confirmar -->
                    <div class="flex flex-col md:col"> <!-- Ocupa 2 colunas em telas maiores -->
                        <label class="font-bold mb-2">‎ </label>
                        <button type="submit" class=" btn btn-primary w-full border bg-red-500 hover:bg-red-700 text-white border-red-500 p-2 rounded-md">Criar diploma</button> <!-- Botão responsivo com w-full -->
                    </div>
                    <div class="flex flex-col md:col"> <!-- Ocupa 2 colunas em telas maiores -->
                        <label class="font-bold mb-2">‎ </label>
                        <a href="{{ route('dashboard.master') }}/"><button type="button" class="btn btn-secondary w-full border bg-red-500 hover:bg-red-700 text-white border-red-500 p-2 rounded-md">Voltar</button></a> <!-- Botão responsivo com w-full -->
                    </div>
                </div>
            </form>
        </div>
        
    </div>

</body>
</html>











{{-- 
    <h1>Criar Novo Diploma</h1>

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('diplomas.salvar') }}">
        @csrf
        <div>
            <label for="titulo">Título do Diploma:</label>
            <input type="text" name="titulo" required>
        </div>
        <div>
            <label for="lote_diploma">Lote do Diploma:</label>
            <input type="text" name="lote_diploma" required>
        </div>
        <div>
            <label for="quant_diploma">Quantidade de Diplomas:</label>
            <input type="number" name="quant_diploma" required>
        </div>
        <div>
            <label for="turma_diploma">Turma:</label>
            <select name="turma_diploma" required>
                @foreach($cursos as $curso)
                    <option value="{{ $curso->id }}">{{ $curso->curso }}</option>
                @endforeach
            </select>
        </div>
        
        <button type="submit">Criar Diploma</button>
    </form>

    <a href="{{ route('dashboard.master') }}">
        <button>Voltar</button>
    </a> --}}
