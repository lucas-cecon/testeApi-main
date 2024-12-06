<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENAI - Criar aluno</title>
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
            'pageTitle' => 'Criar Aluno',
            'logoUrl' => route('dashboard.master')  // Defina a URL desejada
        ])


        <h2 class="text-3x2 font-black uppercase mb-4">Adicionar aluno:</h2>

        
        

        <!-- Form Container -->
        <div class="bg-gray-200 p-8 rounded-md shadow-md w-full max-w-2xl"> <!-- Tornado responsivo com w-full -->
            <h2 class="text-lg font-bold mb-4">Pedido</h2>
          
             @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('dashboard.master.alunos.armazenar') }}" method="POST">
            @csrf

                <!-- Form Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4"> <!-- Responsivo: 1 coluna em telas pequenas, 2 colunas em telas maiores -->
                    <!-- Id do Pedido -->
                    <!-- Funcionário -->
                    <div class="form-group flex flex-col">
                        <label for="nome" class="font-bold mb-2">Nome:</label>
                        <input type="text" name="nome" class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" required>
                    </div>
                    <div class="form-group flex flex-col">
                        <label for="cpf_aluno" class="font-bold mb-2">CPF:</label>
                        <input name="cpf_aluno" class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" required>
                       
                    </div>

                    <!-- Horário Antigo -->
                    <div class="form-group flex flex-col">
                        <label for="rg" class="font-bold mb-2">RG:</label>
                        <input name="rg"  class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full"required>
                    </div>

                    <!-- Horário Novo -->
                    <div class="form-group flex flex-col">
                        <label for="n_matricula" class="font-bold mb-2">Número de Matrícula:</label>
                        <input name="n_matricula" type="text" class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" required>
                    </div>

                    <div class="form-group flex flex-col">
                        <label for="email" class="font-bold mb-2">Email:</label>
                        <input type="email" name="email" class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" required>
                    </div>

                    <div class="form-group flex flex-col">
                        <label for="curso_id" class="font-bold mb-2">Curso:</label>
                        <select name="curso" class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" required>
                            @foreach ($cursos as $curso)
                                <option value="{{ $curso->id }}">{{ $curso->curso }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group flex flex-col">
                        <label for="status_aluno_id" class="font-bold mb-2">Status:</label>
                        <select name="status_aluno_id" class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" required>
                            @foreach ($statusAlunos as $status)
                                <option value="{{ $status->id }}">{{ $status->status }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group flex flex-col">
                        <label for="apm_status_id" class="font-bold mb-2">AAPM Status:</label>
                        <select name="apm_status_id" class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" required>
                             @foreach ($apmStatus as $apm)
                                <option value="{{ $apm->id }}">{{ $apm->status }}</option>
                            @endforeach
                        </select>
                    </div>

                    

                    <!-- Confirmar -->
                    <div class="flex flex-col md:col"> <!-- Ocupa 2 colunas em telas maiores -->
                        <label class="font-bold mb-2">‎ </label>
                        <button type="submit" class=" btn btn-primary w-full border bg-red-500 hover:bg-red-700 text-white border-red-500 p-2 rounded-md">Criar aluno</button> <!-- Botão responsivo com w-full -->
                    </div>
                    <div class="flex flex-col md:col"> <!-- Ocupa 2 colunas em telas maiores -->
                        <label class="font-bold mb-2">‎ </label>
                        <a href="{{ route('dashboard.master.alunos') }}"><button type="button" class="btn btn-secondary w-full border bg-red-500 hover:bg-red-700 text-white border-red-500 p-2 rounded-md">Voltar</button></a> <!-- Botão responsivo com w-full -->
                    </div>
                </div>
            </form>
        </div>
    <br>
    <br>
        
    </div>

</body>
</html>

{{-- 
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Novo Aluno</title>
</head>
<body>
    <h1>Criar Novo Aluno</h1>
    <form action="{{ route('dashboard.master.alunos.armazenar') }}" method="POST">
        @csrf
        
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required>
        <br>

        <label for="cpf_aluno">CPF:</label>
        <input type="text" name="cpf_aluno" required>
        <br>

        <label for="rg">RG:</label>
        <input type="text" name="rg" required>
        <br>

        <label for="n_matricula">Número de Matrícula:</label>
        <input type="text" name="n_matricula" required>
        <br>

        <label for="curso_id">Curso:</label>
        <select name="curso" required> <!-- Alterado para 'curso' -->
            @foreach ($cursos as $curso)
                <option value="{{ $curso->id }}">{{ $curso->curso }}</option>
            @endforeach
        </select>
        
        <br>

        <label for="status_aluno_id">Status:</label>
        <select name="status_aluno_id" required>
            @foreach ($statusAlunos as $status)
                <option value="{{ $status->id }}">{{ $status->status }}</option>
            @endforeach
        </select>
        <br>

        <label for="apm_status_id">APM Status:</label>
        <select name="apm_status_id" required>
            @foreach ($apmStatus as $apm)
                <option value="{{ $apm->id }}">{{ $apm->status }}</option>
            @endforeach
        </select>
        <br>

        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br>

        <button type="submit">Criar Aluno</button>
    </form>

    <a href="{{ route('dashboard.master.alunos') }}" class="btn btn-primary" style="margin-top: 20px;">Voltar</a>

</body>
</html> --}}
