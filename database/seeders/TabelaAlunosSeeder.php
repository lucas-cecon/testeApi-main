<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            [
                'nome' => 'Pamela Vettoreti',
                'cpf_aluno' => '89381728192',
                'rg' => 'RJ0909182',
                'n_matricula' => 'MAT2023004',
                'curso' => 2, // Administração
                'status_aluno' => 3, // Reprovado
                'email' => 'pamela.vettoreti@email.com',
                'apm_status' => 2
            ],
            [
                'nome' => 'Maria Eduarda Zeroum',
                'cpf_aluno' => '78771627872',
                'rg' => 'RJ9091723',
                'n_matricula' => 'MAT2023005',
                'curso' => 3, // Administração
                'status_aluno' => 3, // Reprovado
                'email' => 'maria.eduarda.zeroum@email.com',
                'apm_status' => 3
            ],
            [
                'nome' => 'João Pierre Davalo',
                'cpf_aluno' => '09192039121',
                'rg' => 'RJ9817211',
                'n_matricula' => 'MAT2023006',
                'curso' => 2, // Administração
                'status_aluno' => 3, // Reprovado
                'email' => 'maria.eduarda.zeroum@email.com',
                'apm_status' => 3
            ],
        ]);

        
    }
}
