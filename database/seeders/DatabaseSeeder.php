<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

    $this->call(CargoFuncionarioSeeder::class);
    $this->call(BancoDeHorasSeeder::class);
    $this->call(FuncionarioSeeder::class);
    $this->call(StatusTicketSeeder::class);
    $this->call(ControleDePontoTicketSeeder::class);
    $this->call(StatusAlunosSeeder::class);
    $this->call(CursosSeeder::class);
    $this->call(ApmStatusSeeder::class);
    $this->call(TabelaAlunosSeeder::class);
    $this->call(StatusDiplomaSeeder::class);
    $this->call(DiplomaSeeder::class);
    $this->call(ControleDiplomaSeeder::class);
}
}
