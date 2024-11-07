<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusAluno extends Model
{
    use HasFactory;

    protected $table = 'status_alunos'; // Nome da tabela

    protected $primaryKey = 'id'; // Defina o nome correto do ID, se necessário

    // Relacionamento com o modelo Aluno
    public function alunos()
    {
        return $this->hasMany(Aluno::class, 'status_aluno', 'id'); // Defina os campos corretos
    }
}
