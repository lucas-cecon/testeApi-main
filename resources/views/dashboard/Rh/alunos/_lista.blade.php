@if ($alunosFiltrados->isNotEmpty())
    <ul class="bg-white border border-gray-300 rounded-lg p-4">
        @foreach ($alunosFiltrados as $aluno)
            <li class="p-2 border-b last:border-0">
                <strong>Nome:</strong> {{ $aluno->nome }}<br>
                <strong>CPF:</strong> {{ $aluno->cpf }}
            </li>
        @endforeach
    </ul>
@else
    <p class="text-gray-500">Nenhum aluno encontrado.</p>
@endif
