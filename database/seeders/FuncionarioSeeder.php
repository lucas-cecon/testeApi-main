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
                'nome' => 'Guiliana Mafra',
                'cpf' => '12345678901',
                'nif' => '123456789',
                'cargo' => 1,
                'horario' => 1,
                'senha' => Hash::make('12345'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nome' => 'Caroline Pimentel',
                'cpf' => '22345678901',
                'nif' => '123456789',
                'cargo' => 1,
                'horario' => 1,
                'senha' => Hash::make('12345'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nome' => 'Rosemeyre Aparecida',
                'cpf' => '12345678301',
                'nif' => '123456789',
                'cargo' => 1,
                'horario' => 1,
                'senha' => Hash::make('12345'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nome' => 'Robson Alves',
                'cpf' => '20918293046',
                'nif' => '783940263',
                'cargo' => 1,
                'horario' => 1,
                'senha' => Hash::make('12345'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nome' => 'Marcela Americanas',
                'cpf' => '02900901721',
                'nif' => '039162839',
                'cargo' => 1,
                'horario' => 1,
                'senha' => Hash::make('12345'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nome' => 'Ricardo Madera',
                'cpf' => '09876543210',
                'nif' => '987654321',
                'cargo' => 2,
                'horario' => 2,
                'senha' => Hash::make('12345'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nome' => 'Tales de Mileto',
                'cpf' => '09226543210',
                'nif' => '987654321',
                'cargo' => 2,
                'horario' => 2,
                'senha' => Hash::make('12345'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nome' => 'Vladimir Pitondo',
                'cpf' => '09833543210',
                'nif' => '987654321',
                'cargo' => 2,
                'horario' => 2,
                'senha' => Hash::make('12345'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nome' => 'Marcilha Amaral',
                'cpf' => '83918291012',
                'nif' => '009028329',
                'cargo' => 2,
                'horario' => 2,
                'senha' => Hash::make('12345'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nome' => 'Max Robledine',
                'cpf' => '10928102910',
                'nif' => '987654921',
                'cargo' => 3,
                'horario' => 2,
                'senha' => Hash::make('12345'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nome' => 'Tomas Maquiavel',
                'cpf' => '15928102910',
                'nif' => '987654921',
                'cargo' => 3,
                'horario' => 2,
                'senha' => Hash::make('12345'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nome' => 'Levi daport aria',
                'cpf' => '19928202910',
                'nif' => '987654921',
                'cargo' => 3,
                'horario' => 2,
                'senha' => Hash::make('12345'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nome' => 'Fabian Redelish',
                'cpf' => '01911222232',
                'nif' => '898989891',
                'cargo' => 3,
                'horario' => 2,
                'senha' => Hash::make('12345'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nome' => 'Josef Tham Kench',
                'cpf' => '90908198901',
                'nif' => '987694321',
                'cargo' => 4,
                'horario' => 2,
                'senha' => Hash::make('12345'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
