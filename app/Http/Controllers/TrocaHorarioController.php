<?php

namespace App\Http\Controllers;

use App\Models\ControleDePontoTicket;
use App\Models\Funcionario;
use App\Models\StatusTicket;
use Illuminate\Http\Request;

class TrocaHorarioController extends Controller
{
    // Função para listar todas as solicitações de troca de horário
    public function listarSolicitacoes()
    {
        // Carrega as solicitações de troca de horário com os dados do funcionário e o status
        $solicitacoes = ControleDePontoTicket::with(['funcionario', 'statusTicket'])->get();

        return view('solicitacoes.listar', compact('solicitacoes'));
    }

    // Função para exibir o formulário de criação de uma nova solicitação de troca de horário
    public function showSolicitarForm()
    {
        return view('solicitacoes.solicitar');
    }

    // Função para processar a solicitação de troca de horário
    public function solicitarTrocaHorario(Request $request)
    {
        // Validação dos dados
        $validatedData = $request->validate([
            'horario_antigo' => 'required|string',
            'horario_novo' => 'required|date',
            'descricao' => 'required|string',
        ]);

        // Criar a nova solicitação de troca de horário
        $solicitacao = new ControleDePontoTicket();
        $solicitacao->ID_funcionario = auth()->user()->id; // Exemplo, obtenha o ID do professor logado
        $solicitacao->horario_antigo = $request->input('horario_antigo');
        $solicitacao->horario_novo = $request->input('horario_novo');
        $solicitacao->descricao = $request->input('descricao');
        $solicitacao->status_ticket = 1; // Status 1 = Aberto (chegou no gestor)
        $solicitacao->save();

        return redirect()->route('dashboard.professor')->with('success', 'Solicitação enviada com sucesso.');
    }

    // Função para atualizar o status da solicitação de troca de horário
    public function atualizarStatus($id, Request $request)
    {
        // Validação dos dados de status
        $validatedData = $request->validate([
            'status_ticket' => 'required|in:1,2,3,4', // Status 1 a 4 conforme os estados
        ]);

        // Encontra a solicitação
        $solicitacao = ControleDePontoTicket::findOrFail($id);
        $solicitacao->status_ticket = $request->input('status_ticket');
        $solicitacao->save();

        return redirect()->back()->with('success', 'Status atualizado com sucesso.');
    }
}
