<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApmStatus extends Model
{
    use HasFactory;

    protected $table = 'apm_status'; // Nome da tabela

    protected $primaryKey = 'id'; // Defina o nome correto do ID, se necessário

    // Relacionamento com o modelo Aluno
    public function alunos()
    {
        return $this->hasMany(Aluno::class, 'apm_status', 'id'); // Defina os campos corretos
    }
}
