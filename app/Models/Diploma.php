<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diploma extends Model
{
    use HasFactory;

    protected $table = 'diploma';

    protected $fillable = ['titulo', 'lote_diploma', 'quant_diploma', 'turma_diploma', 'status'];

    // Relacionamento com o modelo Curso
    public function curso()
    {
        return $this->belongsTo(Curso::class, 'turma_diploma', 'id'); // Certifique-se de que 'turma_diploma' é a chave estrangeira
    }

    // Relacionamento com o modelo StatusDiploma
    public function statusDiploma()
    {
        return $this->belongsTo(StatusDiploma::class, 'status', 'id'); // Certifique-se de que 'status' é a chave estrangeira
    }

    // Defina o relacionamento com o modelo Aluno
    public function alunos()
    {
        return $this->hasMany(ControleDiploma::class, 'diploma', 'id');
    }

    // Define o relacionamento com ControleDiploma
    public function controleDiplomas()
    {
        return $this->hasMany(ControleDiploma::class, 'diploma', 'id'); // Verifique se o nome da chave estrangeira e da chave local estão corretos
    }
}
