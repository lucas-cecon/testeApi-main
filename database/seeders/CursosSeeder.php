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
            ['curso' => 'Desenvolvimento de Sistemas'],
            ['curso' => 'Mecânica'],
            ['curso' => 'Eletroeletrônica'],
            ['curso' => 'Administração'],
            ['curso' => 'Confeitaria'],
        ]);
    }
}
