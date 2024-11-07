<?php

namespace App\Http\Controllers;

use App\Models\ControleDePontoTicket;
use App\Models\Funcionario;
use App\Models\StatusTicket;
use Illuminate\Http\Request;

class ControleDePontoTicketController extends Controller
{
    // Método para exibir todos os tickets
    public function index()
    {
        $tickets = ControleDePontoTicket::with(['funcionario', 'gerente', 'horarioAntigo', 'horarioNovo', 'status'])->get();
        return view('dashboard.professor.index', compact('tickets'));
    }

    // Método para criar um novo ticket
    public function create()
    {
        // Carrega os funcionários e os horários para o formulário de criação
        $funcionarios = Funcionario::all();
        $horarios = BancoDeHoras::all();
        return view('controle_de_ponto.create', compact('funcionarios', 'horarios'));
    }

    // Método para armazenar um novo ticket no banco de dados
    public function store(Request $request)
    {
        // Valida os dados do formulário
        $validatedData = $request->validate([
            'ID_funcionario' => 'required|exists:funcionarios,ID_funcionario',
            'gerente_ID' => 'required|exists:funcionarios,ID_funcionario',
            'horario_antigo' => 'required|exists:banco_de_horas,id',
            'horario_novo' => 'required|exists:banco_de_horas,id',
            'descricao' => 'nullable|string',
            'status_ticket' => 'required|exists:status_ticket,id',
        ]);

        // Cria um novo ticket com os dados validados
        ControleDePontoTicket::create($validatedData);

        // Redireciona para a lista de tickets com uma mensagem de sucesso
        return redirect()->route('controle_de_ponto.index')->with('success', 'Ticket criado com sucesso.');
    }

    // Método para exibir os detalhes de um ticket específico
    public function show($id)
    {
        $ticket = ControleDePontoTicket::with(['funcionario', 'gerente', 'horarioAntigo', 'horarioNovo', 'status'])->findOrFail($id);
        return view('controle_de_ponto.show', compact('ticket'));
    }

    // Método para exibir o formulário de edição de um ticket
    public function edit($id)
    {
        $ticket = ControleDePontoTicket::findOrFail($id);
        $funcionarios = Funcionario::all();
        $horarios = BancoDeHoras::all();
        $statusTickets = StatusTicket::all();

        return view('controle_de_ponto.edit', compact('ticket', 'funcionarios', 'horarios', 'statusTickets'));
    }

    // Método para atualizar um ticket no banco de dados
    public function update(Request $request, $id)
    {
        // Valida os dados do formulário
        $validatedData = $request->validate([
            'ID_funcionario' => 'required|exists:funcionarios,ID_funcionario',
            'gerente_ID' => 'required|exists:funcionarios,ID_funcionario',
            'horario_antigo' => 'required|exists:banco_de_horas,id',
            'horario_novo' => 'required|exists:banco_de_horas,id',
            'descricao' => 'nullable|string',
            'status_ticket' => 'required|exists:status_ticket,id',
        ]);

        // Encontra o ticket pelo ID e atualiza seus dados
        $ticket = ControleDePontoTicket::findOrFail($id);
        $ticket->update($validatedData);

        // Redireciona para a lista de tickets com uma mensagem de sucesso
        return redirect()->route('controle_de_ponto.index')->with('success', 'Ticket atualizado com sucesso.');
    }

    // Método para deletar um ticket do banco de dados
    public function destroy($id)
    {
        $ticket = ControleDePontoTicket::findOrFail($id);
        $ticket->delete();

        return redirect()->route('controle_de_ponto.index')->with('success', 'Ticket excluído com sucesso.');
    }
}
