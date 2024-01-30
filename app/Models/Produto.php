<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request; 

class Produto extends Model
{
    public function getListaDeProdutos(){

        
        return array('Caneca', 'Casaco','Caneta','Capela','Catraca');
        
    }
    use HasFactory;

    //public static function cadastrar(Request $request){
     public static function cadastrar($descricao, $valor){

        if(isset($descricao)== FALSE|| strlen($descricao)<5){
            return "Descricao Invalida";
        }else if(isset($valor)==FALSE || filter_var($valor,FILTER_VALIDATE_FLOAT)==FALSE){
            return "Valor Invalida";
        }else{

            return "Sucesso";
        }


    }
}
