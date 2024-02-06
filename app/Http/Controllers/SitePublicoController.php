<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\agenda;


class SitePublicoController extends Controller
{
    public function paginaPrincipal(){
        $user="Pablo";

        return view('viewpaginaPrincipal')->with ('user',$user);
    }

    public function produtos(){

        $produtos=array('TV','Celular','Notebook','modem');

        return view('viewProdutos')->with ('produtos',$produtos);
    }
    public function info(){

        $user="Nos Desenvolvemos";
        $produtos=array('Site','MobileApps','DeskTopApps');

        return view('viewInfo',compact('user','produtos'));
    }
    public function Agendamentos(){
        $agenda=agenda::where('agenda.tipo','=','AGENDAMENTO')->get();;
        
        return view('viewAgenda',['agenda'=> $agenda]);
    }
    public function AgendamentosFiltrados(Request $request ){
        if(isset($request->CodCliente)&&isset($request->DtInicial)&&isset($request->DtInicial)){

        }else if(isset($request->CodCliente)){

        }else if(isset($request->DtInicial)&&isset($request->DtInicial)){

        }else{
            return view('viewAgenda');
        }

        return view('viewAgendamentosFiltrados');

    }
    public function Atendimentos(){
      
        return view('viewAtendimento');
    }
    public function Treinamentos(){
      
        return view('viewTreinamento');
    }
  
}
