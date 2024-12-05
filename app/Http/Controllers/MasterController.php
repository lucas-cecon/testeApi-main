<?php

namespace App\Http\Controllers;

use App\Models\ControleDePontoTicket;
use App\Models\StatusTicket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\BancoDeHoras;
use App\Models\Funcionario;
use App\Models\Aluno;
use App\Models\Curso;
use App\Models\StatusAluno;
use App\Models\ApmStatus;
use App\Models\CargoFuncionario;

class MasterController extends Controller
{

     public function listarFuncionarios(Request $request)
    {
        $query = Funcionario::with(['cargo', 'horario']);
    
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nome', 'LIKE', "%$search%")
                  ->orWhere('cpf', 'LIKE', "%$search%");
        }
    
        $funcionarios = $query->get();
    
        // Substitui o ID pelos objetos relacionados de cargo e horário
        foreach ($funcionarios as $funcionario) {
            $funcionario->cargo = CargoFuncionario::find($funcionario->cargo);
            $funcionario->horario = BancoDeHoras::find($funcionario->horario);
        }

        // Se a requisição espera JSON, retorna os funcionários em formato JSON
        if ($request->expectsJson()) {
            return response()->json($funcionarios, 200);
        }

        return view('dashboard.master.funcionario', compact('funcionarios'));
    }

    public function adicionarFuncionario(Request $request)
    {
        // Validação dos campos
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|size:11|unique:funcionarios,cpf', // CPF único e com 11 dígitos
            'nif' => 'required|string|max:9', // NIF com no máximo 9 caracteres
            'cargo' => 'required|exists:cargo_funcionarios,id', // O cargo deve existir na tabela cargo_funcionarios
            'horario' => 'required|exists:banco_de_horas,id', // O horário deve existir na tabela banco_de_horas
            'senha' => 'required|string|min:6|confirmed', // Senha confirmada
        ], [
            'cpf.unique' => 'O CPF já está cadastrado.',
            'nif.max' => 'O NIF deve ter no máximo 10 caracteres.',
            'senha.confirmed' => 'A confirmação de senha não corresponde.',
            'senha.min' => 'A senha deve ter no mínimo 6 caracteres.',
        ]);

        try {
            $funcionario = new Funcionario();
            $funcionario->nome = $request->input('nome');
            $funcionario->cpf = $request->input('cpf');
            $funcionario->nif = $request->input('nif');
            $funcionario->cargo = $request->input('cargo');  // Usando 'cargo'
            $funcionario->horario = $request->input('horario'); // Usando 'horario'
            $funcionario->senha = bcrypt($request->input('senha'));
            $funcionario->save();

            // Se a requisição espera JSON, retorna uma resposta de sucesso em formato JSON
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Funcionário cadastrado com sucesso!'], 201);
            }

            return redirect()->route('dashboard.master.funcionario')->with('success', 'Funcionário cadastrado com sucesso!');
        } catch (\Exception $e) {
            // Se a requisição espera JSON, retorna um erro em formato JSON
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Erro ao cadastrar funcionário.'], 400);
            }

            return redirect()->back()->with('error', 'Ocorreu um erro ao cadastrar o funcionário.');
        }
    }

    public function cadastrarFuncionario()
    {
        $cargos = CargoFuncionario::all(); // Obtém todos os cargos da tabela cargo_funcionarios
        $horarios = BancoDeHoras::all(); // Obtém todos os horários da tabela banco_de_horas
        return view('dashboard.master.cadastrar_funcionario', compact('cargos', 'horarios'));
    }

    public function atualizarFuncionario(Request $request, $id)
    {
        // Validação dos campos
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|size:11|unique:funcionarios,cpf,' . $id . ',ID_funcionario', // CPF único, exceto para o próprio funcionário
            'nif' => 'required|string|max:9', // NIF com no máximo 9 caracteres
            'cargo' => 'required|exists:cargo_funcionarios,id', // O cargo deve existir na tabela cargo_funcionarios
            'horario' => 'required|exists:banco_de_horas,id', // O horário deve existir na tabela banco_de_horas
            'senha' => 'nullable|string|min:6|confirmed', // Senha confirmada, mas opcional
        ], [
            'cpf.unique' => 'O CPF já está cadastrado.',
            'nif.max' => 'O NIF deve ter no máximo 9 caracteres.',
            'senha.confirmed' => 'A confirmação de senha não corresponde.',
            'senha.min' => 'A senha deve ter no mínimo 6 caracteres.',
        ]);

        try {
            $funcionario = Funcionario::findOrFail($id);  // Garante que está usando o id correto
            $funcionario->nome = $request->input('nome');
            $funcionario->cpf = $request->input('cpf');
            $funcionario->nif = $request->input('nif');
            $funcionario->cargo = $request->input('cargo');
            $funcionario->horario = $request->input('horario');

            if ($request->filled('senha')) {
                $funcionario->senha = bcrypt($request->input('senha'));
            }

            $funcionario->save();

            // Se a requisição espera JSON, retorna uma resposta de sucesso em formato JSON
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Funcionário atualizado com sucesso!'], 200);
            }

            return redirect()->route('dashboard.master.funcionario')->with('success', 'Funcionário atualizado com sucesso!');
        } catch (\Exception $e) {
            // Se a requisição espera JSON, retorna um erro em formato JSON
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Erro ao atualizar funcionário.'], 400);
            }

            return redirect()->back()->with('error', 'Erro ao atualizar funcionário.');
        }
    }

     public function deletarFuncionario($id)
    {
        try {
            $funcionario = Funcionario::findOrFail($id); // Verifica se o funcionário existe
            $funcionario->delete(); // Exclui o funcionário

            // Se a requisição espera JSON, retorna uma resposta de sucesso em formato JSON
            if (request()->expectsJson()) {
                return response()->json(['message' => 'Funcionário excluído com sucesso!'], 200);
            }

            return redirect()->route('funcionarios.listar')->with('success', 'Funcionário excluído com sucesso!');
        } catch (\Exception $e) {
            // Se a requisição espera JSON, retorna um erro em formato JSON
            if (request()->expectsJson()) {
                return response()->json(['error' => 'Erro ao excluir funcionário.'], 400);
            }

            return redirect()->route('dashboard.master.funcionario')->with('error', 'Erro ao excluir funcionário.');
        }
    }

    public function showEditarForm($id)
    {
        $funcionario = Funcionario::findOrFail($id);
        $cargos = CargoFuncionario::all();
        $horarios = BancoDeHoras::all();
        return view('dashboard.master.editar_funcionario', compact('funcionario', 'cargos', 'horarios'));
    }

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
        return view('dashboard.master.index', compact('tickets'));
    }

    public function showTicket($id)
    {
        // Busca o ticket pelo ID, garantindo o carregamento dos relacionamentos
        $ticket = ControleDePontoTicket::with(['horarioAntigo', 'horarioNovo', 'statusTicket', 'funcionario', 'gerente'])->findOrFail($id);

        // Retorna a view com os detalhes do ticket
        return view('dashboard.master.show_ticket', compact('ticket'));
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
    
        // Recupera todos os horários disponíveis para troca e masteres
        $horarios = BancoDeHoras::all();
        $masteres = Funcionario::where('cargo', 3)->get();
    
        return view('dashboard.master.create_ticket', [
            'horarioAtual' => $horarioAtual,
            'horarios' => $horarios,
            'masteres' => $masteres
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
            'master_responsavel' => 'required|exists:funcionarios,ID_funcionario',
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
            'gerente_ID' => $request->input('master_responsavel'),
            'horario_antigo' => $horarioAntigo,
            'horario_novo' => $request->input('horario_novo'),
            'descricao' => $request->input('descricao'),
            'status_ticket' => 1, // Status 1 = "aberto"
            'data_inicio' => $request->input('data_inicio'), // Define data de início
            'data_fim' => $request->input('data_fim') // Define data de fim, caso tenha sido preenchida
        ]);
    
        // Redireciona com uma mensagem de sucesso
        return redirect()->route('dashboard.master')->with('success', 'Solicitação criada com sucesso!');
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

    // Retorna a view 'dashboard.master.alunos' com os alunos carregados
    return view('dashboard.master.alunos', compact('alunos'));
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
        return view('dashboard.master.alunos', compact('alunos'));
    }

    // Exibir formulário de criação de aluno
    public function showCriarAlunoForm()
    {
        $cursos = Curso::all();
        $statusAlunos = StatusAluno::all();
        $apmStatus = ApmStatus::all();

        return view('dashboard.master.criar_aluno', compact('cursos', 'statusAlunos', 'apmStatus'));
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

        return redirect()->route('dashboard.master.alunos')->with('success', 'Aluno criado com sucesso!');
    }

    // Exibir formulário de edição de aluno
    public function showEditarAlunoForm($id)
    {
        $aluno = Aluno::findOrFail($id);
        $cursos = Curso::all();
        $statusAlunos = StatusAluno::all();
        $apmStatus = ApmStatus::all();

        return view('dashboard.master.editar_aluno', compact('aluno', 'cursos', 'statusAlunos', 'apmStatus'));
    }

    // Atualizar dados do aluno
    public function atualizarAluno(Request $request, $id)
    {
        $aluno = Aluno::findOrFail($id);
        $aluno->update($request->all());

        return redirect()->route('dashboard.master.alunos')->with('success', 'Aluno atualizado com sucesso!');
    }

    // Deletar um aluno
    public function deletarAluno($id)
    {
        $aluno = Aluno::findOrFail($id);
        $aluno->delete();

        return redirect()->route('dashboard.master.alunos')->with('success', 'Aluno deletado com sucesso!');
    }

    // Exibir detalhes do aluno
    public function showAluno($id)
    {
        $aluno = Aluno::with(['curso', 'statusAluno', 'apmStatus'])->findOrFail($id);

        return view('dashboard.master.detalhes_aluno', compact('aluno'));
    }

}