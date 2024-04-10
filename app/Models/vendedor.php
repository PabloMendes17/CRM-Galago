<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class vendedor extends Authenticatable
{
    use HasFactory, Notifiable;

    // Defina a tabela correspondente ao modelo
    protected $table = 'vendedor';


    // Defina os campos que podem ser atribuídos em massa
    protected $fillable = [
        'NOME', 'EMAIL', 'SENHA','usuario_PARAMetro',
    ];

    // Oculta os campos sensíveis, como a senha, ao serializar o modelo
    protected $hidden = [
        'SENHA',
    ];
}