<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $table = 'cursos';
    protected $primaryKey = 'id';

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'curso', // Certifique-se de que este campo corresponde à sua tabela
    ];

    // Relacionamento inverso
    public function alunos()
    {
        return $this->hasMany(Aluno::class, 'curso', 'id');
    }
}
