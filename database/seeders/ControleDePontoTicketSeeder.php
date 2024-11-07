<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ControleDePontoTicketSeeder extends Seeder
{
    public function run()
    {
        DB::table('controle_de_ponto_ticket')->insert([
            [
                'ID_funcionario' => 4,
                'gerente_ID' => 7,
                'horario_antigo' => 1,
                'horario_novo' => 2,
                'descricao' => 'Troca de turno para melhor encaixe no cronograma.',
                'status_ticket' => 1,
                'data_inicio' => Carbon::create(2024, 10, 1),
                'data_fim' => Carbon::create(2024, 10, 15)
            ],
            [
                'ID_funcionario' => 5,
                'gerente_ID' => 8,
                'horario_antigo' => 2,
                'horario_novo' => 3,
                'descricao' => 'Mudança para o turno da tarde devido a novas responsabilidades.',
                'status_ticket' => 2,
                'data_inicio' => Carbon::create(2024, 11, 1),
                'data_fim' => Carbon::create(2024, 11, 10)
            ],
            [
                'ID_funcionario' => 6,
                'gerente_ID' => 9,
                'horario_antigo' => 2,
                'horario_novo' => 3,
                'descricao' => 'Necessidade de horário mais flexível.',
                'status_ticket' => 3,
                'data_inicio' => Carbon::create(2024, 11, 5),
                'data_fim' => Carbon::create(2024, 11, 20)
            ],
            [
                'ID_funcionario' => 4,
                'gerente_ID' => 7,
                'horario_antigo' => 2,
                'horario_novo' => 1,
                'descricao' => 'Mudança para adequação de projetos.',
                'status_ticket' => 4,
                'data_inicio' => Carbon::create(2024, 12, 1),
                'data_fim' => Carbon::create(2024, 12, 15)
            ],
            [
                'ID_funcionario' => 5,
                'gerente_ID' => 8,
                'horario_antigo' => 2,
                'horario_novo' => 1,
                'descricao' => 'Mudança para adequação de projetos.',
                'status_ticket' => 1,
                'data_inicio' => Carbon::create(2024, 12, 10),
                'data_fim' => Carbon::create(2024, 12, 20)
            ],
            [
                'ID_funcionario' => 6,
                'gerente_ID' => 9,
                'horario_antigo' => 2,
                'horario_novo' => 1,
                'descricao' => 'Mudança para adequação de projetos.',
                'status_ticket' => 2,
                'data_inicio' => Carbon::create(2025, 1, 5),
                'data_fim' => Carbon::create(2025, 1, 20)
            ],
            [
                'ID_funcionario' => 4,
                'gerente_ID' => 9,
                'horario_antigo' => 2,
                'horario_novo' => 1,
                'descricao' => 'Mudança para adequação de projetos.',
                'status_ticket' => 3,
                'data_inicio' => Carbon::create(2025, 1, 15),
                'data_fim' => Carbon::create(2025, 1, 25)
            ],
            [
                'ID_funcionario' => 5,
                'gerente_ID' => 9,
                'horario_antigo' => 2,
                'horario_novo' => 1,
                'descricao' => 'Mudança para adequação de projetos.',
                'status_ticket' => 4,
                'data_inicio' => Carbon::create(2025, 2, 1),
                'data_fim' => Carbon::create(2025, 2, 15)
            ],
            [
                'ID_funcionario' => 6,
                'gerente_ID' => 9,
                'horario_antigo' => 2,
                'horario_novo' => 1,
                'descricao' => 'Mudança para adequação de projetos.',
                'status_ticket' => 2,
                'data_inicio' => Carbon::create(2025, 2, 10),
                'data_fim' => Carbon::create(2025, 2, 25)
            ],
        ]);
    }
}
