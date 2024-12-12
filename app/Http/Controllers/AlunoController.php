<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Curso; // Importando o modelo Curso
use App\Models\StatusAluno; // Importando o modelo StatusAluno
use App\Models\ApmStatus; // Importando o modelo ApmStatus
use Illuminate\Http\Request; // Importando a classe Request

class AlunoController extends Controller
{
    public function index(Request $request)
    {
        $query = Aluno::with(['curso', 'statusAluno', 'apmStatus']);

        if ($request->has('search')) {
            $search = $request->input('search');
            $query
                ->where('nome', 'LIKE', "%$search%")
                ->orWhere('cpf_aluno', 'LIKE', "%$search%")
                ->orWhere('rg', 'LIKE', "%$search%")
                ->orWhere('n_matricula', 'LIKE', "%$search%");
        }

        $alunos = $query->get();

        foreach ($alunos as $aluno) {
            $aluno->curso = Curso::find($aluno->curso);
            $aluno->statusAluno = StatusAluno::find($aluno->status_aluno);
            $aluno->apmStatus = ApmStatus::find($aluno->apm_status);
        }

        return view('alunos', compact('alunos'));
    }

    public function listar(Request $request)
    {
        $query = Aluno::with(['curso', 'statusAluno', 'apmStatus']);

        if ($request->has('search')) {
            $search = $request->input('search');
            $query
                ->where('nome', 'LIKE', "%$search%")
                ->orWhere('cpf_aluno', 'LIKE', "%$search%")
                ->orWhere('rg', 'LIKE', "%$search%")
                ->orWhere('n_matricula', 'LIKE', "%$search%");
        }

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

        return view('alunos', compact('alunos'));
    }

    public function showCriarForm()
    {
        // Você pode carregar cursos, status, etc. para o formulário
        $cursos = Curso::all();
        $statusAlunos = StatusAluno::all();
        $apmStatus = ApmStatus::all();

        return view('criar_aluno', compact('cursos', 'statusAlunos', 'apmStatus'));
    }

    public function armazenar(Request $request)
    {
        // Validação dos dados do formulário
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

        // Criação do aluno
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

        // Listar todos os alunos com busca
        $query = Aluno::with(['curso', 'statusAluno', 'apmStatus']);

        // Buscar todos os alunos
        $alunos = $query->get();

        // Redirecionar com os dados
        return redirect()
            ->route('alunos.listar')
            ->with(['success' => 'Aluno criado com sucesso!', 'alunos' => $alunos]);
    }

    public function showEditarForm($id)
    {
        $aluno = Aluno::findOrFail($id);
        $cursos = Curso::all(); // Cursos disponíveis
        $statusAlunos = StatusAluno::all(); // Status disponíveis
        $apmStatus = ApmStatus::all(); // APMs disponíveis, se necessário

        return view('editar_aluno', compact('aluno', 'cursos', 'statusAlunos', 'apmStatus'));
    }

    // Atualizar os dados do aluno
    public function atualizar(Request $request, $id)
    {
        $aluno = Aluno::findOrFail($id);
        $aluno->update($request->all());
        return redirect()->route('alunos.listar')->with('success', 'Aluno atualizado com sucesso!');
    }

    // Deletar um aluno
    public function deletar($id)
    {
        $aluno = Aluno::findOrFail($id);
        $aluno->delete();
        return redirect()->route('alunos.listar')->with('success', 'Aluno deletado com sucesso!');
    }

    public function show($id)
    {
        // Tenta encontrar um aluno com o ID fornecido
        $aluno = Aluno::with(['curso', 'statusAluno', 'apmStatus'])->find($id);

        // Verifica se o aluno foi encontrado
        if (!$aluno) {
            return redirect()->route('alunos.index')->with('error', 'Aluno não encontrado.');
        }

        // Aqui você pode obter as informações das relações, se necessário
        $aluno->curso = Curso::find($aluno->curso);
        $aluno->statusAluno = StatusAluno::find($aluno->status_aluno);
        $aluno->apmStatus = ApmStatus::find($aluno->apm_status);

        return view('detalhes_aluno', compact('aluno'));
    }

    public function exibirApm()
    {
        // Busca os alunos com os dados necessários
        $alunos = Aluno::select('id_aluno', 'nome', 'cpf_aluno', 'apm_status')->with('apmStatus')->get();

        return view('dashboard.rh.apm', compact('alunos'));
    }

    public function visualizarAluno($id)
    {
        $aluno = Aluno::with(['curso', 'statusAluno', 'apmStatus'])->find($id);

        $aluno->curso = Curso::find($aluno->curso);
        $aluno->statusAluno = StatusAluno::find($aluno->status_aluno);
        $aluno->apmStatus = ApmStatus::find($aluno->apm_status);

        if (!$aluno) {
            return redirect()->route('dashboard.rh.apm')->with('error', 'Aluno não encontrado.');
        }

        return view('dashboard.rh.visualizar_aluno', compact('aluno'));
    }

    public function editarAluno($id)
    {
        $aluno = Aluno::with(['curso', 'statusAluno', 'apmStatus'])->find($id);

        if (!$aluno) {
            return redirect()->route('dashboard.rh.apm')->with('error', 'Aluno não encontrado.');
        }

        // Substituir os IDs pelos objetos relacionados
        $aluno->curso = Curso::find($aluno->curso);
        $aluno->statusAluno = StatusAluno::find($aluno->status_aluno);
        $aluno->apmStatus = ApmStatus::find($aluno->apm_status);

        // Obter as listas necessárias
        $cursos = Curso::all();
        $statusAlunos = StatusAluno::all();
        $apmStatuses = ApmStatus::all();

        return view('dashboard.rh.editar_aluno', compact('aluno', 'cursos', 'statusAlunos', 'apmStatuses'));
    }

    public function atualizarAluno(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf_aluno' => 'required|string|max:11',
            'rg' => 'nullable|string|max:20',
            'n_matricula' => 'required|string|max:20',
            'email' => 'required|email',
            'curso' => 'required|exists:cursos,id',
            'status_aluno' => 'required|exists:status_alunos,id',
            'apm_status' => 'required|exists:apm_status,id',
        ]);

        // Tente encontrar o aluno pelo ID
        $aluno = Aluno::find($id);

        // Se o aluno não for encontrado, redirecione para a página de erro ou lista
        if (!$aluno) {
            return redirect()->route('dashboard.rh.apm')->with('error', 'Aluno não encontrado.');
        }

        // Atualizar os dados do aluno
        $aluno->nome = $request->nome;
        $aluno->cpf_aluno = $request->cpf_aluno;
        $aluno->rg = $request->rg;
        $aluno->n_matricula = $request->n_matricula;
        $aluno->email = $request->email;
        $aluno->curso = $request->curso; // Atualizando a relação com o curso
        $aluno->status_aluno = $request->status_aluno; // Atualizando o status
        $aluno->apm_status = $request->apm_status; // Atualizando o APM status

        // Salvar as alterações
        $aluno->save();

        // Redirecionar para a página de visualização do aluno
        return redirect()
            ->route('dashboard.rh.visualizar_aluno', ['id' => $aluno->id_aluno])
            ->with('success', 'Informações do aluno atualizadas com sucesso.');
    }
}
