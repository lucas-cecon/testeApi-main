<?php

namespace App\Http\Controllers;

use App\Models\ControleDePontoTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RHController extends Controller
{
    // Método para exibir o dashboard do RH
    public function index()
    {
        // Obtém o ID do funcionário logado (usando session ou Auth)
        $funcionarioId = session('id_funcionario'); // ou Auth::user()->ID_funcionario, se estiver usando Auth

        $tickets = ControleDePontoTicket::whereIn('status_ticket', [2, 3, 4]) // Filtrando os tickets com os status 2, 3 e 4
        ->with(['funcionario', 'horarioAntigo', 'horarioNovo'])
        ->get();

        return view('dashboard.rh.index', compact('tickets'));
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

        return redirect()->route('dashboard.rh')->with('success', 'Pedido aprovado com sucesso!');
    }

    // Método para rejeitar um pedido
    public function rejeitarTicket($id)
    {
        $ticket = ControleDePontoTicket::findOrFail($id);
        $ticket->status_ticket = 4; // Supondo que 4 é o status de "Rejeitado"
        $ticket->save();

        return redirect()->route('dashboard.rh')->with('success', 'Pedido rejeitado com sucesso!');
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
}
