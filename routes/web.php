<?php

use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\RHController;
use App\Http\Controllers\GestorController;
use App\Http\Controllers\AlunoController; // Importar o controlador de Aluno
use App\Http\Controllers\DiplomaController;
use Illuminate\Support\Facades\Route;

// Rota para exibir o formulário de login (sem middleware)
Route::get('/login', function () {
    return view('login');
})->name('login');

// Rota para autenticar o funcionário via formulário (sem middleware)
Route::post('/login', [FuncionarioController::class, 'autenticar'])->name('funcionarios.autenticar');

// Rota para fazer logout
Route::post('/logout', [FuncionarioController::class, 'logout'])->name('funcionarios.logout');

// Rotas protegidas pelo middleware 'verificar.token'
Route::middleware([\App\Http\Middleware\VerificarToken::class])->group(function () {

    Route::get('/perfil', [FuncionarioController::class, 'perfil'])->name('perfil');

    // Rota para listar funcionários
    Route::get('/funcionarios', [FuncionarioController::class, 'viewListarFuncionarios'])->name('funcionarios.listar');

    // Rota para exibir o formulário de cadastro
    Route::get('/funcionarios/cadastrar', [FuncionarioController::class, 'showCadastrarForm'])->name('funcionarios.cadastrar');

    // Rota para exibir o formulário de edição
    Route::get('/funcionarios/editar/{id}', [FuncionarioController::class, 'showEditarForm'])->name('funcionarios.editar');

    // Rota para adicionar um funcionário (via formulário)
    Route::post('/funcionarios/adicionar', [FuncionarioController::class, 'adicionarFuncionario'])->name('funcionarios.adicionar');

    // Rota para atualizar um funcionário
    Route::put('/funcionarios/atualizar/{id}', [FuncionarioController::class, 'atualizarFuncionario'])->name('funcionarios.atualizar');

    // Rota para deletar funcionário
    Route::delete('/funcionarios/deletar/{id}', [FuncionarioController::class, 'deletarFuncionario'])->name('funcionarios.deletar');

    // Rotas para Professor
    Route::get('/dashboard/professor', [ProfessorController::class, 'index'])->name('dashboard.professor');
    Route::get('/dashboard/professor/create_ticket', [ProfessorController::class, 'createTicket'])->name('dashboard.professor.create_ticket');
    Route::post('/dashboard/professor/store_ticket', [ProfessorController::class, 'storeTicket'])->name('dashboard.professor.store_ticket');
    // Rota para exibir detalhes de um ticket
    Route::get('/dashboard/professor/ticket/{id}', [ProfessorController::class, 'showTicket'])->name('dashboard.professor.show_ticket');

    // Rotas para RH
    Route::get('/dashboard/rh', [RHController::class, 'index'])->name('dashboard.rh');
    Route::get('/dashboard/rh/pesquisar', [RHController::class, 'pesquisar'])->name('dashboard.rh.pesquisar');
    Route::post('/dashboard/rh/aprovar/{id}', [RHController::class, 'aprovarTicket'])->name('dashboard.rh.aprovar_ticket'); // Método POST para aprovar
    Route::post('/dashboard/rh/rejeitar/{id}', [RHController::class, 'rejeitarTicket'])->name('dashboard.rh.rejeitar_ticket'); // Método POST para rejeitar
    Route::get('/dashboard/rh/ticket/{id}', [RHController::class, 'showTicket'])->name('dashboard.rh.show_ticket'); // Adicionada a rota para detalhes do ticket do RH
    Route::get('/dashboard/rh/apm', [AlunoController::class, 'exibirApm'])->name('dashboard.rh.apm');
    Route::get('/dashboard/rh/apm/{id}', [AlunoController::class, 'visualizarAluno'])->name('dashboard.rh.visualizar_aluno');
    Route::get('/dashboard/rh/apm/{id}/editar', [AlunoController::class, 'editarAluno'])->name('dashboard.rh.editar_aluno');
    Route::post('/dashboard/rh/apm/{id}', [AlunoController::class, 'atualizarAluno'])->name('dashboard.rh.atualizar_aluno');

// Rotas para Diplomas
Route::get('/dashboard/rh/diplomas', [DiplomaController::class, 'index'])->name('dashboard.rh.diplomas'); // Exibe todos os diplomas
Route::get('/dashboard/rh/diplomas/pesquisa', [DiplomaController::class, 'index'])->name('diplomas.pesquisa'); // Pesquisa de diplomas
Route::get('/dashboard/rh/diplomas/{id}', [DiplomaController::class, 'show'])->name('dashboard.rh.diplomas.show'); // Detalhe do diploma
Route::get('/diplomas/visualizar/{id}', [DiplomaController::class, 'visualizar'])->name('diplomas.visualizar'); // Visualizar diploma
Route::delete('/dashboard/rh/diplomas/remover-aluno/{id}', [DiplomaController::class, 'removerAluno'])->name('dashboard.rh.remover_aluno'); // Remover aluno
Route::get('/dashboard/rh/diplomas/escolher', [DiplomaController::class, 'escolher'])->name('diplomas.escolher'); // Escolher diploma
Route::post('/dashboard/rh/diplomas/associar', [DiplomaController::class, 'associar'])->name('diplomas.associar'); // Associar diploma

Route::get('/dashboard/rh/create', [DiplomaController::class, 'create'])->name('diplomas.create');
Route::post('/dashboard/rh/diplomas', [DiplomaController::class, 'store'])->name('diplomas.store');
Route::post('/dashboard/rh/diplomas/{diploma}/adicionar-aluno', [DiplomaController::class, 'associarAluno'])->name('diplomas.associar');
Route::delete('/dashboard/rh/diplomas/remover/{relacao}', [DiplomaController::class, 'removerAluno'])->name('diplomas.remover');
Route::post('/diplomas/{id}/atualizar-status', [DiplomaController::class, 'atualizarStatus'])->name('diplomas.atualizarStatus');











    // Rotas para Gestor

    Route::get('/index_gestor', function () {
    return view('index_arrumado');
    });




    Route::get('/dashboard/gestor', [GestorController::class, 'index'])->name('dashboard.gestor.index_arrumado'); // Rota do índice do gestor
    Route::get('/dashboard/gestor/pesquisa', [GestorController::class, 'index'])->name('dashboard.gestor.pedidos');
    Route::get('/dashboard/gestor/tickets', [GestorController::class, 'listarTickets'])->name('dashboard.gestor.listar_tickets');
    Route::post('/dashboard/gestor/tickets/aprovar/{id}', [GestorController::class, 'aprovarTicket'])->name('dashboard.gestor.aprovar_ticket');
    Route::post('/dashboard/gestor/tickets/rejeitar/{id}', [GestorController::class, 'rejeitarTicket'])->name('dashboard.gestor.rejeitar_ticket');
    Route::get('/dashboard/gestor/tickets/{id}', [GestorController::class, 'detalharTicket'])->name('dashboard.gestor.detalhar_ticket');    // Rota para detalhes do ticket
    Route::get('/dashboard/gestor/pedidos', [GestorController::class, 'listarTickets'])->name('dashboard.gestor.pedidos_ticket'); 
    // Rota para a lista de alunos no dashboard do gestor
    Route::get('/dashboard/gestor/alunos', [GestorController::class, 'mostrarAlunos'])->name('dashboard.gestor.alunos');
    Route::get('/dashboard/gestor/alunos/pesquisa', [GestorController::class, 'pesquisaAluno'])->name('dashboard.gestor.alunos.pesquisa');
    Route::get('/dashboard/gestor/alunos/criar', [GestorController::class, 'showCriarAlunoForm'])->name('dashboard.gestor.alunos.criar');
    Route::post('/dashboard/gestor/alunos', [GestorController::class, 'armazenarAluno'])->name('dashboard.gestor.alunos.armazenar');
    Route::get('/dashboard/gestor/alunos/{id}/editar', [GestorController::class, 'showEditarAlunoForm'])->name('dashboard.gestor.alunos.editar');
    Route::put('/dashboard/gestor/alunos/{id}', [GestorController::class, 'atualizarAluno'])->name('dashboard.gestor.alunos.atualizar');
    Route::delete('/dashboard/gestor/alunos/{id}', [GestorController::class, 'deletarAluno'])->name('dashboard.gestor.alunos.deletar');
    Route::get('/dashboard/gestor/alunos/{id}', [GestorController::class, 'showAluno'])->name('dashboard.gestor.alunos.detalhes');;


    // Rota para dashboard default
    Route::get('/dashboard/default', function () {
        return view('dashboard.default');
    })->name('dashboard.default');

    // Rota para listar alunos
    Route::get('/alunos', [AlunoController::class, 'listar'])->name('alunos.listar'); // Adicionada a rota para listar os alunos
    Route::get('/alunos/pesquisa', [AlunoController::class, 'index'])->name('alunos.index');
    Route::get('/alunos/editar/{id}', [AlunoController::class, 'showEditarForm'])->name('alunos.editar');
    Route::put('/alunos/{id}', [AlunoController::class, 'atualizar'])->name('alunos.atualizar');
    Route::delete('/alunos/{id}', [AlunoController::class, 'deletar'])->name('alunos.deletar');
    // Rota para mostrar o formulário de criação
    Route::get('/alunos/criar', [AlunoController::class, 'showCriarForm'])->name('alunos.criar');
    // Rota para armazenar o novo aluno
    Route::post('/alunos', [AlunoController::class, 'armazenar'])->name('alunos.armazenar');
    Route::get('alunos/{id}', [AlunoController::class, 'show'])->name('alunos.show');



});

