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
            'logoUrl' => route('dashboard.master.funcionario')  // Defina a URL desejada
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

            <form action="{{ route('dashboard.master.funcionarios.adicionar') }}" method="POST">
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
                        <label for="cpf" class="font-bold mb-2">CPF:</label>
                        <input name="cpf" class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" required>
                       
                    </div>

                    <!-- Horário Antigo -->
                    <div class="form-group flex flex-col">
                        <label for="rg" class="font-bold mb-2">NIF:</label>
                        <input name="nif"  class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" required>
                    </div>

                    <!-- Horário Novo -->
                    <div class="form-group flex flex-col">
                        <label for="cargo" class="font-bold mb-2">Cargo:</label>
                        <select name="cargo" type="text" class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" required>
                            @foreach($cargos as $cargo)
                                <option value="{{ $cargo->id }}" {{ old('cargo') == $cargo->id ? 'selected' : '' }}>{{ $cargo->descricao }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group flex flex-col">
                        <label for="horario" class="font-bold mb-2">Horário:</label>
                        <select type="email" name="horario" class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" required>
                            @foreach($horarios as $horario)
                                <option value="{{ $horario->id }}" {{ old('horario') == $horario->id ? 'selected' : '' }}>
                                    {{ $horario->hora_inicio }} - {{ $horario->hora_fim }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group flex flex-col">
                        <label for="senha" class="font-bold mb-2">Senha:</label>
                        <input name="senha" class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" required>
                        
                        </select>
                    </div>

                    <div class="form-group flex flex-col">
                        <label for="status_confirmation" class="font-bold mb-2">Confirme a senha:</label>
                        <input name="senha_confirmation" class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" required>
                    </div>

                    <div class="form-group flex flex-col">
                    </div>

                    

                    <!-- Confirmar -->
                    <div class="flex flex-col md:col"> <!-- Ocupa 2 colunas em telas maiores -->
                        <label class="font-bold mb-2">‎ </label>
                        <button type="submit" class=" btn btn-primary w-full border bg-red-500 hover:bg-red-700 text-white border-red-500 p-2 rounded-md">Cadastrar funcionário</button> <!-- Botão responsivo com w-full -->
                    </div>
                    <div class="flex flex-col md:col"> <!-- Ocupa 2 colunas em telas maiores -->
                        <label class="font-bold mb-2">‎ </label>
                        <a href="{{ route('dashboard.master.funcionario') }}"><button type="button" class="btn btn-secondary w-full border bg-red-500 hover:bg-red-700 text-white border-red-500 p-2 rounded-md">Voltar</button></a> <!-- Botão responsivo com w-full -->
                    </div>
                </div>
            </form>
        </div>
    <br>
    <br>
        
    </div>

</body>
</html>

{{-- <!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Funcionário</title>
</head>
<body>
    <h1>Cadastrar Funcionário</h1>

    <a href="{{ route('funcionarios.listar') }}">Voltar</a>

    <!-- Exibe mensagens de sucesso ou erro -->
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <!-- Exibe os erros de validação -->
    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('funcionarios.adicionar') }}" method="POST">
        @csrf
        <label for="nome">Nome:</label>
        <input type="text" name="nome" value="{{ old('nome') }}">
        <br>

        <label for="cpf">CPF:</label>
        <input type="text" name="cpf" value="{{ old('cpf') }}">
        <br>

        <label for="nif">NIF:</label>
        <input type="text" name="nif" value="{{ old('nif') }}">
        <br>

        <label for="cargo">Cargo:</label>
        <select name="cargo">
            @foreach($cargos as $cargo)
                <option value="{{ $cargo->id }}" {{ old('cargo') == $cargo->id ? 'selected' : '' }}>{{ $cargo->descricao }}</option>
            @endforeach
        </select>
        <br>

        <label for="horario">Horário:</label>
        <select name="horario">
            @foreach($horarios as $horario)
                <option value="{{ $horario->id }}" {{ old('horario') == $horario->id ? 'selected' : '' }}>
                    {{ $horario->hora_inicio }} - {{ $horario->hora_fim }}
                </option>
            @endforeach
        </select>
        <br>

        <label for="senha">Senha:</label>
        <input type="password" name="senha">
        <br>

        <label for="senha_confirmation">Confirme a Senha:</label>
        <input type="password" name="senha_confirmation">
        <br>

        <button type="submit">Cadastrar Funcionário</button>
    </form>
</body>
</html> --}}
