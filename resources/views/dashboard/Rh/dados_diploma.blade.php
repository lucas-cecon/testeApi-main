<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENAI - Editar perfil</title>
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

    <div class="flex flex-col items-center mb-10 bg-gray-100"> 
        <div class="container mx-auto pt-2 flex justify-between items-center w-11/12">
            <!-- Logo SENAI e Secretaria -->
            <div class="flex items-center">
                <!-- Logo SENAI -->
                <a href="{{url('')}}"><img src="{{ asset('assets/img/senai.svg') }}" alt="SENAI Logo" class="senai-logo"></a>
                <!-- Texto "Secretaria" -->
                <span class="secretaria-text">Secretaria</span>
            </div>
        </div>
    
        <div class="w-11/12 h-0.5 bg-red-500 mb-2"></div>

        <div class="w-11/12 items-center mb-2"> <!-- Adjusted for positioning -->
            <h2 class="text-3x2 text-red-500 font-black uppercase">Detalhes do diploma:</h2>
        </div>
        
        <div class="w-11/12 h-0.5 bg-red-500 mb-4"></div> <!-- Red line -->

        <h2 class="text-3x2 font-black uppercase mb-4">Informações sobre o diploma:</h2>

        <!-- Form Container -->
        <div class="bg-gray-200 p-8 rounded-md shadow-md w-full max-w-2xl"> <!-- Tornado responsivo com w-full -->
            <h2 class="text-lg font-bold mb-4"> Informações</h2>
            
            <!-- Form Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4"> <!-- Responsivo: 1 coluna em telas pequenas, 2 colunas em telas maiores -->
                <!-- Id do Pedido -->
                <!-- Funcionário -->
                <div class="flex flex-col">
                    <label for="funcionario" class="font-bold mb-2">ID:</label>
                    <input type="text" id="funcionario" value="{{ $diploma->id }}" class="bg-gray-200 border border-red-500 p-2 rounded-md w-full" readonly>
                </div>

                <!-- Horário Antigo -->
                <div class="flex flex-col">
                    <label for="horario-antigo" class="font-bold mb-2">Título:</label>
                    <input type="text" id="horario-antigo" value="{{ $diploma->titulo }}" class="bg-gray-200 border border-red-500 p-2 rounded-md w-full" readonly>
                </div>

                <div class="flex flex-col">
                    <label for="horario-antigo" class="font-bold mb-2">Lote do diploma:</label>
                    <input type="text" id="horario-antigo" value="{{ $diploma->lote_diploma }}" class="bg-gray-200 border border-red-500 p-2 rounded-md w-full" readonly>
                </div>

                <div class="flex flex-col">
                    <label for="horario-antigo" class="font-bold mb-2">Quantidade:</label>
                    <input type="text" id="horario-antigo" value="{{ $diploma->quant_diploma }}" class="bg-gray-200 border border-red-500 p-2 rounded-md w-full" readonly>
                </div>

                <div class="flex flex-col">
                    <label for="horario-antigo" class="font-bold mb-2">Turma:</label>
                    <input type="text" id="horario-antigo" value="{{ $diploma->curso ? $diploma->curso->curso : 'Turma não encontrada' }}" class="bg-gray-200 border border-red-500 p-2 rounded-md w-full" readonly>
                </div>

                <div class="flex flex-col">
                    <label for="horario-antigo" class="font-bold mb-2">Status:</label>
                    <input type="text" id="horario-antigo" value=" @if($diploma->status == 1)Aberto
    @elseif($diploma->status == 2)Em andamento
    @elseif($diploma->status == 3)Concluído
    @else
