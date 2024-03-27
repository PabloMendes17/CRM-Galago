<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class vendedor extends Model
{
    use HasFactory, Notifiable;

    // Defina a tabela correspondente ao modelo
    protected $table = 'vendedor';
    protected $guard = 'vendedor';

    // Defina os campos que podem ser atribuídos em massa
    protected $fillable = [
        'NOME', 'EMAIL', 'SENHA','usuario_PARAMetro',
    ];

    // Oculta os campos sensíveis, como a senha, ao serializar o modelo
    protected $hidden = [
        'SENHA',
    ];
}