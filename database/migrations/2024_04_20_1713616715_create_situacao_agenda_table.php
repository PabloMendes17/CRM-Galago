<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSituacaoAgendaTable extends Migration
{

    public function up()
    {
        Schema::dropIfExists('situacao_agenda');

        Schema::create('situacao_agenda', function (Blueprint $table) {

		$table->increments('CODIGO');
		$table->string('DESCRICAO',30)->nullable()->default('NULL');

        });
    }


}