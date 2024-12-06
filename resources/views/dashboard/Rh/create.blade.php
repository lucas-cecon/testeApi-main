<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENAI - Criação de Diplomas</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/img/senai.svg') }}">
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
            'logoUrl' => route('dashboard.rh')
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

            <form action="{{ route('diplomas.store') }}" method="POST">
            @csrf

                <!-- Form Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4"> <!-- Responsivo: 1 coluna em telas pequenas, 2 colunas em telas maiores -->
                    <!-- Id do Pedido -->
                    <!-- Funcionário -->
                    <div class="form-group flex flex-col">
                        <label for="horario_novo" class="font-bold mb-2">Título do Diploma:</label>
                        <input type="text" id="titulo" name="titulo"  class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" required>
                    </div>

                    <!-- Horário Antigo -->
                    <div class="form-group flex flex-col">
                        <label for="gestor_responsavel" class="font-bold mb-2">Lote do Diploma:</label>
                        <input type="text" id="lote_diploma" name="lote_diploma" class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" required>
                    
                    </div>

                    <!-- Horário Novo -->
                    <div class="form-group flex flex-col">
                        <label for="descricao" class="font-bold mb-2">Quantidade de Diplomas:</label>
                        <input type="number" id="quant_diploma" name="quant_diploma" class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full">
                    </div>
                    <div>
                        
                    </div>

                    <!-- Confirmar -->
                    <div class="flex flex-col md:col"> <!-- Ocupa 2 colunas em telas maiores -->
                        <label class="font-bold mb-2">‎ </label>
                        <button type="submit" class=" btn btn-primary w-full border bg-red-500 hover:bg-red-700 text-white border-red-500 p-2 rounded-md">Criar diploma</button> <!-- Botão responsivo com w-full -->
                    </div>
                    <div class="flex flex-col md:col"> <!-- Ocupa 2 colunas em telas maiores -->
                        <label class="font-bold mb-2">‎ </label>
                        <a href="{{ route('dashboard.rh.diplomas') }}/"><button type="button" class="btn btn-secondary w-full border bg-red-500 hover:bg-red-700 text-white border-red-500 p-2 rounded-md">Voltar</button></a> <!-- Botão responsivo com w-full -->
                    </div>
                </div>
            </form>
        </div>
        
    </div>

</body>
</html>

{{-- 

<!-- resources/views/dashboard/rh/create.blade.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Diploma</title>
</head>
<body>
    <h1>Criar Novo Diploma</h1>

    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

<!-- resources/views/dashboard/rh/create.blade.php -->
<form method="POST" action="{{ route('diplomas.store') }}">
    @csrf
    <div>
        <label for="titulo">Título do Diploma:</label>
        <input type="text" id="titulo" name="titulo" required>
    </div>
    <div>
        <label for="lote_diploma">Lote do Diploma:</label>
        <input type="text" id="lote_diploma" name="lote_diploma" required>
    </div>
    <div>
        <label for="quant_diploma">Quantidade de Diplomas:</label>
        <input type="number" id="quant_diploma" name="quant_diploma" required min="1">
    </div>
    <div>
        <label for="turma_diploma">Turma:</label>
        <select id="turma_diploma" name="turma_diploma" required>
            <option value="">Selecione uma turma</option>
            @foreach ($cursos as $curso)
                <option value="{{ $curso->id }}">{{ $curso->curso }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <button type="submit">Criar Diploma</button>
    </div>
</form>


    <a href="{{ route('dashboard.rh') }}">
        <button>Voltar</button>
    </a>
</body>
</html> --}}
