<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class FuncionarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('funcionarios')->truncate();
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('funcionarios')->insert([
            [
                'nome' => 'RH 1',
                'cpf' => '12345678901',
                'nif' => '123456789',
                'cargo' => 1,
                'horario' => 1,
                'senha' => Hash::make('12345'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nome' => 'RH 2',
                'cpf' => '22345678901',
                'nif' => '123456789',
                'cargo' => 1,
                'horario' => 1,
                'senha' => Hash::make('12345'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nome' => 'RH 3',
                'cpf' => '12345678301',
                'nif' => '123456789',
                'cargo' => 1,
                'horario' => 1,
                'senha' => Hash::make('12345'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nome' => 'Professor 1',
                'cpf' => '09876543210',
                'nif' => '987654321',
                'cargo' => 2,
                'horario' => 2,
                'senha' => Hash::make('12345'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nome' => 'Professor 2',
                'cpf' => '09226543210',
                'nif' => '987654321',
                'cargo' => 2,
                'horario' => 2,
                'senha' => Hash::make('12345'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nome' => 'Professor 3',
                'cpf' => '09833543210',
                'nif' => '987654321',
                'cargo' => 2,
                'horario' => 2,
                'senha' => Hash::make('12345'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nome' => 'Gestor 1',
                'cpf' => '10928102910',
                'nif' => '987654921',
                'cargo' => 3,
                'horario' => 2,
                'senha' => Hash::make('12345'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nome' => 'Gestor 2',
                'cpf' => '15928102910',
                'nif' => '987654921',
                'cargo' => 3,
                'horario' => 2,
                'senha' => Hash::make('12345'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nome' => 'Gestor 3',
                'cpf' => '19928202910',
                'nif' => '987654921',
                'cargo' => 3,
                'horario' => 2,
                'senha' => Hash::make('12345'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nome' => 'Master 1',
                'cpf' => '90908198901',
                'nif' => '987694321',
                'cargo' => 4,
                'horario' => 2,
                'senha' => Hash::make('12345'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nome' => 'Master 2',
                'cpf' => '90908198922',
                'nif' => '987694321',
                'cargo' => 4,
                'horario' => 2,
                'senha' => Hash::make('12345'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nome' => 'Master 3',
                'cpf' => '90903198931',
                'nif' => '987694321',
                'cargo' => 4,
                'horario' => 2,
                'senha' => Hash::make('12345'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
