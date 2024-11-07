<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $table = 'funcionarios';
    protected $primaryKey = 'ID_funcionario';

    public function cargo()
    {
        return $this->belongsTo(CargoFuncionario::class, 'cargo', 'id'); // Relacionamento com a tabela cargo_funcionarios
    }

    public function horario()
    {
        return $this->belongsTo(BancoDeHoras::class, 'horario', 'id'); // Relacionamento com a tabela banco_de_horas
    }
}
