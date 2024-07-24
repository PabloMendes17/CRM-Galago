<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tag_atendimento extends Model
{
    use HasFactory;
    protected $table = 'tag_atendimento';
    protected $primaryKey = 'CODIGO';
}
