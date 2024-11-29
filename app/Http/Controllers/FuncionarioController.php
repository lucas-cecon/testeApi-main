<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Models\CargoFuncionario;
use App\Models\BancoDeHoras;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // Para gerar o token

class FuncionarioController extends Controller
{
    // Função para renderizar a página de login
    public function showLoginForm()
    {
        return view('login');
    }

    public function autenticar(Request $request)
    {
        // Validação básica do login
        $validatedData = $request->validate([
            'cpf_nif' => 'required|string',
            'senha' => 'required|string'
        ]);
    
        // Verifica se o funcionário existe com base no CPF ou NIF
        $funcionario = Funcionario::where('cpf', $request->input('cpf_nif'))
                                  ->orWhere('nif', $request->input('cpf_nif'))
                                  ->first();
    
        // Verifica se o funcionário foi encontrado e se a senha está correta
        if ($funcionario && Hash::check($request->input('senha'), $funcionario->senha)) {
            // Encontrar o cargo e o horário usando apenas os IDs
            $cargo = CargoFuncionario::find($funcionario->cargo); // Encontrar o cargo
            $horario = BancoDeHoras::find($funcionario->horario); // Encontrar o horário
    
            // Gera o token (simulação, substitua pela lógica real de geração de token)
            $token = bin2hex(random_bytes(16));
    
            // Armazena o token no banco de dados
            $funcionario->token = $token;
            $funcionario->save(); // Salva o token no banco
    
            // Retorna um JSON se a requisição for de API
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Login realizado com sucesso',
                    'funcionario' => $funcionario,
                    'token' => $token
                ], 200);
            }
    
            // Armazena o token, nome, cargo, e outros dados na sessão
            session([
                'token' => $token,
                'nome' => $funcionario->nome,
                'cargo' => $cargo->descricao, // Armazena a descrição do cargo na sessão
                'id_funcionario' => $funcionario->ID_funcionario
            ]);
    
            // Redireciona com base no cargo do funcionário
            switch ($cargo->descricao) {
                case 'Master':
                    return redirect()->route('dashboard.master')->with('success', 'Login realizado com sucesso.');
                case 'RH':
                    return redirect()->route('dashboard.rh')->with('success', 'Login realizado com sucesso.');
                case 'Gestor':
                    return redirect()->route('dashboard.gestor.index_arrumado')->with('success', 'Login realizado com sucesso.');
                case 'Professor':
                    return redirect()->route('dashboard.professor')->with('success', 'Login realizado com sucesso.');
                default:
                    return redirect()->route('dashboard.default')->with('success', 'Login realizado com sucesso.');
            }
        } else {
            // Se a requisição espera JSON, retorna uma mensagem de erro
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Credenciais inválidas'], 401);
            }
            return redirect()->back()->with('error', 'Credenciais inválidas.');
        }
    }

    public function perfil()
    {
        // Obtém o ID do funcionário logado da sessão
        $idFuncionario = session('id_funcionario'); // Ajuste conforme o nome exato da sessão
    
        // Obtém o funcionário logado com o cargo e horário usando o ID da sessão
        $funcionario = Funcionario::with(['cargo', 'horario'])
            ->where('id_funcionario', $idFuncionario)
            ->first();
    
        // Verifica se o funcionário foi encontrado
        if (!$funcionario) {
            return redirect()->route('funcionarios.listar')->with('error', 'Funcionário não encontrado.');
        }
    
        // Retorna a view de perfil com as informações do funcionário
        return view('geral.profile', compact('funcionario'));
    }
    

    
    

    public function logout(Request $request)
    {
        // Obtém o ID do funcionário logado pela sessão
        $idFuncionario = session('id_funcionario');

        if ($idFuncionario) {
            // Remove o token do banco de dados para o funcionário logado
            $funcionario = Funcionario::find($idFuncionario);
            if ($funcionario) {
                $funcionario->token = null;
                $funcionario->save(); // Salva a remoção do token no banco de dados
            }
        }

        // Limpa a sessão
        $request->session()->flush();

        // Se a requisição espera JSON, retorna uma mensagem de sucesso
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Logout realizado com sucesso.'], 200);
        }

        // Redireciona para a página de login com uma mensagem de sucesso
        return redirect()->route('login')->with('success', 'Você saiu com sucesso.');
    }

    public function viewListarFuncionarios(Request $request)
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

        return view('listar', compact('funcionarios'));
    }

    public function showCadastrarForm()
    {
        $cargos = CargoFuncionario::all(); // Obtém todos os cargos da tabela cargo_funcionarios
        $horarios = BancoDeHoras::all(); // Obtém todos os horários da tabela banco_de_horas
        return view('cadastrar', compact('cargos', 'horarios'));
    }

    public function showEditarForm($id)
    {
        $funcionario = Funcionario::findOrFail($id);
        $cargos = CargoFuncionario::all();
        $horarios = BancoDeHoras::all();
        return view('editar', compact('funcionario', 'cargos', 'horarios'));
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

            return redirect()->route('funcionarios.listar')->with('success', 'Funcionário cadastrado com sucesso!');
        } catch (\Exception $e) {
            // Se a requisição espera JSON, retorna um erro em formato JSON
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Erro ao cadastrar funcionário.'], 400);
            }

            return redirect()->back()->with('error', 'Ocorreu um erro ao cadastrar o funcionário.');
        }
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

            return redirect()->route('funcionarios.listar')->with('success', 'Funcionário atualizado com sucesso!');
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

            return redirect()->route('funcionarios.listar')->with('error', 'Erro ao excluir funcionário.');
        }
    }

    // Função para consultar funcionário por CPF
    public function consultarFuncionarioPorCPF($cpf)
    {
        try {
            $funcionario = Funcionario::where('cpf', $cpf)->with(['cargo', 'horario'])->firstOrFail();
            return response()->json($funcionario, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao consultar funcionário', 'error' => $e->getMessage()], 404);
        }
    }
}
