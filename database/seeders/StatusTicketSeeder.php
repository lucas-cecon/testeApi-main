<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusTicketSeeder extends Seeder
{
    public function run()
    {
        DB::table('status_ticket')->insert([
            ['status' => 'Aberto'],       
            ['status' => 'Em Observação'],
            ['status' => 'Concluído'],
            ['status' => 'Recusado'], 
        ]);
    }
}
