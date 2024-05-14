<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Exception;
use App\Models\agenda;
use App\Models\cliente;
use App\Models\SITUACAO_AGENDA;


class SitePublicoController extends Controller
{
    public function viewTEST(){
        return view('viewTEST');
    }
    public function paginaPrincipal(){
        
        Carbon::setLocale('pt_BR');
        Carbon::setLocale('pt_BR.utf-8');
        Carbon::setLocale('portuguese');
    
        $date = Carbon::now('America/Sao_Paulo');
        $formatted_dateCarbon = $date->isoFormat('ddd DD [de] MMM YYYY HH:mm');
        $dataAtual = Carbon::now()->toDateString();

        return view('viewpaginaPrincipal')->with('DATA',$formatted_dateCarbon);
    }

    public function Agendamentos(Request $request){

        
        Carbon::setLocale('pt_BR');
        Carbon::setLocale('pt_BR.utf-8');
        Carbon::setLocale('portuguese');
    
        $date = Carbon::now('America/Sao_Paulo');
        $formatted_dateCarbon = $date->isoFormat('ddd DD [de] MMM YYYY HH:mm');


        try{

            $dataAtual = Carbon::now()->toDateString();
            $allClientes = DB::table('clientes')->paginate(20);

            $Situacoes=situacao_agenda::all();
            $agenda = agenda::where('agenda.tipo', '=', 'AGENDAMENTO')
                ->where('agenda.data_agenda', '=', $dataAtual)
                ->orderBy('agenda.data_agenda')
                ->orderBy('agenda.hora_agenda')
                ->get();
         
            if(isset($request->inputCodCliente)&&isset($request->DtInicial)&&isset($request->DtFinal)){

                try{
                    $Filtro=agenda::where('agenda.tipo','=','AGENDAMENTO')
                                ->where('agenda.cliente','=',$request->inputCodCliente)
                                ->whereBetween('agenda.data_agenda',[$request->DtInicial,$request->DtFinal])
                                ->get();
            
                    return view(' viewAgenda',['agenda'=> $Filtro,'clientes'=> $allClientes, 'situacoes' => $Situacoes])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Sua Consulta não pode ser realizada, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAgenda',['agenda' => $agenda, 'clientes' => $allClientes, 'situacoes' => $Situacoes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
                }
        
            }else if(isset($request->inputCodCliente)){

                try{
                            
                    $Filtro=agenda::where('agenda.tipo','=','AGENDAMENTO')
                                    ->where('agenda.cliente','=',$request->inputCodCliente)
                                    ->get();
            
                    return view(' viewAgenda',['agenda'=> $Filtro,'clientes'=> $allClientes, 'situacoes' => $Situacoes])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Sua Consulta não pode ser realizada, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAgenda',['agenda' => $agenda, 'clientes' => $allClientes, 'situacoes' => $Situacoes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
                }

            }else if(isset($request->DtInicial)&&isset($request->DtFinal)){

                try{
                            
                    $Filtro=agenda::where('agenda.tipo','=','AGENDAMENTO')
                                    ->whereBetween('agenda.data_agenda',[$request->DtInicial,$request->DtFinal])
                                    ->get();
            
                    return view(' viewAgenda',['agenda'=> $Filtro,'clientes'=> $allClientes, 'situacoes' => $Situacoes])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Sua Consulta não pode ser realizada, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAgenda',['agenda' => $agenda, 'clientes' => $allClientes, 'situacoes' => $Situacoes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
                }
            }

            if(null!==$request->input('inputCliAgenda') && strlen($request->input('inputCliAgenda'))==14){

                try{

                    $allClientes= DB::table('clientes')
                                ->where('clientes.CPF', '=', $request->inputCliAgenda)
                                 ->get();
                                    
                    return view(' viewAgenda',['agenda'=> $agenda,'clientes'=> $allClientes, 'situacoes' => $Situacoes])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Sua Consulta não pode ser realizada, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAgenda',['agenda' => $agenda, 'clientes' => $allClientes, 'situacoes' => $Situacoes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
                }
            
            }else if(null!==$request->input('inputCliAgenda') && strlen($request->input('inputCliAgenda'))==18){
                
                try{
                    
                    $allClientes=DB::table('clientes')->where('clientes.CNPJ','like','%'.$request->inputCliAgenda.'%')->get();
            
                    return view(' viewAgenda',['agenda'=> $agenda,'clientes'=> $allClientes, 'situacoes' => $Situacoes])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Sua Consulta não pode ser realizada, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAgenda',['agenda' => $agenda, 'clientes' => $allClientes, 'situacoes' => $Situacoes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
                }
            }else if(null!==$request->input('inputCliAgenda') && strlen($request->input('inputCliAgenda'))<14){
                
                try{
                    $allClientes=DB::table('clientes')->where('clientes.codigo','=',$request->inputCliAgenda)->get();
            
                    return view(' viewAgenda',['agenda'=> $agenda,'clientes'=> $allClientes, 'situacoes' => $Situacoes])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Sua Consulta não pode ser realizada, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAgenda',['agenda' => $agenda, 'clientes' => $allClientes, 'situacoes' => $Situacoes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
                }
            }
            if(null!==$request->input('razaoFiltro')&&strlen($request->input('razaoFiltro'))>2){
                
                try{

                    $allClientes=DB::table('clientes')->where('clientes.nome','like','%'.$request->razaoFiltro.'%')->get();
                                            
                    return view(' viewAgenda',['agenda'=> $agenda,'clientes'=> $allClientes, 'situacoes' => $Situacoes])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Sua Consulta não pode ser realizada, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAgenda',['agenda' => $agenda, 'clientes' => $allClientes, 'situacoes' => $Situacoes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
                }
            }
            if(null!==$request->input('razaoAG')&&strlen($request->input('razaoAG'))>2){
                
                try{

                    $allClientes=DB::table('clientes')->where('clientes.nome','like','%'.$request->razaoAG.'%')->get();
                                            
                    return view(' viewAgenda',['agenda'=> $agenda,'clientes'=> $allClientes, 'situacoes' => $Situacoes])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Sua Consulta não pode ser realizada, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAgenda',['agenda' => $agenda, 'clientes' => $allClientes, 'situacoes' => $Situacoes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
                }
            }

            if(null!==$request->input('myInput')&& strlen($request->input('myInput'))<15){
                    
                try{

                    $allClientes=DB::table('clientes')->where('clientes.CPF','=',$request->myInput)->get();
                                            
                    return view(' viewAgenda',['agenda'=> $agenda,'clientes'=> $allClientes, 'situacoes' => $Situacoes])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Sua Consulta não pode ser realizada, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAgenda',['agenda' => $agenda, 'clientes' => $allClientes, 'situacoes' => $Situacoes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
                }
                        
            }else  if(null!==$request->input('myInput')&& strlen($request->input('myInput'))>14){

                try{
                                
                    $allClientes=DB::table('clientes')->where('clientes.CNPJ','like','%'.$request->myInput.'%')->get();
                
                    return view(' viewAgenda',['agenda'=> $agenda,'clientes'=> $allClientes, 'situacoes' => $Situacoes])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Sua Consulta não pode ser realizada, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAgenda',['agenda' => $agenda, 'clientes' => $allClientes, 'situacoes' => $Situacoes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
                }
            }    return view(' viewAgenda',['agenda'=> $agenda,'clientes'=> $allClientes, 'situacoes' => $Situacoes])->with('DATA',$formatted_dateCarbon);    
            
        }catch(Exception $e){

            $erroMsm='Não foi possível acessar o serviço, tente novamente mais tarde ou entre em contato com o responsável do sistema.'; 
            return view('viewpaginaPrincipal',[ 'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);

        }    

        
    }
    public function CadastrarAgendamentos(Request $request){

        Carbon::setLocale('pt_BR');
        Carbon::setLocale('pt_BR.utf-8');
        Carbon::setLocale('portuguese');
    
        $date = Carbon::now('America/Sao_Paulo');
        $formatted_dateCarbon = $date->isoFormat('ddd DD [de] MMM YYYY HH:mm');

        try{

            $dataAtual = Carbon::now()->toDateString();
            $allClientes = DB::table('clientes')->paginate(20);
            $Situacoes=situacao_agenda::all();
            $agenda = agenda::where('agenda.tipo', '=', 'AGENDAMENTO')
                ->where('agenda.data_agenda', '=', $dataAtual)
                ->orderBy('agenda.data_agenda')
                ->orderBy('agenda.hora_agenda')
                ->get();

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
            return view('viewSucessoCadastroAgenda')->with('DATA',$formatted_dateCarbon);
        }

        }catch(Exception $e){

            $erroMsm='Não foi possível registrar o Treinamento, verifique os dados informados ou contate o resposável pelo sistema.';           
            return response()->view('viewAgenda',['agenda' => $agenda, 'clientes' => $allClientes,'situacoes'=>$Situacoes,
                                    'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);

        }
             

    }
  
    public function Atendimentos(Request $request){
        Carbon::setLocale('pt_BR');
        Carbon::setLocale('pt_BR.utf-8');
        Carbon::setLocale('portuguese');
        $date = Carbon::now('America/Sao_Paulo');
        $formatted_dateCarbon = $date->isoFormat('ddd DD [de] MMM YYYY HH:mm');
    
        try{

            $dataAtual = Carbon::now()->toDateString();
            $allClientes = DB::table('clientes')->paginate(20);
            $Situacoes=situacao_agenda::all();
            $atendimentos = agenda::where('agenda.tipo', '=', 'ATENDIMENTO')
                ->where('agenda.data_agenda', '=', $dataAtual)
                ->orderBy('agenda.data_agenda')
                ->orderBy('agenda.hora_agenda')
                ->get();
            
          
        
            if(isset($request->inputCodCliente)&&isset($request->DtInicial)&&isset($request->DtFinal)){
                
                try{ 
                    $Filtro=agenda::where('agenda.tipo','=','ATENDIMENTO')
                                    ->where('agenda.cliente','=',$request->inputCodCliente)
                                    ->whereBetween('agenda.data_agenda',[$request->DtInicial,$request->DtFinal])
                                    ->get();
            
                    return view(' viewAtendimento',['atendimento'=> $Filtro,'clientes'=> $allClientes, 'situacoes' => $Situacoes])->with('DATA',$formatted_dateCarbon);
                }catch(Exception $e){

                    $erroMsm='Sua Consulta não pode ser realizada, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAtendimento',['atendimento' => $atendimentos, 'clientes' => $allClientes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon,]);
                }    
            
            }else if(isset($request->inputCodCliente)){
                
                try{
                    $Filtro=agenda::where('agenda.tipo','=','ATENDIMENTO')
                    ->where('agenda.cliente','=',$request->inputCodCliente)
                    ->get();

                    return view(' viewAtendimento',['atendimento'=> $Filtro,'clientes'=> $allClientes, 'situacoes' => $Situacoes])->with('DATA',$formatted_dateCarbon);
                }catch(Exception $e){

                    $erroMsm='Sua Consulta não pode ser realizada, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAtendimento',['atendimento' => $atendimentos, 'clientes' => $allClientes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon,]);
                } 
       
            }else if(isset($request->DtInicial)&&isset($request->DtFinal)){

                try{
                    $Filtro=agenda::where('agenda.tipo','=','ATENDIMENTO')
                                ->whereBetween('agenda.data_agenda',[$request->DtInicial,$request->DtFinal])
                                ->get();
        
                    return view(' viewAtendimento',['atendimento'=> $Filtro,'clientes'=> $allClientes, 'situacoes' => $Situacoes])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Sua Consulta não pode ser realizada, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAtendimento',['atendimento' => $atendimentos, 'clientes' => $allClientes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon,]);
                } 
            }
        
            if(null!==$request->input('inputCliAtendimento') && strlen($request->input('inputCliAtendimento'))==14){
                
                try{
                    $allClientes=DB::table('clientes')->where('clientes.CPF','=',$request->inputCliAtendimento)->get();
                                
                    return view(' viewAtendimento',['atendimento'=> $atendimentos,'clientes'=> $allClientes, 'situacoes' => $Situacoes])->with('DATA',$formatted_dateCarbon);
                    
                }catch(Exception $e){

                    $erroMsm='Cliente não Localizado, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAtendimento',['atendimento' => $atendimentos, 'clientes' => $allClientes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
                }
            }else if(null!==$request->input('inputCliAtendimento') && strlen($request->input('inputCliAtendimento'))==18){

                try{
                                    
                    $allClientes=DB::table('clientes')->where('clientes.CNPJ','like','%'.$request->inputCliAtendimento.'%')->get();
            
                    return view(' viewAtendimento',['atendimento'=> $atendimentos,'clientes'=> $allClientes, 'situacoes' => $Situacoes])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Cliente não Localizado, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAtendimento',['atendimento' => $atendimentos, 'clientes' => $allClientes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
                }


            }else if(null!==$request->input('inputCliAtendimento') && strlen($request->input('inputCliAtendimento'))<14){

                try{
                                    
                $allClientes=DB::table('clientes')->where('clientes.codigo','=',$request->inputCliAtendimento)->get();
        
                return view(' viewAtendimento',['atendimento'=> $atendimentos,'clientes'=> $allClientes, 'situacoes' => $Situacoes])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Cliente não Localizado, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAtendimento',['atendimento' => $atendimentos, 'clientes' => $allClientes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
                }

            }
            if(null!==$request->input('razaoFiltro')&&strlen($request->input('razaoFiltro'))>2){
                
                try{

                    $allClientes=DB::table('clientes')->where('clientes.nome','like','%'.$request->razaoFiltro.'%')->get();
                                            
                    return view(' viewAtendimento',['atendimento'=> $atendimentos,'clientes'=> $allClientes, 'situacoes' => $Situacoes])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Cliente não Localizado, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAtendimento',['atendimento' => $atendimentos, 'clientes' => $allClientes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
                }
            }
            if(null!==$request->input('razaoAT')&&strlen($request->input('razaoAT'))>2){
                
                try{

                    $allClientes=DB::table('clientes')->where('clientes.nome','like','%'.$request->razaoAT.'%')->get();
                                            
                    return view(' viewAtendimento',['atendimento'=> $atendimentos,'clientes'=> $allClientes, 'situacoes' => $Situacoes])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Cliente não Localizado, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAtendimento',['atendimento' => $atendimentos, 'clientes' => $allClientes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
                }
            }
        
            if(null!==$request->input('myInput')&& strlen($request->input('myInput'))<15){
            
                try{
                            
                    $allClientes=DB::table('clientes')->where('clientes.CPF','=',$request->myInput)->get();
                                        
                    return view(' viewAtendimento',['atendimento'=> $atendimentos,'clientes'=> $allClientes, 'situacoes' => $Situacoes])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Cliente não Localizado, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAtendimento',['atendimento' => $atendimentos, 'clientes' => $allClientes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
                }

                    
            }else  if(null!==$request->input('myInput')&& strlen($request->input('myInput'))>14){

                try{
                                
                    $allClientes=DB::table('clientes')->where('clientes.CNPJ','like','%'.$request->myInput.'%')->get();
            
                    return view(' viewAtendimento',['atendimento'=> $atendimentos,'clientes'=> $allClientes , 'situacoes' => $Situacoes])->with('DATA',$formatted_dateCarbon);
                    
                }catch(Exception $e){

                    $erroMsm='Cliente não Localizado, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAtendimento',['atendimento' => $atendimentos, 'clientes' => $allClientes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
                }

            }
            
       
        return view(' viewAtendimento',['atendimento'=> $atendimentos,'clientes'=> $allClientes , 'situacoes' => $Situacoes])->with('DATA',$formatted_dateCarbon);       

        }catch(Exception $e){

            $erroMsm='Não foi possível acessar o serviço, tente novamente mais tarde ou entre em contato com o responsável do sistema.'; 
            return view('viewpaginaPrincipal',[ 'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
        }    
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
    public function CadastrarAtendimentos(Request $request){

        $date = Carbon::now('America/Sao_Paulo');
        $formatted_dateCarbon = $date->isoFormat('ddd DD [de] MMM YYYY HH:mm');

        try{

            $dataAtual = Carbon::now()->toDateString();
            $allClientes=cliente::all();
            $Situacoes=situacao_agenda::all();
            $atendimentos = agenda::where('agenda.tipo', '=', 'ATENDIMENTO')
                ->where('agenda.data_agenda', '=', $dataAtual)
                ->orderBy('agenda.data_agenda')
                ->orderBy('agenda.hora_agenda')
                ->get();

            if(isset($request->inputNomeClienteAT)){
                
                $insereNovoAtendimento = [ 
                    'CONTATO' => $request->input('CONTATO'),
                    'OPERADOR' => $request->input('OPERADOR'),
                    'ASSUNTO' => $request->input('ASSUNTO'),
                    'CLIENTE' => $request->input('inputCodClienteAT'),
                    'DATA_GRAVACAO' => $request->input('DATA_GRAVACAO'),
                    'DATA_AGENDA' => $request->input('DATA_AGENDA'),
                    'HORA_AGENDA' => $request->input('HORA_AGENDA'),
                    'SITUACAO' => $request->input('SITUACAO'),
                    'TIPO' => $request->input('TIPO'),
                    'HISTORICO' => $request->input('HISTORICO'),
                    'TELEFONE1' => $request->input('TELEFONE1'), 
                ];

                agenda::create($insereNovoAtendimento); 
                return view('viewSucessoCadastroAtendimento')->with('DATA',$formatted_dateCarbon);
            }

        }catch(Exception $e){

            $erroMsm='Não foi possível gravar seu Atendimento, verifique os dados informados ou contate o resposável pelo sistema.';           
            return response()->view('viewAtendimento',['atendimento' => $atendimentos, 'clientes' => $allClientes,'situacoes'=>$Situacoes,
                                    'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);

        }        
    }

    public function Treinamentos(Request $request){

        Carbon::setLocale('pt_BR');
        Carbon::setLocale('pt_BR.utf-8');
        Carbon::setLocale('portuguese');
    
        $date = Carbon::now('America/Sao_Paulo');
        $formatted_dateCarbon = $date->isoFormat('ddd DD [de] MMM YYYY HH:mm');

        try{

            $dataAtual = Carbon::now()->toDateString();
            $allClientes = DB::table('clientes')->paginate(20);
            $Situacoes=situacao_agenda::all();
            $treinamentos = agenda::where('agenda.tipo', '=', 'TREINAMENTO')
                ->where('agenda.data_agenda', '=', $dataAtual)
                ->orderBy('agenda.data_agenda')
                ->orderBy('agenda.hora_agenda')
                ->get();
            
        
            if(isset($request->inputCodCliente)&&isset($request->DtInicial)&&isset($request->DtFinal)){

                try{
                    $Filtro=agenda::where('agenda.tipo','=','TREINAMENTO')
                    ->where('agenda.cliente','=',$request->inputCodCliente)
                    ->whereBetween('agenda.data_agenda',[$request->DtInicial,$request->DtFinal])
                    ->get();

                    return view(' viewTreinamento',['treinamento'=> $Filtro,'clientes'=> $allClientes,'situacoes' => $Situacoes])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){
                    $erroMsm='Sua Consulta não pode ser realizada, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewTreinamento',['atendimento' => $treinamentos, 'clientes' => $allClientes,'situacoes'=> $Situacoes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
        
                }

            }else if(isset($request->inputCodCliente)){

                try{
                    $Filtro=agenda::where('agenda.tipo','=','TREINAMENTO')
                                ->where('agenda.cliente','=',$request->inputCodCliente)
                                ->get();
        
                    return view(' viewTreinamento',['treinamento'=> $Filtro,'clientes'=> $allClientes,'situacoes' => $Situacoes])->with('DATA',$formatted_dateCarbon);
                    
                }catch(Exception $e){
                    $erroMsm='Sua Consulta não pode ser realizada, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewTreinamento',['atendimento' => $treinamentos, 'clientes' => $allClientes,'situacoes'=> $Situacoes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
        
                }
            
            }else if(isset($request->DtInicial)&&isset($request->DtFinal)){

                try{
                    $Filtro=agenda::where('agenda.tipo','=','TREINAMENTO')
                                ->whereBetween('agenda.data_agenda',[$request->DtInicial,$request->DtFinal])
                                ->get();
        
                    return view(' viewTreinamento',['treinamento'=> $Filtro,'clientes'=> $allClientes,'situacoes' => $Situacoes])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){
                    $erroMsm='Sua Consulta não pode ser realizada, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewTreinamento',['atendimento' => $treinamentos, 'clientes' => $allClientes,'situacoes'=> $Situacoes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
        
                }
            }
            
            if(null!==$request->input('inputCliTreinamento')&&strlen($request->input('inputCliTreinamento'))==14){

                try{
                        
                    $allClientes=DB::table('clientes')->where('clientes.CPF','=',$request->inputCliTreinamento)->get();

            
                    return view(' viewTreinamento',['treinamento'=> $treinamentos,'clientes'=> $allClientes,'situacoes' => $Situacoes])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){
  
                    $erroMsm='Cliente não Localizado, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewTreinamento',['treinamento' => $treinamentos, 'clientes' => $allClientes,'situacoes'=> $Situacoes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
        
                }

                    
            }else if(null!==$request->input('inputCliTreinamento')&&strlen($request->input('inputCliTreinamento'))==18){
 
                try{
                                    
                    $allClientes=DB::table('clientes')->where('clientes.CNPJ','like','%'.$request->inputCliTreinamento.'%')->get();
                    
  
                    return view(' viewTreinamento',['treinamento'=> $treinamentos,'clientes'=> $allClientes,'situacoes' => $Situacoes])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                        $erroMsm='Cliente não Localizado, verifique os dados informados ou contate o resposável pelo sistema.';           
                        return response()->view('viewTreinamento',['atendimento' => $treinamentos, 'clientes' => $allClientes,'situacoes'=> $Situacoes,
                                                'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
                }

    
            }else if(null!==$request->input('inputCliTreinamento')&&strlen($request->input('inputCliTreinamento'))<14){
   
                try{

                    $allClientes=DB::table('clientes')->where('clientes.codigo','=',$request->inputCliTreinamento)->get();
 
                    return view(' viewTreinamento',['treinamento'=> $Filtro,'clientes'=> $allClientes,'situacoes' => $Situacoes])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Cliente não Localizado, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewTreinamento',['treinamento' => $treinamentos, 'clientes' => $allClientes,'situacoes'=> $Situacoes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);

                }
            }
            if(null!==$request->input('razaoFiltro')&&strlen($request->input('razaoFiltro'))>2){
                
                try{

                    $allClientes=DB::table('clientes')->where('clientes.nome','like','%'.$request->razaoFiltro.'%')->get();
                                            
                    return view(' viewTreinamento',['treinamento'=> $treinamentos,'clientes'=> $allClientes,'situacoes'=> $Situacoes])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Cliente não Localizado, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewTreinamento',['treinamento' => $treinamentos, 'clientes' => $allClientes,'situacoes'=> $Situacoes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
        
                }
            }
            if(null!==$request->input('razaoTR')&&strlen($request->input('razaoTR'))>2){
                
                try{

                    $allClientes=DB::table('clientes')->where('clientes.nome','like','%'.$request->razaoTR.'%')->get();
                                            
                    return view(' viewTreinamento',['treinamento'=> $treinamentos,'clientes'=> $allClientes,'situacoes'=> $Situacoes])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Cliente não Localizado, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewTreinamento',['treinamento' => $treinamentos, 'clientes' => $allClientes,'situacoes'=> $Situacoes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
        
                }
            }
        
        
            if(null!==$request->input('myInput')&&strlen($request->input('myInput'))<15){

                try{
                    $allClientes=DB::table('clientes')->where('clientes.CPF','=',$request->myInput)->get();
                                    
                    return view(' viewTreinamento',['treinamento'=> $treinamentos,'clientes'=> $allClientes,'situacoes'=> $Situacoes])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Cliente não Localizado, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewTreinamento',['treinamento' => $treinamentos, 'clientes' => $allClientes,'situacoes'=> $Situacoes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
        
                }
        
            }else  if(null!==$request->input('myInput')&&strlen($request->input('myInput'))>14){

                try{
                    $allClientes=DB::table('clientes')->where('clientes.CNPJ','like','%'.$request->myInput.'%')->get();
        
                    return view(' viewTreinamento',['treinamento'=> $treinamentos,'clientes'=> $allClientes,'situacoes'=> $Situacoes])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Cliente não Localizado, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewTreinamento',['treinamento' => $treinamentos, 'clientes' => $allClientes,'situacoes'=> $Situacoes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);

                }
            }

        
        return view(' viewTreinamento',['treinamento'=> $treinamentos],['clientes'=> $allClientes,'situacoes'=> $Situacoes])->with('DATA',$formatted_dateCarbon);   

        }catch(Exception $e){
            
            $erroMsm='Não foi possível acessar o serviço, tente novamente mais tarde ou entre em contato com o responsável do sistema.'; 
            return view('viewpaginaPrincipal',[ 'error' =>$erroMsm, 'DATA' => $formatted_dateCarbon]);

        }
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
    public function CadastrarTreinamentos(Request $request){

        Carbon::setLocale('pt_BR');
        Carbon::setLocale('pt_BR.utf-8');
        Carbon::setLocale('portuguese');
    
        $date = Carbon::now('America/Sao_Paulo');
        $formatted_dateCarbon = $date->isoFormat('ddd DD [de] MMM YYYY HH:mm');

        try{

            $dataAtual = Carbon::now()->toDateString();
            $allClientes=cliente::all();
            $Situacoes=situacao_agenda::all();
            $treinamentos = agenda::where('agenda.tipo', '=', 'TREINAMENTO')
                ->where('agenda.data_agenda', '=', $dataAtual)
                ->orderBy('agenda.data_agenda')
                ->orderBy('agenda.hora_agenda')
                ->get();

        if(isset($request->inputNomeClienteTR)){
            
            $insereNovoTreinamento = [ 
                'CONTATO' => $request->input('CONTATO'),
                'OPERADOR' => $request->input('OPERADOR'),
                'ASSUNTO' => $request->input('ASSUNTO'),
                'CLIENTE' => $request->input('inputCodClienteTR'),
                'DATA_GRAVACAO' => $request->input('DATA_GRAVACAO'),
                'DATA_AGENDA' => $request->input('DATA_AGENDA'),
                'HORA_AGENDA' => $request->input('HORA_AGENDA'),
                'SITUACAO' => $request->input('SITUACAO'),
                'TIPO' => $request->input('TIPO'),
                'HISTORICO' => $request->input('HISTORICO'),
                'TELEFONE1' => $request->input('TELEFONE1'), 
            ];

            agenda::create($insereNovoTreinamento); 
            return view('viewSucessoCadastroTreinamento')->with('DATA',$formatted_dateCarbon);}

        }catch(Exception $e){
            $erroMsm='Não foi possível registrar o Treinamento, verifique os dados informados ou contate o resposável pelo sistema.';           
            return response()->view('viewAtendimento',['atendimento' => $treinamentos, 'clientes' => $allClientes,'situacoes'=>$Situacoes,
                                    'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
        }
    }

    public function visualizarDetalhes($CODIGO) {
        try {

            $agenda = agenda::findOrFail($CODIGO);

            if ($agenda->CLIENTE > 999998) {
                
                $cliente = [
                    'cnpj' => "00.000.000/0001-00",
                    'cpf'=>"000.000.000-00",
                    'nome' => "Ainda não cadastrado",
                    'codigo' => "999999"
                ]; 

            }else{
                $cliente = cliente::findOrFail($agenda->CLIENTE);
            }


            return response()->json(['agenda' => $agenda, 'cliente' => $cliente]);
        } catch (Exception $e) {
            $erroMsm='Não foi possível localizar o Registro, verifique os dados informados ou contate o resposável pelo sistema.'; 
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function alterarSituacao(Request $request, $codigo) {
        try {
            $agenda = Agenda::findOrFail($codigo); // Encontra o registro pelo código
    
            $agenda->update([
                'SITUACAO' => $request->input('SITUACAO')
            ]);
    
            return response()->json(['message' => 'Situação atualizada com sucesso']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Não foi possível atualizar a situação'], 500);
        }
    }
    


    
    





  
}
