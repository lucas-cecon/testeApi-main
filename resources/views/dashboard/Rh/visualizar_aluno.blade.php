<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENAI - Dados Alunos</title>
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
            'pageTitle' => 'Ponto Virtual',
            'logoUrl' => route('dashboard.rh')  // Defina a URL desejada
        ])

        

        <h2 class="text-3x2 font-black uppercase mb-4">Informações sobre meu pedido:</h2>



    <div class="bg-gray-200 p-8 rounded-md shadow-md w-full max-w-2xl "> <!-- Tornado responsivo com w-full -->
            <h2 class="text-lg font-bold mb-4">Pedido</h2>
                 <!-- Form Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4"> <!-- Responsivo: 1 coluna em telas pequenas, 2 colunas em telas maiores -->
                    <!-- Id do Pedido -->
                    <!-- Funcionário -->
                    <div class="form-group flex flex-col">
                        <label for="horario_antigo" class="font-bold mb-2">Nome:</label>
                        <input type="text"  class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" value="{{ $aluno->nome }}" readonly>
                    </div>
                    <div class="form-group flex flex-col">
                        <label for="horario_novo" class="font-bold mb-2">CPF:</label>
                        <input type="text"  class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" value="{{ $aluno->cpf_aluno }}" readonly>
                    </div>

                    <!-- Horário Antigo -->
                    <div class="form-group flex flex-col">
                        <label for="gestor_responsavel" class="font-bold mb-2">RG:</label>
                        <input type="text"  class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" value="{{ $aluno->rg }}" readonly>
                    </div>

                    <!-- Horário Novo -->
                    <div class="form-group flex flex-col">
                        <label for="descricao" class="font-bold mb-2">Matrícula:</label>
                        <input name="descricao" type="text" class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" value="{{ $aluno->n_matricula }}" readonly>
                    </input>
                    </div>

                    <div class="form-group flex flex-col">
                        <label for="data-inicio" class="font-bold mb-2">Curso:</label>
                        <input type="text" name="data_inicio" class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" value="{{ $aluno->curso->nome ?? 'N/A' }}" readonly>
                    </input>
                    </div>

                    <div class="form-group flex flex-col">
                        <label for="data-fim" class="font-bold mb-2">Status:</label>
                        <input type="text" name="data_fim" class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" value="{{ $aluno->statusAluno->nome ?? 'N/A' }}" readonly>
                    </input>
                    </div>

                    <div class="form-group flex flex-col">
                        <label for="data-fim" class="font-bold mb-2">AAPM status:</label>
                        <input type="text" name="data_fim" class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" value="{{ $aluno->apmStatus->nome ?? 'N/A' }}" readonly>
                        
                    </input>
                    </div>

                    <div class="form-group flex flex-col">
                        <label for="data-fim" class="font-bold mb-2">Email:</label>
                        <input type="text" name="data_fim" class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" value="{{ $aluno->email }}" readonly>
                        
                    </input>
                    </div>

                    <!-- Confirmar -->
                    <div class="
                     flex flex-col md:col"> <!-- Ocupa 2 colunas em telas maiores -->
                        <label class="font-bold mb-2">‎ </label>
                        <a href="{{ route('dashboard.rh.apm') }}" class="btn btn-secondary"><button  class=" btn btn-primary w-full border bg-red-500 hover:bg-red-700 text-white border-red-500 p-2 rounded-md">Voltar</button></a> <!-- Botão responsivo com w-full -->
                    </div>
                </div>
        </div>
    <br>
    <br>
    <br>    
    </body>
</html>

















{{-- 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h1>Detalhes do Aluno</h1>

    <p><strong>Nome:</strong> {{ $aluno->nome }}</p>
    <p><strong>CPF:</strong> {{ $aluno->cpf_aluno }}</p>
    <p><strong>RG:</strong> {{ $aluno->rg }}</p>
    <p><strong>Matrícula:</strong> {{ $aluno->n_matricula }}</p>
    <p><strong>Curso:</strong> {{ $aluno->curso->nome ?? 'N/A' }}</p>
    <p><strong>Status:</strong> {{ $aluno->statusAluno->nome ?? 'N/A' }}</p>
    <p><strong>Apm Status:</strong> {{ $aluno->apmStatus->nome ?? 'N/A' }}</p>
    <p><strong>Email:</strong> {{ $aluno->email }}</p>

    <a href="{{ route('dashboard.master.alunos') }}" class="btn btn-primary" style="margin-top: 20px;">Voltar</a>
    
</body>
</html>


 --}}
