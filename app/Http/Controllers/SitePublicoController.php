<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
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
    public function Agendamentos(Request $request){
        $agenda=agenda::where('agenda.tipo','=','AGENDAMENTO')->get();
        $allClientes=cliente::all();

        if(isset($request->inputCodCliente)&&isset($request->DtInicial)&&isset($request->DtFinal)){
            $allClientes=cliente::all();
            $Filtro=agenda::where('agenda.tipo','=','AGENDAMENTO')
                            ->where('agenda.cliente','=',$request->inputCodCliente)
                            ->whereBetween('agenda.data_agenda',[$request->DtInicial,$request->DtFinal])
                            ->get();

            return view(' viewAgenda',['agenda'=> $Filtro],['clientes'=> $allClientes]);

        }else if(isset($request->inputCodCliente)){
            $allClientes=cliente::all();
            $Filtro=agenda::where('agenda.tipo','=','AGENDAMENTO')
                            ->where('agenda.cliente','=',$request->inputCodCliente)
                            ->get();

            return view(' viewAgenda',['agenda'=> $Filtro],['clientes'=> $allClientes]);

        }else if(isset($request->DtInicial)&&isset($request->DtFinal)){
            $allClientes=cliente::all();
            $Filtro=agenda::where('agenda.tipo','=','AGENDAMENTO')
                            ->whereBetween('agenda.data_agenda',[$request->DtInicial,$request->DtFinal])
                            ->get();

            return view(' viewAgenda',['agenda'=> $Filtro],['clientes'=> $allClientes]);


        }else{
            
            if($request->input('inputCliAgenda')==null){
                
                $allClientes=cliente::all();
                $agenda=agenda::where('agenda.tipo','=','AGENDAMENTO')->get();

            }else if(null!==$request->input('inputCliAgenda')&& strlen($request->input('inputCliAgenda'))<15){

                $agenda=agenda::where('agenda.tipo','=','AGENDAMENTO')->get();
                $allClientes=cliente::where('clientes.CPF','=',$request->inputCliAgenda)->get();
                                
                return view(' viewAgenda',['agenda'=> $agenda],['clientes'=> $allClientes]);
                
            }else{

                $agenda=agenda::where('agenda.tipo','=','AGENDAMENTO')->get();
                $allClientes=cliente::where('clientes.CNPJ','like','%'.$request->inputCliAgenda.'%')->get();
           }

            
            $agenda=agenda::where('agenda.tipo','=','AGENDAMENTO')->get();
                
            return view(' viewAgenda',['agenda'=> $agenda],['clientes'=> $allClientes]);
        }
        
        return view('viewAgenda',['agenda'=> $agenda]);
    }
    public function AgendamentosFiltrados(Request $request){
        $allClientes=cliente::all();
               
        if(isset($request->inputCodCliente)&&isset($request->DtInicial)&&isset($request->DtFinal)){
            $allClientes=cliente::all();
            $Filtro=agenda::where('agenda.tipo','=','AGENDAMENTO')
                            ->where('agenda.cliente','=',$request->inputCodCliente)
                            ->whereBetween('agenda.data_agenda',[$request->DtInicial,$request->DtFinal])
                            ->get();

            return view('viewAgendamentosFiltrados',['agenda'=> $Filtro],['clientes'=> $allClientes]);

        }else if(isset($request->inputCodCliente)){
            $allClientes=cliente::all();
            $Filtro=agenda::where('agenda.tipo','=','AGENDAMENTO')
                            ->where('agenda.cliente','=',$request->inputCodCliente)
                            ->get();

            return view('viewAgendamentosFiltrados',['agenda'=> $Filtro],['clientes'=> $allClientes]);

        }else if(isset($request->DtInicial)&&isset($request->DtFinal)){
            $allClientes=cliente::all();
            $Filtro=agenda::where('agenda.tipo','=','AGENDAMENTO')
                            ->whereBetween('agenda.data_agenda',[$request->DtInicial,$request->DtFinal])
                            ->get();

            return view('viewAgendamentosFiltrados',['agenda'=> $Filtro],['clientes'=> $allClientes]);


        }else{
            
            if($request->input('myInput')==null){
                
                $allClientes=cliente::all();
                $agenda=agenda::where('agenda.tipo','=','AGENDAMENTO')->get();

            }else if(null!==$request->input('myInput')&& strlen($request->input('myInput'))<15){

                $agenda=agenda::where('agenda.tipo','=','AGENDAMENTO')->get();
                $allClientes=cliente::where('clientes.CPF','=',$request->myInput)->get();
                                
                return view('viewAgendamentosFiltrados',['agenda'=> $agenda],['clientes'=> $allClientes]);
                
            }else{

                $agenda=agenda::where('agenda.tipo','=','AGENDAMENTO')->get();
                $allClientes=cliente::where('clientes.CNPJ','like','%'.$request->myInput.'%')->get();
           }

            
            $agenda=agenda::where('agenda.tipo','=','AGENDAMENTO')->get();
                
            return view('viewAgendamentosFiltrados',['agenda'=> $agenda],['clientes'=> $allClientes]);
        }
    }
    public function CadastrarAgendamentos(Request $request){

        
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
