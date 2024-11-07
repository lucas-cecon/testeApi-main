<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CargoFuncionarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('cargo_funcionarios')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;'); 

        DB::table('cargo_funcionarios')->insert([
            [
                'descricao' => 'RH',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'descricao' => 'Professor',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'descricao' => 'Gestor',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'descricao' => 'Master',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);

    }
}
