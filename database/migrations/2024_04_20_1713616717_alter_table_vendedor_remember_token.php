<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

Schema::table('vendedor', function (Blueprint $table) {
    $table->dropColumn('remember_token');
});
 
Schema::table('vendedor', function (Blueprint $table) {
    $table->string('remember_token',100);
});