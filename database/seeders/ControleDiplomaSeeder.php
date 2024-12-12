<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ControleDiplomaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('controle_diploma')->insert([
            [
                'aluno_id' => 1, // Substitua pelo ID do aluno correspondente
                'diploma' => 1, // Substitua pelo ID do diploma correspondente
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'aluno_id' => 2, // Substitua pelo ID do aluno correspondente
                'diploma' => 2, // Substitua pelo ID do diploma correspondente
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'aluno_id' => 3, // Substitua pelo ID do aluno correspondente
                'diploma' => 3, // Substitua pelo ID do diploma correspondente
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'aluno_id' => 4, // Substitua pelo ID do aluno correspondente
                'diploma' => 4, // Substitua pelo ID do diploma correspondente
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'aluno_id' => 5, // Substitua pelo ID do aluno correspondente
                'diploma' => 5, // Substitua pelo ID do diploma correspondente
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'aluno_id' => 2, // Substitua pelo ID do aluno correspondente
                'diploma' => 5, // Substitua pelo ID do diploma correspondente
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