Desconhecido
    @endif" class="bg-gray-200 border border-red-500 p-2 rounded-md w-full" readonly>
                </div>

                


        <div class="flex flex-col grid-cols-">
                @if($diploma->status < 3)
            <form method="POST" action="{{ route('diplomas.atualizarStatus', $diploma->id) }}" style="display:inline;" onsubmit="return confirmUpdate();">
                @csrf
                <button type="submit" id="updateStatusButton" class=" btn btn-primary w-full border bg-red-500 hover:bg-red-700 text-white border-red-500 p-2 rounded-md">Atualizar Status</button>
            </form>
        @endif
        </div>



        <div class="flex flex-col grid-cols-">
            <h2 class="font-bold mb-2">Adicionar Aluno ao Diploma</h2>
    <form method="POST" action="{{ route('diplomas.associar', $diploma->id) }}">
        @csrf
        <div>
            <select id="aluno_id" name="aluno_id" class="bg-gray-200 border border-red-500 p-2 rounded-md w-full mb-2" required>
                <option value="">Selecione um aluno</option>
                @foreach ($todosAlunos as $aluno)
                    <option value="{{ $aluno->id_aluno }}">{{ $aluno->nome }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <button type="submit" class=" btn btn-primary w-full border bg-red-500 hover:bg-red-700 text-white border-red-500 p-2 rounded-md">Adicionar Aluno</button>
        </div>
    </form>

        </div>




        <div class="flex flex-col">
                <h2 class="font-bold mb-2">Alunos Relacionados:</h2>

                    @if($alunosRelacionados->isEmpty())
                        <p>Nenhum aluno associado a este diploma.</p>
                    @else
                        <table class=" table-auto w-full border-collapse border border-gray-200">
                            <thead class="bg-gray-100 text-gray-600 text-sm uppercase font-semibold">
                                <tr>
                                    <th class="border border-gray-300 px-9 py-2 text-left">ID do Aluno</th>
                                    <th class="border border-gray-300 px-9 py-2 text-left">Nome do Aluno</th>
                                    <th class="border border-gray-300 px-9 py-2 text-left">CPF do Aluno</th>
                                    <th class="border border-gray-300 px-9 py-2 text-left">RG do Aluno</th>
                                    @if($diploma->status < 3) <!-- Exibe a coluna de Ações apenas se o status for menor que 3 -->
                                    <th class="border border-gray-300 px-9 py-2 text-left">Ações</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="text-gray-700 text-sm">
                                @foreach($alunosRelacionados as $relacao)
                                    <tr class="border-b">
                                        <td class="border border-gray-300 px-4 py-2">{{ $relacao->aluno->id_aluno }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $relacao->aluno->nome }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $relacao->aluno->cpf_aluno }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $relacao->aluno->rg }}</td>
                                        @if($diploma->status < 3) <!-- Apenas exibe o botão de Remover se o status for menor que 3 -->
                                            <td class="border border-gray-300 px-4 py-2">
                                                <form method="POST" action="{{ route('diplomas.remover', $relacao->id) }}" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Tem certeza que deseja remover este aluno do diploma?');">Remover</button>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    </div>

            </div>
        </div>
    </div>

        <a href="{{ route('dashboard.rh.diplomas') }}">Voltar para a lista de diplomas</a>

    </div>



</body>
</html>


{{-- 

<h1>Detalhes do Diploma</h1>

<p><strong>ID:</strong> {{ $diploma->id }}</p>
<p><strong>Título:</strong> {{ $diploma->titulo }}</p>
<p><strong>Lote do Diploma:</strong> {{ $diploma->lote_diploma }}</p>
<p><strong>Quantidade:</strong> {{ $diploma->quant_diploma }}</p>
<p><strong>Turma:</strong> {{ $diploma->curso ? $diploma->curso->curso : 'Turma não encontrada' }}</p>
<p><strong>Status:</strong>
    @if($diploma->status == 1)
        Aberto
    @elseif($diploma->status == 2)
        Em andamento
    @elseif($diploma->status == 3)
        Concluído
    @else
        Desconhecido
    @endif
</p>

<!-- Botão para atualizar o status do diploma -->
@if($diploma->status < 3)
    <form method="POST" action="{{ route('diplomas.atualizarStatus', $diploma->id) }}" style="display:inline;" onsubmit="return confirmUpdate();">
        @csrf
        <button type="submit" id="updateStatusButton">Atualizar Status</button>
    </form>
@endif

<!-- Alunos Relacionados -->
<h2>Alunos Relacionados</h2>

@if($alunosRelacionados->isEmpty())
    <p>Nenhum aluno associado a este diploma.</p>
@else
    <table>
        <thead>
            <tr>
                <th>ID do Aluno</th>
                <th>Nome do Aluno</th>
                <th>CPF do Aluno</th>
                <th>RG do Aluno</th>
                @if($diploma->status < 3) <!-- Exibe a coluna de Ações apenas se o status for menor que 3 -->
                    <th>Ações</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($alunosRelacionados as $relacao)
                <tr>
                    <td>{{ $relacao->aluno->id_aluno }}</td>
                    <td>{{ $relacao->aluno->nome }}</td>
                    <td>{{ $relacao->aluno->cpf_aluno }}</td>
                    <td>{{ $relacao->aluno->rg }}</td>
                    @if($diploma->status < 3) <!-- Apenas exibe o botão de Remover se o status for menor que 3 -->
                        <td>
                            <form method="POST" action="{{ route('diplomas.remover', $relacao->id) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Tem certeza que deseja remover este aluno do diploma?');">Remover</button>
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

<!-- Formulário para adicionar um aluno ao diploma -->
@if($diploma->status < 3) <!-- Exibe o formulário apenas se o status for menor que 3 -->
    <h2>Adicionar Aluno ao Diploma</h2>
    <form method="POST" action="{{ route('diplomas.associar', $diploma->id) }}">
        @csrf
        <div>
            <label for="aluno_id">Selecione um Aluno:</label>
            <select id="aluno_id" name="aluno_id" required>
                <option value="">Selecione um aluno</option>
                @foreach ($todosAlunos as $aluno)
                    <option value="{{ $aluno->id_aluno }}">{{ $aluno->nome }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <button type="submit">Adicionar Aluno</button>
        </div>
    </form>
@endif

<br>

<a href="{{ route('dashboard.rh.diplomas') }}">Voltar para a lista de diplomas</a>

<!-- Script para confirmar a atualização do status -->
<script>
function confirmUpdate() {
    return confirm('Tem certeza que deseja mudar o status deste diploma?');
}
</script> --}}
