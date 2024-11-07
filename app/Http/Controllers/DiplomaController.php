<?php

namespace App\Http\Controllers;

use App\Models\ControleDiploma;
use App\Models\Aluno;
use App\Models\Diploma;
use App\Models\Curso;
use Illuminate\Http\Request;

class DiplomaController extends Controller
{
    /**
     * Exibe a lista de diplomas com filtro de pesquisa.
     */
    public function index(Request $request)
    {
        $query = Diploma::query();

        // Filtra pelo título do diploma ou informações do aluno (nome, CPF ou RG)
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('titulo', 'like', '%' . $searchTerm . '%')
                    ->orWhereHas('controleDiplomas.aluno', function ($q) use ($searchTerm) {
                        $q->where('nome', 'like', '%' . $searchTerm . '%')
                          ->orWhere('cpf_aluno', 'like', '%' . $searchTerm . '%')
                          ->orWhere('rg', 'like', '%' . $searchTerm . '%');
                    });
            });
        }

        // Obtém todos os diplomas que atendem ao critério de pesquisa
        $diplomas = $query->get();

        return view('dashboard.rh.diplomas', compact('diplomas'));
    }

    /**
     * Exibe os detalhes de um diploma específico.
     */
    public function show($id)
    {
        $diploma = Diploma::findOrFail($id);
        $alunosRelacionados = ControleDiploma::where('diploma', $id)->with('aluno')->get();
        $todosAlunos = Aluno::all(); // Busca todos os alunos
    
        return view('dashboard.rh.dados_diploma', compact('diploma', 'alunosRelacionados', 'todosAlunos'));
    }

    /**
     * Exibe o formulário para escolher diploma e aluno.
     */
    public function escolher()
    {
        $diplomas = Diploma::all();
        $alunos = Aluno::all();

        return view('dashboard.rh.escolher_diploma_aluno', compact('diplomas', 'alunos'));
    }

    /**
     * Associa um aluno a um diploma.
     */
    public function associar(Request $request)
    {
        $diplomaId = $request->input('diploma_id');
        $alunoId = $request->input('aluno_id');

        // Verifica se o diploma e o aluno existem
        $diploma = Diploma::find($diplomaId);
        $aluno = Aluno::find($alunoId);

        if (!$diploma || !$aluno) {
            return redirect()->back()->with('error', 'Diploma ou Aluno não encontrado.');
        }

        // Cria a associação
        ControleDiploma::create([
            'aluno_id' => $alunoId,
            'diploma' => $diplomaId,
        ]);

        return redirect()->route('dashboard.rh.diplomas')->with('success', 'Aluno associado ao diploma com sucesso.');
    }

    /**
     * Exibe o formulário de criação de um novo diploma.
     */
    public function create()
    {
        // Busca todos os cursos disponíveis
        $cursos = Curso::all();
        
        return view('dashboard.rh.create', compact('cursos'));
    }
    
    

    /**
     * Armazena um novo diploma no banco de dados.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'lote_diploma' => 'required|string|max:255',
            'quant_diploma' => 'required|integer|min:1',
            'turma_diploma' => 'required|string|max:255'
        ]);
    
        // Adiciona o status ao array de dados validados
        $validated['status'] = 1; // Define o status como 1
    
        // Cria o diploma com os dados validados
        Diploma::create($validated);
    
        return redirect()->route('dashboard.rh.diplomas')->with('success', 'Diploma criado com sucesso!');
    }

    public function associarAluno(Request $request, $diplomaId)
    {
        $request->validate([
            'aluno_id' => 'required|exists:tabela_alunos,id_aluno', // Certifique-se de que o aluno existe
        ]);

        // Cria a relação no ControleDiploma
        ControleDiploma::create([
            'aluno_id' => $request->input('aluno_id'),
            'diploma' => $diplomaId,
        ]);

        return redirect()->route('dashboard.rh.diplomas.show', $diplomaId)->with('success', 'Aluno adicionado ao diploma com sucesso!');
    }

    public function removerAluno($relacaoId)
    {
        // Busca a relação do aluno com o diploma
        $relacao = ControleDiploma::findOrFail($relacaoId);
    
        // Limpa o campo diploma, definindo como nulo
        $relacao->diploma = null; // Define como null para remover a associação
        $relacao->save();
    
        return redirect()->back()->with('success', 'Aluno removido do diploma com sucesso!');
    }

    public function atualizarStatus($id)
    {
        // Busca o diploma pelo ID
        $diploma = Diploma::findOrFail($id);
        
        // Atualiza o status do diploma
        if ($diploma->status == 1) {
            $diploma->status = 2; // De 1 para 2
        } elseif ($diploma->status == 2) {
            $diploma->status = 3; // De 2 para 3
        }
        
        // Salva as alterações
        $diploma->save();

        // Redireciona de volta com uma mensagem de sucesso
        return redirect()->back()->with('success', 'Status do diploma atualizado com sucesso!');
    }

    

    
    
}
