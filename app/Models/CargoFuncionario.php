<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargoFuncionario extends Model
{
    use HasFactory;

    protected $table = 'cargo_funcionarios';
    protected $fillable = ['descricao'];

    public function funcionarios()
    {
        return $this->hasMany(Funcionario::class, 'cargo', 'id'); // Relacionamento com a tabela funcionarios
    }
}
