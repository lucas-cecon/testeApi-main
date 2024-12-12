<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CursosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cursos')->insert([
            ['curso' => 'Turma562131'],
            ['curso' => 'Turma010423'],
            ['curso' => 'Turma010284'],
            ['curso' => 'Turma012311'],
            ['curso' => 'Turma011111'],
            ['curso' => 'Turma010393'],
        ]);
    }
}
