<form method="GET" action="{{ route('diplomas.pesquisa') }}" id="filterForm">
    <input type="text" name="search" placeholder="Buscar por Título do Diploma, Nome do Aluno, CPF ou RG" value="{{ request('search') }}">
    <button type="submit">Filtrar</button>
    <button type="button" onclick="document.getElementById('filterForm').reset(); window.location.href='{{ route('diplomas.pesquisa') }}';">Limpar</button>
</form>

<h1>Lista de Diplomas</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Título do Diploma</th>
            <th>Lote</th>
            <th>Quantidade</th>
            <th>Turma</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($diplomas as $diploma)
            <tr>
                <td>{{ $diploma->id }}</td>
                <td>{{ $diploma->titulo }}</td>
                <td>{{ $diploma->lote_diploma }}</td>
                <td>{{ $diploma->quant_diploma }}</td>
                <td>{{ $diploma->curso->curso }}</td>
                <td>
                    @if($diploma->status == 1)
                        Aberto
                    @elseif($diploma->status == 2)
                        Em andamento
                    @elseif($diploma->status == 3)
                        Concluído
                    @else
                        Desconhecido
                    @endif
                </td>
                <td>
                    <a href="{{ route('dashboard.rh.diplomas.show', $diploma->id) }}">Visualizar</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('diplomas.create') }}">
    <button>Criar Novo Diploma</button>
</a>


<a href="{{ route('dashboard.rh') }}">
    <button style="margin-bottom: 20px;">Voltar</button>
</a>
