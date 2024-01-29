<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParametrosController extends Controller
{
    public function acessandoParametrosViaRequest(Request $request){
            $produtos=array('Php','Java','C#','Sql');
            if(isset($request->prodId)){
                $buffer="Curso Selecionado: ".$produtos[$request->prodId];
            }else{
                $buffer='Produtos não selecionado';
            }
        return view('viewAcessandoParametros',compact('buffer'));
    }

    public function formularioExibir(){
        return view('viewFormularioExibir');
    }
    public function formularioReceber(Request $request){
        $buffer='Pelo Formulario: ';
        if(isset($request->nomeuser)){
            $buffer.=$request->nomeuser;
        }
        return view('viewFormularioReceber',compact('buffer'));
    }
}
