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
            [
                'titulo' => 'Diploma em Química',
                'lote_diploma' => '2024-03',
                'quant_diploma' => 32,
                'turma_diploma' => 3, // Substitua pelo ID correspondente da tabela cursos
                'status' => 1, // Substitua pelo ID correspondente da tabela status_diploma
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Diploma em Mecânica Industrial',
                'lote_diploma' => '2024-04',
                'quant_diploma' => 50,
                'turma_diploma' => 4, // Substitua pelo ID correspondente da tabela cursos
                'status' => 1, // Substitua pelo ID correspondente da tabela status_diploma
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Diploma em Design de Interiores',
                'lote_diploma' => '2024-05',
                'quant_diploma' => 1,
                'turma_diploma' => 5, // Substitua pelo ID correspondente da tabela cursos
                'status' => 1, // Substitua pelo ID correspondente da tabela status_diploma
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Diploma em Administração',
                'lote_diploma' => '2024-06',
                'quant_diploma' => 1,
                'turma_diploma' => 6, // Substitua pelo ID correspondente da tabela cursos
                'status' => 1, // Substitua pelo ID correspondente da tabela status_diploma
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
