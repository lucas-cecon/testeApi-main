<?php

namespace App\Http\Controllers;

use App\Models\ControleDePontoTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Aluno;

class RHController extends Controller
{
    // Método para exibir o dashboard do RH
    public function index()
    {
        // Obtém o ID do funcionário logado (usando session ou Auth)
        $funcionarioId = session('id_funcionario'); // ou Auth::user()->ID_funcionario, se estiver usando Auth

        return view('dashboard.rh.index');
    }

        public function pedidos()
    {
        // Obtém o ID do funcionário logado (usando session ou Auth)
        $funcionarioId = session('id_funcionario'); // ou Auth::user()->ID_funcionario, se estiver usando Auth

        $tickets = ControleDePontoTicket::whereIn('status_ticket', [2, 3, 4]) // Filtrando os tickets com os status 2, 3 e 4
        ->with(['funcionario', 'horarioAntigo', 'horarioNovo'])
        ->get();

        return view('dashboard.rh.pedidos', compact('tickets'));
    }


    public function pesquisar(Request $request)
    {
        // Obter o valor de busca
        $search = $request->input('search');
    
        // Consultar os tickets, aplicando filtro se houver busca
        $tickets = ControleDePontoTicket::when($search, function ($query, $search) {
            $query->whereHas('funcionario', function ($q) use ($search) {
                $q->where('nome', 'like', '%' . $search . '%');
            });
        })->get();
    
        // Retornar a view com os tickets filtrados
        return view('dashboard.rh.index', compact('tickets'));
    }
    


    // Método para aprovar um pedido
    public function aprovarTicket($id)
    {
        $ticket = ControleDePontoTicket::findOrFail($id);
        $ticket->status_ticket = 3; // Supondo que 3 é o status de "Aprovado"
        $ticket->save();

        return redirect()->route('dashboard.rh.pedidos')->with('success', 'Pedido aprovado com sucesso!');
    }

    // Método para rejeitar um pedido
    public function rejeitarTicket($id)
    {
        $ticket = ControleDePontoTicket::findOrFail($id);
        $ticket->status_ticket = 4; // Supondo que 4 é o status de "Rejeitado"
        $ticket->save();

        return redirect()->route('dashboard.rh.pedidos')->with('success', 'Pedido rejeitado com sucesso!');
    }

    // Método para exibir detalhes de um ticket
    public function showTicket($id)
    {
        // Buscando o ticket pelo ID
        $ticket = ControleDePontoTicket::with(['funcionario', 'horarioAntigo', 'horarioNovo', 'statusTicket'])
            ->findOrFail($id);

        // Retornando a view com os detalhes do ticket
        return view('dashboard.rh.analizar_solicitacoes', compact('ticket')); // Mantenha ou altere o nome da view conforme necessário
    }


public function pesquisarAlunos(Request $request)
{
    $request->validate([
        'search' => 'nullable|string|max:255', // Garante que a pesquisa seja uma string válida
    ]);

    $query = $request->input('search');

    if ($query) {
        $alunosFiltrados = Aluno::where(function($queryBuilder) use ($query) {
            $queryBuilder->where('nome', 'LIKE', "%{$query}%")
                         ->orWhere('cpf_aluno', 'LIKE', "%{$query}%");
        })->get();

        return response()->json($alunosFiltrados);
    }

    return response()->json([]);
}

public function pesquisaluno(Request $request)
    {
        // Obter o valor da busca
        $search = $request->input('search');

        // Consultar os alunos, aplicando filtro se houver busca
        $alunos = Aluno::when($search, function ($query, $search) {
            $query->where('nome', 'like', '%' . $search . '%')
            ->orWhere('cpf_aluno', 'LIKE', "%$search%") ;
        })->get();


        // Retornar a view com os alunos filtrados
        return view('dashboard.rh.apm', compact('alunos'));
    }

}
