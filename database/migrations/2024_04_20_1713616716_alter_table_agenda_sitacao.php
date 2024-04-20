<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
Schema::table('agenda', function (Blueprint $table) {
    $table->string('SITUACAO',30)->change();
});