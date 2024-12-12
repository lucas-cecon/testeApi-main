<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusDiploma extends Model
{
    use HasFactory;

    protected $table = 'status_diploma'; // Nome da tabela no banco de dados

    protected $fillable = [
        'status', // Atributo que pode ser preenchido em massa
    ];
}
