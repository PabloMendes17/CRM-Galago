<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Vendedor extends Authenticatable
{
    use HasFactory, Notifiable;


    protected $table = 'vendedor';

    protected $fillable = [

        'CODIGO','NOME', 'EMAIL', 'SENHA','usuario_PARAMetro',
    ];

    protected $hidden = [
        'SENHA',
    ];

    public function getAuthPassword()
    {
        return bcrypt($this->SENHA);
    }

    public function getAuthIdentifier()
    {
        return $this->CODIGO;
    }

    public function getAuthIdentifierName()
    {
        return 'CODIGO'; 
    }

    
}