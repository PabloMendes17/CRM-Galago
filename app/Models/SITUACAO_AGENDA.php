<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class situacao_agenda extends Model
{
    use HasFactory;
    protected $table = 'situacao_agenda';
    protected $primaryKey = 'CODIGO';
}