// Rotas da API
Route::prefix('api')->group(function () {
    // Rota para autenticar (login) o funcionário via API
    Route::post('/login', [FuncionarioController::class, 'autenticar'])->name('api.funcionarios.autenticar');

    // Rota para listar todos os funcionários via API (com possibilidade de busca)
    Route::get('/funcionarios', [FuncionarioController::class, 'viewListarFuncionarios'])->name('api.funcionarios.listar');

    // Rota para adicionar funcionário via API
    Route::post('/funcionarios/adicionar', [FuncionarioController::class, 'adicionarFuncionario'])->name('api.funcionarios.adicionar');

    

    // Rota para atualizar funcionário via API
    Route::put('/funcionarios/atualizar/{id}', [FuncionarioController::class, 'atualizarFuncionario'])->name('api.funcionarios.atualizar');

    // Rota para deletar funcionário via API
    Route::delete('/funcionarios/deletar/{id}', [FuncionarioController::class, 'deletarFuncionario'])->name('api.funcionarios.deletar');

    // Rota para consultar funcionário por CPF via API
    Route::get('/funcionarios/consultar/{cpf}', [FuncionarioController::class, 'consultarFuncionarioPorCPF'])->name('api.funcionarios.consultar');

    // Rota para realizar logout via API
    Route::post('/logout', [FuncionarioController::class, 'logout'])->name('api.funcionarios.logout');

    // Rota para listar tickets via API (Professor)
    Route::get('/professor/tickets', [ProfessorController::class, 'listarTickets'])->name('api.professor.listar_tickets');

    // Rota para criar um novo ticket via API (Professor)
    Route::post('/professor/tickets', [ProfessorController::class, 'registrarTicket'])->name('api.professor.registrar_ticket');

    // Rota para exibir detalhes de um ticket específico via API (Professor)
    Route::get('/professor/tickets/{id}', [ProfessorController::class, 'detalharTicket'])->name('api.professor.detalhar_ticket');

    // Rota para exibir os dados necessários para criar um ticket via API (Professor)
    Route::get('/professor/tickets/create', [ProfessorController::class, 'mostrarFormularioCriarTicket'])->name('api.professor.mostrar_formulario_criar_ticket');

    // Rotas para Gestor
    Route::get('/gestor/tickets', [GestorController::class, 'listarTickets'])->name('api.gestor.listar_tickets');
    Route::post('/gestor/tickets/aprovar/{id}', [GestorController::class, 'aprovarTicket'])->name('api.gestor.aprovar_ticket');
    Route::post('/gestor/tickets/rejeitar/{id}', [GestorController::class, 'rejeitarTicket'])->name('api.gestor.rejeitar_ticket');
    Route::get('/gestor/tickets/{id}', [GestorController::class, 'detalharTicket'])->name('api.gestor.detalhar_ticket');
    
    //Rotas para o Master
    Route::get('/dashboard/master', [MasterController::class, 'index'])->name('dashboard.master');
    Route::get('/dashboard/master/alunos', [MasterController::class, 'mostrarAlunos'])->name('dashboard.master.alunos');
    Route::get('/dashboard/master/alunos/pesquisa', [MasterController::class, 'pesquisaAluno'])->name('dashboard.master.alunos.pesquisa');
    Route::get('/dashboard/master/alunos/criar', [MasterController::class, 'showCriarAlunoForm'])->name('dashboard.master.alunos.criar');
    Route::post('/dashboard/master/alunos', [MasterController::class, 'armazenarAluno'])->name('dashboard.master.alunos.armazenar');
    Route::get('/dashboard/master/alunos/{id}/editar', [MasterController::class, 'showEditarAlunoForm'])->name('dashboard.master.alunos.editar');
    Route::put('/dashboard/master/alunos/{id}', [MasterController::class, 'atualizarAluno'])->name('dashboard.master.alunos.atualizar');
    Route::delete('/dashboard/master/alunos/{id}', [MasterController::class, 'deletarAluno'])->name('dashboard.master.alunos.deletar');
    Route::get('/dashboard/master/alunos/{id}', [MasterController::class, 'showAluno'])->name('dashboard.master.alunos.detalhes');;
    Route::get('/dashboard/master/pedidos', [GestorController::class, 'listarTickets'])->name('dashboard.master.pedidos_ticket'); 

    Route::get('/dashboard/master/diplomas', [DiplomaController::class, 'index'])->name('dashboard.master.diplomas'); // Exibe todos os diplomas
    Route::get('/dashboard/master/diplomas/pesquisa', [DiplomaController::class, 'index'])->name('diplomas.pesquisa'); // Pesquisa de diplomas
    Route::get('/dashboard/master/diplomas/{id}', [DiplomaController::class, 'show'])->name('dashboard.master.diplomas.show'); // Detalhe do diploma
    Route::get('/diplomas/visualizar/{id}', [DiplomaController::class, 'visualizar'])->name('diplomas.visualizar'); // Visualizar diploma
    Route::delete('/dashboard/master/diplomas/remover-aluno/{id}', [DiplomaController::class, 'removerAluno'])->name('dashboard.master.remover_aluno'); // Remover aluno
    Route::get('/dashboard/master/diplomas/escolher', [DiplomaController::class, 'escolher'])->name('diplomas.escolher'); // Escolher diploma
    Route::post('/dashboard/master/diplomas/associar', [DiplomaController::class, 'associar'])->name('diplomas.associar'); // Associar diploma
    
    Route::get('/dashboard/master/create', [DiplomaController::class, 'create'])->name('diplomas.create');
    Route::post('/dashboard/master/diplomas', [DiplomaController::class, 'store'])->name('diplomas.store');
    Route::post('/dashboard/master/diplomas/{diploma}/adicionar-aluno', [DiplomaController::class, 'associarAluno'])->name('diplomas.associar');
    Route::delete('/dashboard/master/diplomas/remover/{relacao}', [DiplomaController::class, 'removerAluno'])->name('diplomas.remover');
    Route::post('/diplomas/{id}/atualizar-status', [DiplomaController::class, 'atualizarStatus'])->name('diplomas.atualizarStatus');
});
