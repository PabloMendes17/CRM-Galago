<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\agenda;
use App\Models\cliente;


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
    public function AgendamentosFiltrados(Request $request){

       
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
            $allClientes=cliente::all();
        
        
            $agenda=agenda::where('agenda.tipo','=','AGENDAMENTO')->get();
           

            return view('viewAgendamentosFiltrados',['agenda'=> $agenda],['clientes'=> $allClientes]);
        }



    }

    public function ClientesAgenda(){
        
        $allClientes=cliente::all();
        
        return view('viewAgendamentosFiltrados',['CLI'=> $allClientes]);

       /* if(isset($request->cnpj_cpf)&&mb_strlen($request->cnpj_cpf)>14){
            

            $clientes=cliente::where('clientes.CNPJ','=',$request->cnpj_cpf);

            return view('viewAgendamentosFiltrados',['clientes'=>$clientes]);
        }else if(isset($request->cnpj_cpf)&&mb_strlen($request->cnpj_cpf)==14){

            $clientes=cliente::where('clientes.CPF','=',$request->cnpj_cpf);

            return view('viewAgendamentosFiltrados',['clientes'=>$clientes]);
        }else{
            $agenda=agenda::where('agenda.tipo','=','AGENDAMENTO')->get();
           
            return view('viewAgendamentosFiltrados',['agenda'=> $agenda]);
        }*/
    
    }

    public function lista(Request $request)
    {
        $cnpj_cpf = $request->input('cnpj_cpf');

        $usuarios = cliente::where('CPF', 'LIKE', "%$cnpj_cpf%")->limit(20)->get();

        return response()->json($usuarios);
    }




    public function Atendimentos(){
        $atendimentos=agenda::where('agenda.tipo','=','ATENDIMENTO')->get();;
        
        return view('viewAtendimento',['atendimentos'=> $atendimentos]);
    }

    public function AtendimentosFiltrados(Request $request ){

       
        if(isset($request->CodCliente)&&isset($request->DtInicial)&&isset($request->DtFinal)){
            
            $Filtro=agenda::where('agenda.tipo','=','ATENDIMENTO')
                            ->where('agenda.cliente','=',$request->CodCliente)
                            ->whereBetween('agenda.data_agenda',[$request->DtInicial,$request->DtFinal])
                            ->get();

            return view('viewAtendimentosFiltrados',['atendimentos'=> $Filtro]);

        }else if(isset($request->CodCliente)){

            $Filtro=agenda::where('agenda.tipo','=','ATENDIMENTO')
                            ->where('agenda.cliente','=',$request->CodCliente)
                            ->get();

            return view('viewAtendimentosFiltrados',['atendimentos'=> $Filtro]);

        }else if(isset($request->DtInicial)&&isset($request->DtFinal)){
            
            $Filtro=agenda::where('agenda.tipo','=','ATENDIMENTO')
                            ->whereBetween('agenda.data_agenda',[$request->DtInicial,$request->DtFinal])
                            ->get();

            return view('viewAtendimentosFiltrados',['atendimentos'=> $Filtro]);


        }else{
            $Filtro=agenda::where('agenda.tipo','=','ATENDIMENTO')->get();
           

            return view('viewAtendimentosFiltrados',['atendimentos'=> $Filtro]);
        }
    }

    public function Treinamentos(){
      
        $treinamentos=agenda::where('agenda.tipo','=','TREINAMENTO')->get();;
        
        return view('viewTreinamento',['treinamentos'=> $treinamentos]);
    }

    public function TreinamentosFiltrados(Request $request ){

       
        if(isset($request->CodCliente)&&isset($request->DtInicial)&&isset($request->DtFinal)){
            
            $Filtro=agenda::where('agenda.tipo','=','TREINAMENTO')
                            ->where('agenda.cliente','=',$request->CodCliente)
                            ->whereBetween('agenda.data_agenda',[$request->DtInicial,$request->DtFinal])
                            ->get();

            return view('viewTreinamentosFiltrados',['treinamentos'=> $Filtro]);

        }else if(isset($request->CodCliente)){

            $Filtro=agenda::where('agenda.tipo','=','TREINAMENTO')
                            ->where('agenda.cliente','=',$request->CodCliente)
                            ->get();

            return view('viewTreinamentosFiltrados',['treinamentos'=> $Filtro]);

        }else if(isset($request->DtInicial)&&isset($request->DtFinal)){
            
            $Filtro=agenda::where('agenda.tipo','=','ATENDIMENTO')
                            ->whereBetween('agenda.data_agenda',[$request->DtInicial,$request->DtFinal])
                            ->get();

            return view('viewTreinamentosFiltrados',['treinamentos'=> $Filtro]);


        }else{
            $Filtro=agenda::where('agenda.tipo','=','TREINAMENTO')->get();
           

            return view('viewTreinamentosFiltrados',['treinamentos'=> $Filtro]);
        }
    }
  
}
