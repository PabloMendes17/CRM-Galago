<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DateTimeZone;
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
        Carbon::setLocale('pt_BR');
        Carbon::setLocale('pt_BR.utf-8');
        Carbon::setLocale('portuguese');

        $date = Carbon::now('America/Sao_Paulo');
        $formatted_dateCarbon = $date->isoFormat('ddd DD [de] MMM YYYY HH:mm');

        $dataAtual = Carbon::now()->toDateString();
        $agenda = agenda::where('agenda.tipo', '=', 'AGENDAMENTO')
               ->where('agenda.data_agenda', '=', $dataAtual)
               ->orderBy('agenda.data_agenda')
               ->orderBy('agenda.hora_agenda')
               ->get();

        $allClientes=cliente::all();

        if(isset($request->inputCodCliente)&&isset($request->DtInicial)&&isset($request->DtFinal)){
            $allClientes=cliente::all();
            $Filtro=agenda::where('agenda.tipo','=','AGENDAMENTO')
                            ->where('agenda.cliente','=',$request->inputCodCliente)
                            ->whereBetween('agenda.data_agenda',[$request->DtInicial,$request->DtFinal])
                            ->get();

            return view(' viewAgenda',['agenda'=> $Filtro],['clientes'=> $allClientes])->with('DATA',$formatted_dateCarbon);

        }else if(isset($request->inputCodCliente)){
            $allClientes=cliente::all();
            $Filtro=agenda::where('agenda.tipo','=','AGENDAMENTO')
                            ->where('agenda.cliente','=',$request->inputCodCliente)
                            ->get();

            return view(' viewAgenda',['agenda'=> $Filtro],['clientes'=> $allClientes])->with('DATA',$formatted_dateCarbon);

        }else if(isset($request->DtInicial)&&isset($request->DtFinal)){
            $allClientes=cliente::all();
            $Filtro=agenda::where('agenda.tipo','=','AGENDAMENTO')
                            ->whereBetween('agenda.data_agenda',[$request->DtInicial,$request->DtFinal])
                            ->get();

            return view(' viewAgenda',['agenda'=> $Filtro],['clientes'=> $allClientes])->with('DATA',$formatted_dateCarbon);
            //return redirect()->route('/Agendamentos')->with('success', 'Operação Realizada com Sucesso');


        }else if(isset($request->inputCliAgenda)&& strlen($request->inputCliAgenda)<14){
            
            
            $agenda=agenda::where('agenda.tipo','=','AGENDAMENTO')->get();
            $allClientes=cliente::where('clientes.CODIGO','=',$request->inputCliAgenda)->get();
                            
            return view(' viewAgenda',['agenda'=> $agenda],['clientes'=> $allClientes])->with('DATA',$formatted_dateCarbon);
        }else{
            
            if($request->input('inputCliAgenda')===null&&$request->input('inputCliAgenda')!==''){

                $allClientes=cliente::all();
                $agenda = agenda::where('agenda.tipo', '=', 'AGENDAMENTO')
               ->where('agenda.data_agenda', '=', $dataAtual)
               ->orderBy('agenda.data_agenda')
               ->orderBy('agenda.hora_agenda')
               ->get();
             

            }else if(null!==$request->input('inputCliAgenda')&& strlen($request->input('inputCliAgenda'))<15){

                $agenda = agenda::where('agenda.tipo', '=', 'AGENDAMENTO')
               ->where('agenda.data_agenda', '=', $dataAtual)
               ->orderBy('agenda.data_agenda')
               ->orderBy('agenda.hora_agenda')
               ->get();
             
                $allClientes=cliente::where('clientes.CPF','=',$request->inputCliAgenda)->get();
                                
                return view(' viewAgenda',['agenda'=> $agenda],['clientes'=> $allClientes])->with('DATA',$formatted_dateCarbon);
                
            }else{

                $agenda = agenda::where('agenda.tipo', '=', 'AGENDAMENTO')
               ->where('agenda.data_agenda', '=', $dataAtual)
               ->orderBy('agenda.data_agenda')
               ->orderBy('agenda.hora_agenda')
               ->get();
             
                $allClientes=cliente::where('clientes.CNPJ','like','%'.$request->inputCliAgenda.'%')->get()->with('DATA',$formatted_dateCarbon);
           }

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



            
           $agenda = agenda::where('agenda.tipo', '=', 'AGENDAMENTO')
           ->where('agenda.data_agenda', '=', $dataAtual)
           ->orderBy('agenda.data_agenda')
           ->orderBy('agenda.hora_agenda')
           ->get();
         
                
            return view(' viewAgenda',['agenda'=> $agenda],['clientes'=> $allClientes])->with('DATA',$formatted_dateCarbon);
        }
        
        
        return view('viewAgenda',['agenda'=> $agenda])->with('DATA',$formatted_dateCarbon);
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
        if(isset($request->inputNomeClienteAG)){
            
            $insereNovaAgenda = [ 
                'CONTATO' => $request->input('CONTATO'),
                'OPERADOR' => $request->input('OPERADOR'),
                'ASSUNTO' => $request->input('ASSUNTO'),
                'CLIENTE' => $request->input('inputCodClienteAG'),
                'DATA_GRAVACAO' => $request->input('DATA_GRAVACAO'),
                'DATA_AGENDA' => $request->input('DATA_AGENDA'),
                'HORA_AGENDA' => $request->input('HORA_AGENDA'),
                'SITUACAO' => $request->input('SITUACAO'),
                'TIPO' => $request->input('TIPO'),
                'HISTORICO' => $request->input('HISTORICO'),
                'TELEFONE1' => $request->input('TELEFONE1'), 
            ];

            agenda::create($insereNovaAgenda); 
            return view('viewSucessoCadastroAgenda');
        }
        

    }
  


    public function Atendimentos(Request $request){

        Carbon::setLocale('pt_BR');
        Carbon::setLocale('pt_BR.utf-8');
        Carbon::setLocale('portuguese');

        $date = Carbon::now('America/Sao_Paulo');
        $formatted_dateCarbon = $date->isoFormat('ddd DD [de] MMM YYYY HH:mm');

	    $dataAtual = Carbon::now()->toDateString();
        $atendimentos= agenda::where('agenda.tipo', '=', 'ATENDIMENTO')
               ->where('agenda.data_agenda', '=', $dataAtual)
               ->orderBy('agenda.data_agenda')
               ->orderBy('agenda.hora_agenda')
               ->get();


        $allClientes=cliente::all();

        if(isset($request->inputCodCliente)&&isset($request->DtInicial)&&isset($request->DtFinal)){
            
            $Filtro=agenda::where('agenda.tipo','=','ATENDIMENTO')
                            ->where('agenda.cliente','=',$request->inputCodCliente)
                            ->whereBetween('agenda.data_agenda',[$request->DtInicial,$request->DtFinal])
                            ->get();

            return view('viewAtendimento',['atendimentos'=> $Filtro],['clientes'=> $allClientes])->with('DATA',$formatted_dateCarbon);

        }else if(isset($request->inputCodCliente)){

            $Filtro=agenda::where('agenda.tipo','=','ATENDIMENTO')
                            ->where('agenda.cliente','=',$request->inputCodCliente)
                            ->get();

            return view('viewAtendimento',['atendimentos'=> $Filtro],['clientes'=> $allClientes])->with('DATA',$formatted_dateCarbon);

        }else if(isset($request->DtInicial)&&isset($request->DtFinal)){
            
            $Filtro=agenda::where('agenda.tipo','=','ATENDIMENTO')
                            ->whereBetween('agenda.data_agenda',[$request->DtInicial,$request->DtFinal])
                            ->get();

            return view('viewAtendimento',['atendimentos'=> $Filtro],['clientes'=> $allClientes])->with('DATA',$formatted_dateCarbon);


        }else if(isset($request->inputCliAtendimento)&&strlen($request->inputCliAtendimento)<14){

		$atendimentos=agenda::where('agenda.tipo','=','AGENDAMENTO')->get();
            $allClientes=cliente::where('clientes.CODIGO','=',$request->inputCliAtendimento)->get();
                            
            return view(' viewAtendimento',['atendimento'=> $atendimentos],['clientes'=> $allClientes])->with('DATA',$formatted_dateCarbon);

	    }else{
            If($request->input('inputCliAtendimento')===null&&$request->input('inputCliAtendimento')!==''){
                
                $allClientes=cliente::all();
                $atendimentos = agenda::where('agenda.tipo', '=', 'ATENDIMENTO')
                        ->where('agenda.data_agenda', '=', $dataAtual)
                        ->orderBy('agenda.data_agenda')
                        ->orderBy('agenda.hora_agenda')
                        ->get();
            
            }else if(null!==$request->input('inputCliAtendimento')&&strlen($request->input('inputCliAtendimento'))<15){

                $atendimentos = agenda::where('agenda.tipo', '=', 'ATENDIMENTO')
                        ->where('agenda.data_agenda', '=', $dataAtual)
                        ->orderBy('agenda.data_agenda')
                        ->orderBy('agenda.hora_agenda')
                        ->get();
                
                    $allClientes=cliente::where('clientes.CPF','=',$request->inputCliAtendimento)->get();
                                    
                    return view(' viewAtendimento',['atendimento'=> $atendimentos ],['clientes'=> $allClientes])->with('DATA',$formatted_dateCarbon);

            }else{
            
            $atendimentos = agenda::where('agenda.tipo', '=', 'ATENDIMENTO')
                    ->where('agenda.data_agenda', '=', $dataAtual)
                    ->orderBy('agenda.data_agenda')
                    ->orderBy('agenda.hora_agenda')
                    ->get();
                
                    $allClientes=cliente::where('clientes.CNPJ','like','%'.$request->inputCliAtendimento.'%')->get()->with('DATA',$formatted_dateCarbon);		

            }
            
            if($request->input('myInput')==null){
                
                $allClientes=cliente::all();
                $agenda=agenda::where('agenda.tipo','=','AGENDAMENTO')->get();

            }else if(null!==$request->input('myInput')&& strlen($request->input('myInput'))<15){

                $agenda=agenda::where('agenda.tipo','=','AGENDAMENTO')->get();
                $allClientes=cliente::where('clientes.CPF','=',$request->myInput)->get();
                                
                return view('viewAtendimento',['agenda'=> $agenda],['clientes'=> $allClientes]);
                
            }else{

                $agenda=agenda::where('agenda.tipo','=','AGENDAMENTO')->get();
                $allClientes=cliente::where('clientes.CNPJ','like','%'.$request->myInput.'%')->get();
           }


            
                $atendimentos = agenda::where('agenda.tipo', '=', 'ATENDIMENTO')
                    ->where('agenda.data_agenda', '=', $dataAtual)
                    ->orderBy('agenda.data_agenda')
                    ->orderBy('agenda.hora_agenda')
                    ->get();
            

                return view('viewAtendimento',['atendimentos'=> $atendimentos],['clientes'=> $allClientes])->with('DATA',$formatted_dateCarbon);
        }
        
        return view('viewAtendimento',['atendimentos'=> $atendimentos],['clientes'=> $allClientes])->with('DATA',$formatted_dateCarbon);
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
        Carbon::setLocale('pt_BR');
        Carbon::setLocale('pt_BR.utf-8');
        Carbon::setLocale('portuguese');

        $date = Carbon::now('America/Sao_Paulo');
        $formatted_dateCarbon = $date->isoFormat('ddd DD [de] MMM YYYY HH:mm');
      
        $treinamentos=agenda::where('agenda.tipo','=','TREINAMENTO')->get();
        
        return view('viewTreinamento',['treinamentos'=> $treinamentos])->with('DATA',$formatted_dateCarbon);
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
