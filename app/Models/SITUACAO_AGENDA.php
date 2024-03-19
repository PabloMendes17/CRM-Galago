<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SITUACAO_AGENDA extends Model
{
    use HasFactory;
    protected $table = 'SITUACAO_AGENDA';
    protected $primaryKey = 'CODIGO';
}
