<?php

namespace App\Http\Controllers;

use App\Models\ControleDePontoTicket;
use Illuminate\Http\Request;
use App\Models\Funcionario;
use Illuminate\Support\Facades\Auth;
use App\Models\CargoFuncionario;
use App\Models\BancoDeHoras;
use App\Models\Aluno;
use App\Models\Curso;
use App\Models\StatusAluno;
use App\Models\ApmStatus;


class GestorController extends Controller
{
    // Método para exibir o dashboard do Gestor
    public function index(Request $request)
    {
        // Obter o valor da busca
        $search = $request->input('search');

        // Consultar os pedidos, aplicando filtro se houver busca
        $tickets = ControleDePontoTicket::when($search, function ($query, $search) {
            $query->whereHas('funcionario', function ($query) use ($search) {
                $query->where('nome', 'like', '%' . $search . '%');
            });
        })->get();

        // Retornar a view com os tickets filtrados
        return view('dashboard.gestor.index', compact('tickets'));
    }

    // Função que lista todos os tickets vinculados ao gestor logado
    public function listarTickets()
    {
        // Obtém o ID do gestor logado a partir da sessão
        $gestorId = session('id_funcionario');

        // Busca os tickets vinculados ao gestor logado
        $tickets = ControleDePontoTicket::where('gerente_ID', $gestorId)
            ->with(['horarioAntigo', 'horarioNovo', 'statusTicket', 'funcionario'])
            ->get();

        return response()->json($tickets); // Retorna os tickets como JSON
    }

    // Função que aprova um ticket
    public function aprovarTicket($id)
    {
        $ticket = ControleDePontoTicket::findOrFail($id);
        $ticket->status_ticket = 2; // Supondo que 2 é o status de "aprovado"
        $ticket->save();

        return redirect()->route('dashboard.gestor')->with('success', 'Ticket aprovado com sucesso!');
    }

    // Função que rejeita um ticket
    public function rejeitarTicket($id)
    {
        $ticket = ControleDePontoTicket::findOrFail($id);
        $ticket->status_ticket = 4; // Supondo que 4 é o status de "rejeitado"
        $ticket->save();

        return redirect()->route('dashboard.gestor')->with('error', 'Ticket rejeitado com sucesso!');
    }

    // Função que exibe detalhes de um ticket
    public function detalharTicket($id)
    {
        $ticket = ControleDePontoTicket::with(['horarioAntigo', 'horarioNovo', 'statusTicket', 'funcionario', 'gerente'])->findOrFail($id);

        // Retorna a view com os dados do ticket
        return view('dashboard.gestor.detalhes_ticket', compact('ticket'));
    }



    // Função para mostrar a lista de alunos
    public function mostrarAlunos(Request $request)
    {
    // Define a query inicial para incluir os relacionamentos necessários
    $query = Aluno::with(['curso', 'statusAluno', 'apmStatus']);

    // // Verifica se há um parâmetro de busca
    // if ($request->has('search')) {
    //     $search = $request->input('search');
    //     $query->where('nome', 'LIKE', "%$search%")
    //           ->orWhere('cpf_aluno', 'LIKE', "%$search%")
    //           ->orWhere('rg', 'LIKE', "%$search%")
    //           ->orWhere('n_matricula', 'LIKE', "%$search%");
    // }

    // Obtém os resultados com base na query final
    $alunos = $query->get();

    // Substitui o ID pelo objeto relacionado de curso, statusAluno, e apmStatus
    foreach ($alunos as $aluno) {
        $aluno->curso = Curso::find($aluno->curso);
        $aluno->statusAluno = StatusAluno::find($aluno->status_aluno);
        $aluno->apmStatus = ApmStatus::find($aluno->apm_status);
    }

    // Se a requisição espera JSON, retorna os alunos em formato JSON
    if ($request->expectsJson()) {
        return response()->json($alunos, 200);
    }

    // Retorna a view 'dashboard.gestor.alunos' com os alunos carregados
    return view('dashboard.gestor.alunos', compact('alunos'));
    }

    public function pesquisaAluno(Request $request)
    {
        // Obter o valor da busca
        $search = $request->input('search');

        // Consultar os alunos, aplicando filtro se houver busca
        $alunos = Aluno::when($search, function ($query, $search) {
            $query->where('nome', 'like', '%' . $search . '%')
            ->orWhere('cpf_aluno', 'LIKE', "%$search%")
            ->orWhere('rg', 'LIKE', "%$search%")
            ->orWhere('n_matricula', 'LIKE', "%$search%")
            ->orWhere('email', 'LIKE', "%$search%");

        })->get();


    foreach ($alunos as $aluno) {
        $aluno->curso = Curso::find($aluno->curso);
        $aluno->statusAluno = StatusAluno::find($aluno->status_aluno);
        $aluno->apmStatus = ApmStatus::find($aluno->apm_status);
    }

        // Retornar a view com os alunos filtrados
        return view('dashboard.gestor.alunos', compact('alunos'));
    }

    // Exibir formulário de criação de aluno
    public function showCriarAlunoForm()
    {
        $cursos = Curso::all();
        $statusAlunos = StatusAluno::all();
        $apmStatus = ApmStatus::all();

        return view('dashboard.gestor.criar_aluno', compact('cursos', 'statusAlunos', 'apmStatus'));
    }

    // Armazenar um novo aluno
    public function armazenarAluno(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf_aluno' => 'required|string|max:14',
            'rg' => 'required|string|max:20',
            'n_matricula' => 'required|string|max:20',
            'curso' => 'required|exists:cursos,id',
            'status_aluno_id' => 'required|exists:status_alunos,id',
            'apm_status_id' => 'required|exists:apm_status,id',
            'email' => 'required|email|max:255',
        ]);

        Aluno::create([
            'nome' => $request->nome,
            'cpf_aluno' => $request->cpf_aluno,
            'rg' => $request->rg,
            'n_matricula' => $request->n_matricula,
            'curso' => $request->curso,
            'status_aluno' => $request->status_aluno_id,
            'apm_status' => $request->apm_status_id,
            'email' => $request->email,
        ]);

        return redirect()->route('dashboard.gestor.alunos')->with('success', 'Aluno criado com sucesso!');
    }

    // Exibir formulário de edição de aluno
    public function showEditarAlunoForm($id)
    {
        $aluno = Aluno::findOrFail($id);
        $cursos = Curso::all();
        $statusAlunos = StatusAluno::all();
        $apmStatus = ApmStatus::all();

        return view('dashboard.gestor.editar_aluno', compact('aluno', 'cursos', 'statusAlunos', 'apmStatus'));
    }

    // Atualizar dados do aluno
    public function atualizarAluno(Request $request, $id)
    {
        $aluno = Aluno::findOrFail($id);
        $aluno->update($request->all());

        return redirect()->route('dashboard.gestor.alunos')->with('success', 'Aluno atualizado com sucesso!');
    }

    // Deletar um aluno
    public function deletarAluno($id)
    {
        $aluno = Aluno::findOrFail($id);
        $aluno->delete();

        return redirect()->route('dashboard.gestor.alunos')->with('success', 'Aluno deletado com sucesso!');
    }

    // Exibir detalhes do aluno
    public function showAluno($id)
    {
        $aluno = Aluno::with(['curso', 'statusAluno', 'apmStatus'])->findOrFail($id);

        return view('dashboard.gestor.detalhes_aluno', compact('aluno'));
    }

}
