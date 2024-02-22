<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class agenda extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'agenda';
    protected $fillable = [
        'CONTATO',
        'OPERADOR',
        'ASSUNTO',
        'CLIENTE',
        'DATA_GRAVACAO',
        'DATA_AGENDA',
        'HORA_AGENDA',
        'SITUACAO',
        'TIPO',
        'HISTORICO',
        'TELEFONE1'
    ];
}
