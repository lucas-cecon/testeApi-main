<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusAlunosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status_alunos')->insert([
            ['status' => 'Em atividade'],
            ['status' => 'Concluído'],
            ['status' => 'Reprovado'],
        ]);
    }
}

