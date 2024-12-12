<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControleDePontoTicket extends Model
{
    use HasFactory;

    // Define o nome da tabela associada ao modelo, caso não siga a convenção plural
    protected $table = 'controle_de_ponto_ticket';

    // Permite que esses campos sejam preenchidos em massa
    protected $fillable = ['ID_funcionario', 'gerente_ID', 'horario_antigo', 'horario_novo', 'descricao', 'status_ticket', 'data_inicio', 'data_fim'];

    // Define as relações se houver (por exemplo, relação com Funcionario)
    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class, 'ID_funcionario');
    }

    public function gerente()
    {
        return $this->belongsTo(Funcionario::class, 'gerente_ID');
    }

    public function status()
    {
        return $this->belongsTo(StatusTicket::class, 'status_ticket');
    }

    public function horarioAntigo()
    {
        return $this->belongsTo(BancoDeHoras::class, 'horario_antigo');
    }

    public function horarioNovo()
    {
        return $this->belongsTo(BancoDeHoras::class, 'horario_novo');
    }

    // Relacionamento com a tabela status_ticket
    public function statusTicket()
    {
        return $this->belongsTo(StatusTicket::class, 'status_ticket');
    }
}
