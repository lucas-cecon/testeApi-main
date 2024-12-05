@php
    $alunosFiltrados = $alunosFiltrados ?? collect();
@endphp

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENAI - Dados do Diploma</title>
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

    <div class="flex flex-col items-center mb-10 bg-gray-100"> 
        @include('components.header', [
            'sectionTitle' => 'Secretaria',
            'pageTitle' => 'Diplomas',
            'logoUrl' => route('dashboard.rh')  // Defina a URL desejada
        ])

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

            <form id="filterForm" class="flex flex-col md:flex-row items-center justify-center mb-6">
    <input 
        type="text" 
        name="search" 
        class="block w-full md:w-1/1 p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" 
        placeholder="Buscar por Nome do Aluno ou CPF" 
        value="{{ request('search') }}"
    />
    <div class="flex gap-2 mt-4 md:mt-0 md:ml-4">
        <button 
            type="submit" 
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
            Filtrar
        </button>
    </div>
</form>

<ul id="alunosLista" class="rounded-lg p-4">
    <!-- A lista será populada aqui via AJAX -->
</ul>





        
        <div>
    <button type="button" id="addAlunoButton" class="btn btn-primary w-full border bg-red-500 hover:bg-red-700 text-white border-red-500 p-2 rounded-md">
        Adicionar Aluno
    </button>
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

<a href="{{ route('dashboard.rh.diplomas') }}" 
   class="inline-block mb-5 ml-5 bg-gray-200 text-red-500 font-bold px-6 py-2 rounded-md shadow-md hover:bg-gray-300 hover:text-red-700">
    Voltar para a lista de diplomas
</a>


    </div>
    



</body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    let alunoId = null;  // Variável para armazenar o ID do aluno selecionado

    // Quando um aluno for clicado
    $(document).on('click', '.aluno-item', function() {
        alunoId = $(this).data('id');  // Captura o ID do aluno
        console.log('Aluno selecionado: ', alunoId);  // Exibe o ID do aluno selecionado no console
    });

    // Quando o formulário de pesquisa for enviado
    $('#filterForm').on('submit', function(event) {
        event.preventDefault();  // Impede o envio tradicional do formulário

        let searchQuery = $("input[name='search']").val();  // Pega o valor do campo de busca

        // Envia a requisição AJAX para buscar os alunos
        $.ajax({
            url: '{{ route('alunos.pesquisar') }}',  // A rota para buscar alunos
            method: 'GET',
            data: { search: searchQuery },
            success: function(response) {
                // Limpa a lista de alunos antes de adicionar novos resultados
                $('#alunosLista').html('');

                if (response.length > 0) {
                    // Se houver alunos encontrados, adicione-os à lista
                    $.each(response, function(index, aluno) {
                        $('#alunosLista').append(`
                            <li class="p-2 border-b last:border-0 aluno-item" data-id="${aluno.id}">
                                <input type="checkbox" class="aluno-checkbox" data-id="${aluno.id}">
                                <strong>Nome:</strong> ${aluno.nome} <br>
                                <strong>CPF:</strong> ${aluno.cpf_aluno}
                            </li>
                        `);
                    });
                } else {
                    // Se não houver resultados, exiba uma mensagem
                    $('#alunosLista').html('<p class="text-gray-500">Nenhum aluno encontrado.</p>');
                }
            },
            error: function(xhr, status, error) {
                console.error('Erro na requisição AJAX:', error);
                alert('Erro na requisição AJAX');
            }
        });
    });

    // Quando o formulário de adicionar alunos for enviado
    $('#adicionarAlunoForm').on('submit', function(event) {
        event.preventDefault();  // Impede o envio tradicional do formulário

        // Coletar os IDs dos alunos selecionados
        let alunoIds = [];
        $('.aluno-checkbox:checked').each(function() {
            alunoIds.push($(this).data('id'));  // Adiciona o ID do aluno à lista
        });

        if (alunoIds.length === 0) {
            alert('Por favor, selecione pelo menos um aluno.');
            return;
        }

        console.log("Alunos selecionados:", alunoIds);  // Verifica os IDs dos alunos

        $.ajax({
            url: '{{ route('diplomas.associar', ['diplomaId' => $diploma->id]) }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                aluno_ids: alunoIds,  // Envia os IDs dos alunos
            },
            success: function(response) {
                console.log(response);  // Verifique a resposta no console
                alert(response.message);  // Exibe mensagem de sucesso
            },
            error: function(xhr, status, error) {
                console.error('Erro na requisição AJAX:', error);
                console.error('Detalhes da resposta:', xhr.responseText);  // Exibe resposta detalhada
                alert('Erro na requisição AJAX');
            }
        });
    });
});

</script>


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
