<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENAI - Criar aluno</title>
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
            'pageTitle' => 'Criar Aluno',
            'logoUrl' => route('dashboard.master.funcionario'), // Defina a URL desejada
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

            <form action="{{ route('dashboard.master.atualizar', ['id' => $funcionario->ID_funcionario]) }}"
                method="POST">
                @csrf
                @method('PUT')
                <!-- Form Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Responsivo: 1 coluna em telas pequenas, 2 colunas em telas maiores -->
                    <!-- Id do Pedido -->
                    <!-- Funcionário -->
                    <div class="form-group flex flex-col">
                        <label for="nome" class="font-bold mb-2">Nome:</label>
                        <input type="text" name="nome"
                            class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full"
                            value="{{ old('nome', $funcionario->nome) }}" required>
                    </div>
                    <div class="form-group flex flex-col">
                        <label for="cpf" class="font-bold mb-2">CPF:</label>
                        <input name="cpf"
                            class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full"
                            value="{{ old('cpf', $funcionario->cpf) }}" required>

                    </div>

                    <!-- Horário Antigo -->
                    <div class="form-group flex flex-col">
                        <label for="rg" class="font-bold mb-2">NIF:</label>
                        <input name="nif"
                            class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full"
                            value="{{ old('nif', $funcionario->nif) }}" required>
                    </div>

                    <!-- Horário Novo -->
                    <div class="form-group flex flex-col">
                        <label for="cargo" class="font-bold mb-2">Cargo:</label>
                        <select name="cargo" type="text"
                            class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" required>
                            @foreach ($cargos as $cargo)
                                <option value="{{ $cargo->id }}"
                                    {{ $funcionario->cargo == $cargo->id ? 'selected' : '' }}>
                                    {{ $cargo->descricao }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group flex flex-col">
                        <label for="horario" class="font-bold mb-2">Horário:</label>
                        <select type="email" name="horario"
                            class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full" required>
                            @foreach ($horarios as $horario)
                                <option value="{{ $horario->id }}"
                                    {{ old('horario') == $horario->id ? 'selected' : '' }}>
                                    {{ $horario->hora_inicio }} - {{ $horario->hora_fim }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group flex flex-col">
                        <label for="senha" class="font-bold mb-2">Senha:</label>
                        <input name="senha"
                            class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full">
                    </div>

                    <div class="form-group flex flex-col">
                        <label for="senha_confirmation" class="font-bold mb-2">Confirme a senha:</label>
                        <input name="senha_confirmation"
                            class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full">
                    </div>

                    <div class="form-group flex flex-col">
                    </div>



                    <!-- Confirmar -->
                    <div class="flex flex-col md:col"> <!-- Ocupa 2 colunas em telas maiores -->
                        <label class="font-bold mb-2">‎ </label>
                        <button type="submit"
                            class=" btn btn-primary w-full border bg-red-500 hover:bg-red-700 text-white border-red-500 p-2 rounded-md">Atualizar
                            funcionário:</button> <!-- Botão responsivo com w-full -->
                    </div>
                    <div class="flex flex-col md:col"> <!-- Ocupa 2 colunas em telas maiores -->
                        <label class="font-bold mb-2">‎ </label>
                        <a href="{{ route('dashboard.master') }}"><button type="button"
                                class="btn btn-secondary w-full border bg-red-500 hover:bg-red-700 text-white border-red-500 p-2 rounded-md">Voltar</button></a>
                        <!-- Botão responsivo com w-full -->
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
    <title>Editar Funcionário</title>
</head>
<body>
    <h1>Editar Funcionário</h1>

    <!-- Exibir mensagens de erro -->
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif 



    <form action="{{ route('dashboard.master.atualizar', ['id' => $funcionario->ID_funcionario]) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="{{ old('nome', $funcionario->nome) }}" required>
        <br>

        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" value="{{ old('cpf', $funcionario->cpf) }}" required>
        <br>

        <label for="nif">NIF:</label>
        <input type="text" id="nif" name="nif" value="{{ old('nif', $funcionario->nif) }}" required>
        <br>

        <label for="cargo">Cargo:</label>
        <select id="cargo" name="cargo" required>
            @foreach ($cargos as $cargo)
                <option value="{{ $cargo->id }}" {{ $funcionario->cargo == $cargo->id ? 'selected' : '' }}>
                    {{ $cargo->descricao }}
                </option>
            @endforeach
        </select>
        <br>

        <label for="horario">Horário:</label>
        <select id="horario" name="horario" required>
            @foreach ($horarios as $horario)
                <option value="{{ $horario->id }}" {{ $funcionario->horario == $horario->id ? 'selected' : '' }}>
                    {{ $horario->hora_inicio }} - {{ $horario->hora_fim }}
                </option>
            @endforeach
        </select>
        <br>

        <label for="senha">Senha (deixe em branco para não alterar):</label>
        <input type="password" id="senha" name="senha">
        <br>

        <label for="senha_confirmation">Confirme a Senha:</label>
        <input type="password" id="senha_confirmation" name="senha_confirmation">
        <br>

        <button type="submit">Atualizar Funcionário</button>
    </form>

    <a href="{{ route('funcionarios.listar') }}">Voltar para lista</a>
</body>
</html> --}}
