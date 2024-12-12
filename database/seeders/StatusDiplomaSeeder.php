<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusDiplomaSeeder extends Seeder
{
    public function run()
    {
        DB::table('status_diploma')->insert([['status' => 'Aberto'], ['status' => 'Em andamento'], ['status' => 'Concluido']]);
    }
}
