<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cargo_funcionarios', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');
            $table->timestamps();
        });

        Schema::create('banco_de_horas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->time('hora_inicio');
            $table->time('hora_fim');
            $table->timestamps();
        });

        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id('ID_funcionario'); // Chave primária é 'ID_funcionario'
            $table->string('nome');
            $table->string('cpf', 11)->unique();
            $table->string('nif', 9);
            $table->unsignedBigInteger('cargo');
            $table->unsignedBigInteger('horario');
            $table->string('senha');
            $table->string('token')->nullable();
            $table->foreign('cargo')->references('id')->on('cargo_funcionarios')->onDelete('cascade');
            $table->foreign('horario')->references('id')->on('banco_de_horas')->onDelete('cascade');
            $table->timestamps();
        });

        //

        Schema::create('status_ticket', function (Blueprint $table) {
            $table->id();
            $table->string('status');
        });

        Schema::create('controle_de_ponto_ticket', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ID_funcionario');
            $table->unsignedBigInteger('gerente_ID');
            $table->unsignedBigInteger('horario_antigo'); // Agora referencia a tabela banco_de_horas
            $table->unsignedBigInteger('horario_novo'); // Também referencia a tabela banco_de_horas
            $table->string('descricao')->nullable();
            $table->unsignedBigInteger('status_ticket');
            $table->date('data_inicio')->nullable();
            $table->date('data_fim')->nullable();
            $table->timestamps();

            // Foreign Keys
            $table->foreign('ID_funcionario')->references('ID_funcionario')->on('funcionarios'); // Corrigido para referenciar 'ID_funcionario'
            $table->foreign('gerente_ID')->references('ID_funcionario')->on('funcionarios'); // Corrigido para referenciar 'ID_funcionario'
            $table->foreign('horario_antigo')->references('id')->on('banco_de_horas'); // Referencia a tabela banco_de_horas
            $table->foreign('horario_novo')->references('id')->on('banco_de_horas'); // Referencia a tabela banco_de_horas
            $table->foreign('status_ticket')->references('id')->on('status_ticket');
        });

        Schema::create('status_alunos', function (Blueprint $table) {
            $table->id();
            $table->string('status'); // Coluna para armazenar o status
            $table->timestamps();
        });

        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('curso');
            $table->timestamps();
        });

        Schema::create('apm_status', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('tabela_alunos', function (Blueprint $table) {
            $table->id('id_aluno');
            $table->string('nome');
            $table->string('cpf_aluno');
            $table->string('rg');
            $table->string('n_matricula')->unique();
            $table->unsignedBigInteger('curso');
            $table->unsignedBigInteger('status_aluno');
            $table->string('email');
            $table->unsignedBigInteger('apm_status');
            $table->timestamps();

            // Foreign Keys
            $table->foreign('curso')->references('id')->on('cursos')->onDelete('cascade');
            $table->foreign('status_aluno')->references('id')->on('status_alunos')->onDelete('cascade');
            $table->foreign('apm_status')->references('id')->on('apm_status')->onDelete('cascade');

            // Optional: Add indexes for faster queries if needed
            $table->index('cpf_aluno');
            $table->index('rg');
            $table->index('email');
        });

        Schema::create('status_diploma', function (Blueprint $table) {
            $table->id(); // Cria a coluna 'id' como chave primária
            $table->string('status'); // Cria a coluna 'status' do tipo string
            $table->timestamps(); // Cria as colunas 'created_at' e 'updated_at'
        });

        Schema::create('diploma', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('lote_diploma'); // Preenchido à mão
            $table->integer('quant_diploma');
            $table->foreignId('turma_diploma')->constrained('cursos', 'id'); // Chave estrangeira para tabela cursos
            $table->foreignId('status')->constrained('status_diploma'); // Chave estrangeira para status_diploma
            $table->timestamps();
        });

        Schema::create('controle_diploma', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aluno_id')->constrained('tabela_alunos', 'id_aluno')->onDelete('restrict'); // Aqui, onDelete deve ser restrict
            $table->foreignId('diploma')->constrained('diploma', 'id'); // Chave estrangeira para diploma
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // A ordem inversa deve ser usada para evitar conflitos na exclusão das tabelas
        Schema::dropIfExists('controle_diploma'); // Esta tabela referencia diploma
        Schema::dropIfExists('diploma'); // Agora você pode remover diploma
        Schema::dropIfExists('controle_de_ponto_ticket');
        Schema::dropIfExists('status_ticket');
        Schema::dropIfExists('tabela_alunos');
        Schema::dropIfExists('funcionarios');
        Schema::dropIfExists('banco_de_horas');
        Schema::dropIfExists('cargo_funcionarios');
        Schema::dropIfExists('status_alunos');
        Schema::dropIfExists('cursos');
        Schema::dropIfExists('apm_status');
        Schema::dropIfExists('status_diploma');
    }
};
