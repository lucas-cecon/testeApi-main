<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $table = 'tabela_alunos'; // Nome da tabela no banco de dados
    protected $primaryKey = 'id_aluno'; // Define a chave primária como 'id_aluno'

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'nome',
        'cpf_aluno',
        'rg',
        'n_matricula',
        'curso',
        'status_aluno',
        'email',
        'apm_status',
    ];

    // Relacionamento com o modelo 'Curso'
// App\Models\Aluno.php
public function curso()
{
    return $this->belongsTo(Curso::class, 'curso', 'id'); // 'curso' é a coluna em alunos que armazena o ID do curso
}


    // Relacionamento com o modelo 'StatusAluno' (um aluno tem um status)
    public function statusAluno()
    {
        return $this->belongsTo(StatusAluno::class, 'status_aluno', 'id'); // Relacionamento com a tabela 'status_alunos'
    }

    // Relacionamento com o modelo 'ApmStatus' (um aluno tem um status de APM)
    public function apmStatus()
    {
        return $this->belongsTo(ApmStatus::class, 'apm_status', 'id'); // Relacionamento com a tabela 'apm_status'
    }

    // Exemplo de uma função para verificar se o aluno está com um status específico
    public function isStatus($status)
    {
        return $this->statusAluno()->where('status', $status)->exists(); // Verifica se o aluno tem o status especificado
    }

    // Exemplo de uma função para retornar o nome completo do aluno com o número de matrícula
    public function getNomeComMatricula()
    {
        return $this->nome . ' - Matrícula: ' . $this->n_matricula; // Retorna o nome e a matrícula do aluno
    }

    // Exemplo de uma função para obter o email formatado do aluno
    public function getEmailFormatado()
    {
        return strtolower($this->email); // Retorna o email em minúsculas
    }

    // Modelo Aluno
    public function controlesDiploma()
    {
        return $this->hasMany(ControleDiploma::class, 'aluno_id'); // Ajuste o nome do campo conforme sua estrutura
    }

}
