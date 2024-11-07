<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiplomaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('diploma')->insert([
            [
                'titulo' => 'Diploma em Programação',
                'lote_diploma' => '2024-01',
                'quant_diploma' => 30,
                'turma_diploma' => 1, // Substitua pelo ID correspondente da tabela cursos
                'status' => 1, // Substitua pelo ID correspondente da tabela status_diploma
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Diploma em Design Gráfico',
                'lote_diploma' => '2024-02',
                'quant_diploma' => 20,
                'turma_diploma' => 2, // Substitua pelo ID correspondente da tabela cursos
                'status' => 1, // Substitua pelo ID correspondente da tabela status_diploma
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
