<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusTicket extends Model
{
    use HasFactory;

    // Define o nome da tabela associada ao modelo, caso não siga a convenção plural
    protected $table = 'status_ticket';

    // Permite que esses campos sejam preenchidos em massa
    protected $fillable = [
        'status', // O campo "status" da tabela
    ];

    // Relacionamento com a tabela `controle_de_ponto_ticket`
    public function tickets()
    {
        return $this->hasMany(ControleDePontoTicket::class, 'status_ticket');
    }
}
