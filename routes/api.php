<?php

use App\Http\Controllers\FuncionarioController;
use Illuminate\Support\Facades\Route;

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
Route::get('/gestor/tickets/pedidos', [GestorController::class, 'pedidosTicket'])->name('api.gestor.pedidos_ticket');