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
            'pageTitle' => 'Editar Aluno',
            'logoUrl' => route('dashboard.master'), // Defina a URL desejada
        ])



        <h2 class="text-3x2 font-black uppercase mb-4">Editar Aluno {{ $aluno->nome }}:</h2>



        <div class="bg-gray-200 p-8 rounded-md shadow-md w-full max-w-2xl"> <!-- Tornado responsivo com w-full -->


            <h2 class="text-lg font-bold mb-4">Editar aluno</h2>
            <!-- Form Grid -->
            <form action="{{ route('dashboard.master.alunos.atualizar', $aluno->id_aluno) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Responsivo: 1 coluna em telas pequenas, 2 colunas em telas maiores -->

                    <!-- Id do Pedido -->
                    <!-- Funcionário -->
                    <div class="form-group flex flex-col">
                        <label for="horario_antigo" class="font-bold mb-2">Nome:</label>
                        <input type="text" name="nome"
                            class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full"
                            value="{{ $aluno->nome }}" required>
                    </div>
                    <div class="form-group flex flex-col">
                        <label for="horario_novo" class="font-bold mb-2">CPF:</label>
                        <input type="text" name="cpf_aluno"
                            class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full"
                            value="{{ $aluno->cpf_aluno }}" required>
                    </div>

                    <!-- Horário Antigo -->
                    <div class="form-group flex flex-col">
                        <label for="gestor_responsavel" class="font-bold mb-2">RG:</label>
                        <input type="text" name="rg"
                            class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full"
                            value="{{ $aluno->rg }}" required>
                    </div>

                    <!-- Horário Novo -->
                    <div class="form-group flex flex-col">
                        <label for="descricao" class="font-bold mb-2">Matrícula:</label>
                        <input name="descricao" name="n_matricula" type="text"
                            class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full"
                            value="{{ $aluno->n_matricula }}" required>
                        </input>
                    </div>

                    <div class="form-group flex flex-col">
                        <label for="data-inicio" class="font-bold mb-2">Curso:</label>
                        <select type="text" name="curso"
                            class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full"
                            value="{{ $aluno->curso->nome ?? 'N/A' }}" required>
                            @foreach ($cursos as $curso)
                                <option value="{{ $curso->id }}"
                                    {{ $curso->id == $aluno->curso ? 'selected' : '' }}>
                                    {{ $curso->curso }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group flex flex-col">
                        <label for="data-fim" class="font-bold mb-2">Status:</label>
                        <select type="text" name="status_aluno"
                            class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full"
                            value="{{ $aluno->statusAluno->nome ?? 'N/A' }}" required>
                            @foreach ($statusAlunos as $status)
                                <option value="{{ $status->id }}"
                                    {{ $status->id == $aluno->status_aluno ? 'selected' : '' }}>
                                    {{ $status->status }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group flex flex-col">
                        <label for="data-fim" class="font-bold mb-2">Email:</label>
                        <input type="text" name="email"
                            class="form-control bg-gray-200 border border-red-500 p-2 rounded-md w-full"
                            value="{{ $aluno->email }}" required>

                        </input>
                    </div>

                    <div class="form-group flex flex-col">
                    </div>

                    <!-- Confirmar -->
                    <div class="flex flex-col md:col"> <!-- Ocupa 2 colunas em telas maiores -->
                        <label class="font-bold mb-2">‎ </label>
                        <a href="{{ route('dashboard.master.alunos') }}" class="btn btn-secondary"><button
                                class=" btn btn-primary w-full border bg-red-500 hover:bg-red-700 text-white border-red-500 p-2 rounded-md">Voltar</button></a>
                        <!-- Botão responsivo com w-full -->
                    </div>
                    <div class="flex flex-col md:col"> <!-- Ocupa 2 colunas em telas maiores -->
                        <label class="font-bold mb-2">‎ </label>
                        <button type="submit"
                            class=" btn btn-primary w-full border bg-red-500 hover:bg-red-700 text-white border-red-500 p-2 rounded-md">Atualizar
                            aluno</button><!-- Botão responsivo com w-full -->
                    </div>
            </form>
        </div>
    </div>
    <br>
    <br>
    <br>
</body>

</html>








{{-- 
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aluno</title>
</head>
<body>
    <h1>Editar Aluno: {{ $aluno->nome }}</h1>
    <form action="{{ route('dashboard.master.alunos.atualizar', $aluno->id_aluno) }}" method="POST">
        @csrf
        @method('PUT')
        
        <label for="nome">Nome:</label>
        <input type="text" name="nome" value="{{ $aluno->nome }}" required>
        <br>

        <label for="cpf_aluno">CPF:</label>
        <input type="text" name="cpf_aluno" value="{{ $aluno->cpf_aluno }}" required>
        <br>

        <label for="rg">RG:</label>
        <input type="text" name="rg" value="{{ $aluno->rg }}" required>
        <br>

        <label for="n_matricula">Número de Matrícula:</label>
        <input type="text" name="n_matricula" value="{{ $aluno->n_matricula }}" required>
        <br>

        <label for="curso">Curso:</label>
        <select name="curso" required>
            @foreach ($cursos as $curso)
                <option value="{{ $curso->id }}" {{ $curso->id == $aluno->curso ? 'selected' : '' }}>
                    {{ $curso->curso }}
                </option>
            @endforeach
        </select>
        <br>

        <label for="status_aluno">Status:</label>
        <select name="status_aluno" required>
            @foreach ($statusAlunos as $status)
                <option value="{{ $status->id }}" {{ $status->id == $aluno->status_aluno ? 'selected' : '' }}>
                    {{ $status->status }}
                </option>
            @endforeach
        </select>
        <br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="{{ $aluno->email }}" required>
        <br>

        <button type="submit">Atualizar Aluno</button>
    </form>
</body>
</html> --}}
