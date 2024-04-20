<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
 
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        DB::table('situacao_agenda')->insert([    'CODIGO' =>1,'DESCRICAO' =>'PENDENTE',]);
        DB::table('situacao_agenda')->insert([    'CODIGO' =>2,'DESCRICAO' =>'AGUARDANDO DESENVOLVIMENTO',]);
        DB::table('situacao_agenda')->insert([    'CODIGO' =>3,'DESCRICAO' =>'AGUARDANDO SUPERVISAO',]);
        DB::table('situacao_agenda')->insert([    'CODIGO' =>4,'DESCRICAO' =>'AGUARDANDO FINANCEIRO',]);
        DB::table('situacao_agenda')->insert([    'CODIGO' =>5,'DESCRICAO' =>'RESOLVIDO',]);
        DB::table('situacao_agenda')->insert([    'CODIGO' =>6,'DESCRICAO' =>'REAGENDADO',]);        
    }
}
