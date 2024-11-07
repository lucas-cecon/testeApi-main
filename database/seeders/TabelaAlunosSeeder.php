<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class TabelaAlunosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tabela_alunos')->insert([
            [
                'nome' => 'João Silva',
                'cpf_aluno' => '12345678901',
                'rg' => 'MG1234567',
                'n_matricula' => 'MAT2023001',
                'curso' => 1, // Desenvolvimento de Sistemas
                'status_aluno' => 1, // Em atividade
                'email' => 'joao.silva@email.com',
                'apm_status' => 2 // Parcela 1
            ],
            [
                'nome' => 'Maria Oliveira',
                'cpf_aluno' => '10987654321',
                'rg' => 'SP9876543',
                'n_matricula' => 'MAT2023002',
                'curso' => 3, // Eletroeletrônica
                'status_aluno' => 2, // Concluído
                'email' => 'maria.oliveira@email.com',
                'apm_status' => 3 // Parcela 2
            ],
            [
                'nome' => 'Carlos Souza',
                'cpf_aluno' => '11122233344',
                'rg' => 'RJ1234567',
                'n_matricula' => 'MAT2023003',
                'curso' => 4, // Administração
                'status_aluno' => 3, // Reprovado
                'email' => 'carlos.souza@email.com',
                'apm_status' => 1 // Não Pago
            ],
        ]);
    }
}
