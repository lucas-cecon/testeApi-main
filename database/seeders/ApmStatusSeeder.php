<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApmStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('apm_status')->insert([['status' => 'Não Pago'], ['status' => 'Parcela 1'], ['status' => 'Parcela 2'], ['status' => 'Parcela 3'], ['status' => 'Parcela 4']]);
    }
}
