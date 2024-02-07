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

       
        if(isset($request->CodCliente)&&isset($request->DtInicial)&&isset($request->DtFinal)){
            
            $Filtro=agenda::where('agenda.tipo','=','AGENDAMENTO')
                            ->where('agenda.cliente','=',$request->CodCliente)
                            ->whereBetween('agenda.data_agenda',[$request->DtInicial,$request->DtFinal])
                            ->get();

            return view('viewAgendamentosFiltrados',['agenda'=> $Filtro]);

        }else if(isset($request->CodCliente)){

            $Filtro=agenda::where('agenda.tipo','=','AGENDAMENTO')
                            ->where('agenda.cliente','=',$request->CodCliente)
                            ->get();

            return view('viewAgendamentosFiltrados',['agenda'=> $Filtro]);

        }else if(isset($request->DtInicial)&&isset($request->DtFinal)){
            
            $Filtro=agenda::where('agenda.tipo','=','AGENDAMENTO')
                            ->whereBetween('agenda.data_agenda',[$request->DtInicial,$request->DtFinal])
                            ->get();

            return view('viewAgendamentosFiltrados',['agenda'=> $Filtro]);


        }else{
            $agenda=agenda::where('agenda.tipo','=','AGENDAMENTO')->get();
           

            return view('viewAgenda',['agenda'=> $agenda]);
        }

        //return view('viewAgendamentosFiltrados');

    }
    public function Atendimentos(){
      
        return view('viewAtendimento');
    }
    public function Treinamentos(){
      
        return view('viewTreinamento');
    }
  
}
