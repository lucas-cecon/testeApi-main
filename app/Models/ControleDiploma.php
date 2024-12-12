<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControleDiploma extends Model
{
    use HasFactory;

    protected $table = 'controle_diploma'; // Nome da tabela

    // Campos permitidos para atribuição em massa
    protected $fillable = ['aluno_id', 'diploma'];

    // Relacionamento com o modelo Aluno
    public function aluno()
    {
        return $this->belongsTo(Aluno::class, 'aluno_id', 'id_aluno'); // Ajuste para corresponder à chave primária
    }

    // Relacionamento com o modelo Diploma
    public function diploma()
    {
        return $this->belongsTo(Diploma::class, 'diploma', 'id'); // Ajuste conforme necessário
    }
}
