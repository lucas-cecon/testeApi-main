<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BancoDeHorasSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('banco_de_horas')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Insere os dados
        DB::table('banco_de_horas')->insert([
            [
                'codigo' => 'BH001',
                'hora_inicio' => '08:00:00',
                'hora_fim' => '17:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'codigo' => 'BH002',
                'hora_inicio' => '09:00:00',
                'hora_fim' => '18:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'codigo' => 'BH003',
                'hora_inicio' => '10:00:00',
                'hora_fim' => '19:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}

