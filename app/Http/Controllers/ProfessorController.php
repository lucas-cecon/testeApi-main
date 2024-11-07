<?php

namespace App\Http\Controllers;

use App\Models\ControleDePontoTicket;
use App\Models\StatusTicket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\BancoDeHoras;
use App\Models\Funcionario;

class ProfessorController extends Controller
{
    public function index()
    {
        // Obtém o ID do funcionário logado (usando session ou Auth)
        $funcionarioId = session('id_funcionario'); // ou Auth::user()->ID_funcionario, se estiver usando Auth

        // Filtra os tickets com base no funcionário logado, garantindo o carregamento correto de todos os relacionamentos
        $tickets = ControleDePontoTicket::where('ID_funcionario', $funcionarioId)
                    ->with(['horarioAntigo', 'horarioNovo', 'statusTicket'])
                    ->orderBy('created_at', 'desc')
                    ->get();

        // Retorna a view com os tickets filtrados
        return view('dashboard.professor.index', compact('tickets'));
    }

    public function showTicket($id)
    {
        // Busca o ticket pelo ID, garantindo o carregamento dos relacionamentos
        $ticket = ControleDePontoTicket::with(['horarioAntigo', 'horarioNovo', 'statusTicket', 'funcionario', 'gerente'])->findOrFail($id);

        // Retorna a view com os detalhes do ticket
        return view('dashboard.professor.show_ticket', compact('ticket'));
    }

    public function createTicket()
    {
        // Obtém o funcionário logado
        $funcionarioId = session('id_funcionario');
        $professor = Funcionario::find($funcionarioId);
    
        // Busca o último ticket do funcionário para pegar o último horário novo
        $ultimoTicket = ControleDePontoTicket::where('ID_funcionario', $funcionarioId)
                        ->orderBy('created_at', 'desc')
                        ->first();
    
        // Se houver um último ticket, use o último horário novo como horário antigo
        if ($ultimoTicket) {
            $horarioAtual = BancoDeHoras::find($ultimoTicket->horario_novo);
        } else {
            // Se não houver, usa o horário atual do professor
            $horarioAtual = BancoDeHoras::find($professor->horario);
        }
    
        // Recupera todos os horários disponíveis para troca e gestores
        $horarios = BancoDeHoras::all();
        $gestores = Funcionario::where('cargo', 3)->get();
    
        return view('dashboard.professor.create_ticket', [
            'horarioAtual' => $horarioAtual,
            'horarios' => $horarios,
            'gestores' => $gestores
        ]);
    }

    public function storeTicket(Request $request)
    {
        // Obtém o ID do funcionário logado pela sessão
        $funcionarioId = session('id_funcionario');
        
        // Verifica se o funcionário está logado
        if (!$funcionarioId) {
            return redirect()->route('login')->with('error', 'Você precisa estar logado para criar um ticket.');
        }
    
        // Validação dos dados do formulário
        $request->validate([
            'horario_novo' => 'required|exists:banco_de_horas,id',
            'descricao' => 'nullable|string',
            'gestor_responsavel' => 'required|exists:funcionarios,ID_funcionario',
            'data_inicio' => 'required|date', // Valida data_inicio como obrigatório
            'data_fim' => 'nullable|date|after_or_equal:data_inicio', // data_fim opcional e deve ser após data_inicio
        ]);
    
        // Busca o último ticket do funcionário para definir o horário antigo
        $ultimoTicket = ControleDePontoTicket::where('ID_funcionario', $funcionarioId)
                        ->orderBy('created_at', 'desc')
                        ->first();
    
        // Define o horário antigo com base no último ticket ou no valor enviado no formulário
        $horarioAntigo = $ultimoTicket ? $ultimoTicket->horario_novo : $request->input('horario_antigo');
    
        // Criação do novo ticket com data_inicio e data_fim
        ControleDePontoTicket::create([
            'ID_funcionario' => $funcionarioId,
            'gerente_ID' => $request->input('gestor_responsavel'),
            'horario_antigo' => $horarioAntigo,
            'horario_novo' => $request->input('horario_novo'),
            'descricao' => $request->input('descricao'),
            'status_ticket' => 1, // Status 1 = "aberto"
            'data_inicio' => $request->input('data_inicio'), // Define data de início
            'data_fim' => $request->input('data_fim') // Define data de fim, caso tenha sido preenchida
        ]);
    
        // Redireciona com uma mensagem de sucesso
        return redirect()->route('dashboard.professor')->with('success', 'Solicitação criada com sucesso!');
    }
    
    
    
    
}
