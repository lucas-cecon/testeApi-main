<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BancoDeHoras extends Model
{
    use HasFactory;

    protected $table = 'banco_de_horas';
    protected $fillable = ['codigo', 'hora_inicio', 'hora_fim'];

    public function funcionarios()
    {
        return $this->hasMany(Funcionario::class, 'horario', 'id'); // Relacionamento com a tabela funcionarios
    }
}
