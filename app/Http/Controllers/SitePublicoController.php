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
            $allClientes = DB::table('clientes')
                            ->where('clientes.desativado', '=','False')
                            ->paginate(20);

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
            
                    return view(' viewAgenda',['agenda'=> $Filtro,'clientes'=> $allClientes, 'situacoes' => $Situacoes, 'dtLimite' => $dataAtual])->with('DATA',$formatted_dateCarbon);

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
            
                    return view(' viewAgenda',['agenda'=> $Filtro,'clientes'=> $allClientes, 'situacoes' => $Situacoes, 'dtLimite' => $dataAtual])->with('DATA',$formatted_dateCarbon);

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
            
                    return view(' viewAgenda',['agenda'=> $Filtro,'clientes'=> $allClientes, 'situacoes' => $Situacoes, 'dtLimite' => $dataAtual])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Sua Consulta não pode ser realizada, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAgenda',['agenda' => $agenda, 'clientes' => $allClientes, 'situacoes' => $Situacoes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
                }
            }

            if(null!==$request->input('inputCliAgenda') && strlen($request->input('inputCliAgenda'))==14){

                try{

                     if($request->ativo==='true'){
                        $allClientes=DB::table('clientes')
                                        ->where('clientes.CPF', '=', $request->inputCliAgenda)
                                        ->where('clientes.desativado', '=','False')
                                        ->get();
                    }else{
                        $allClientes=DB::table('clientes')
                                        ->where('clientes.CPF', '=', $request->inputCliAgenda)
                                        ->where('clientes.desativado', '=','True')
                                        ->get();
                    }             
                                    
                    return view(' viewAgenda',['agenda'=> $agenda,'clientes'=> $allClientes, 'situacoes' => $Situacoes, 'dtLimite' => $dataAtual])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Sua Consulta não pode ser realizada, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAgenda',['agenda' => $agenda, 'clientes' => $allClientes, 'situacoes' => $Situacoes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
                }
            
            }else if(null!==$request->input('inputCliAgenda') && strlen($request->input('inputCliAgenda'))==18){
                
                try{
                    
                   
                    if($request->ativo==='true'){
                        $allClientes=DB::table('clientes')
                                        ->where('clientes.CNPJ','like','%'.$request->inputCliAgenda.'%')
                                        ->where('clientes.desativado', '=','False')
                                        ->get();
                    }else{
                        $allClientes=DB::table('clientes')
                                        ->where('clientes.CNPJ','like','%'.$request->inputCliAgenda.'%')
                                        ->where('clientes.desativado', '=','True')
                                        ->get();
                    }
                    

                    return view(' viewAgenda',['agenda'=> $agenda,'clientes'=> $allClientes, 'situacoes' => $Situacoes, 'dtLimite' => $dataAtual])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Sua Consulta não pode ser realizada, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAgenda',['agenda' => $agenda, 'clientes' => $allClientes, 'situacoes' => $Situacoes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
                }
            }else if(null!==$request->input('inputCliAgenda') && strlen($request->input('inputCliAgenda'))<14){
                
                try{
                    $allClientes=DB::table('clientes')->where('clientes.codigo','=',$request->inputCliAgenda)->get();
            
                    return view(' viewAgenda',['agenda'=> $agenda,'clientes'=> $allClientes, 'situacoes' => $Situacoes, 'dtLimite' => $dataAtual])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Sua Consulta não pode ser realizada, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAgenda',['agenda' => $agenda, 'clientes' => $allClientes, 'situacoes' => $Situacoes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
                }
            }
            if(null!==$request->input('razaoFiltro')&&strlen($request->input('razaoFiltro'))>2){
                
                try{

                    if($request->ativo==='true'){
                        $allClientes=DB::table('clientes')
                                        ->where(function ($query) use ($request) {
                                            $query->where('clientes.nome', 'like', '%' . $request->razaoFiltro . '%')
                                            ->orWhere('clientes.nomefantasia', 'like', '%' . $request->razaoFiltro . '%');
                                            })
                                        ->where('clientes.desativado','=','False')
                                        ->get();
                    }else{
                        $allClientes=DB::table('clientes')
                                        ->where(function ($query) use ($request) {
                                            $query->where('clientes.nome', 'like', '%' . $request->razaoFiltro . '%')
                                            ->orWhere('clientes.nomefantasia', 'like', '%' . $request->razaoFiltro . '%');
                                            })
                                        ->where('clientes.desativado', '=','True')
                                        ->get();
                    }
                                            
                    return view(' viewAgenda',['agenda'=> $agenda,'clientes'=> $allClientes, 'situacoes' => $Situacoes, 'dtLimite' => $dataAtual])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Sua Consulta não pode ser realizada, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAgenda',['agenda' => $agenda, 'clientes' => $allClientes, 'situacoes' => $Situacoes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
                }
            }
            if(null!==$request->input('razaoAG')&&strlen($request->input('razaoAG'))>2){
                
                try{
                    
                    if($request->ativo === 'true'){

                        $allClientes=DB::table('clientes')
                                    ->where(function ($query) use ($request) {
                                     $query->where('clientes.nome', 'like', '%' . $request->razaoAG . '%')
                                    ->orWhere('clientes.nomefantasia', 'like', '%' . $request->razaoAG . '%');
                                    })
                                        ->where('clientes.desativado', '=','False')
                                        ->get();
                    }else{
                        $allClientes=DB::table('clientes')
                                    ->where(function ($query) use ($request) {
                                     $query->where('clientes.nome', 'like', '%' . $request->razaoAG . '%')
                                    ->orWhere('clientes.nomefantasia', 'like', '%' . $request->razaoAG . '%');
                                    })
                                        ->where('clientes.desativado', '=','True')
                                        ->get();
                    }
                                            
                    return view(' viewAgenda',['agenda'=> $agenda,'clientes'=> $allClientes, 'situacoes' => $Situacoes, 'dtLimite' => $dataAtual])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Sua Consulta não pode ser realizada, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAgenda',['agenda' => $agenda, 'clientes' => $allClientes, 'situacoes' => $Situacoes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
                }
            }

            if(null!==$request->input('myInput')&& strlen($request->input('myInput'))<15){
                    
                try{

                    $allClientes=DB::table('clientes')->where('clientes.CPF','=',$request->myInput)->get();
                                            
                    return view(' viewAgenda',['agenda'=> $agenda,'clientes'=> $allClientes, 'situacoes' => $Situacoes, 'dtLimite' => $dataAtual])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Sua Consulta não pode ser realizada, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAgenda',['agenda' => $agenda, 'clientes' => $allClientes, 'situacoes' => $Situacoes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
                }
                        
            }else  if(null!==$request->input('myInput')&& strlen($request->input('myInput'))>14){

                try{
                                
                    $allClientes=DB::table('clientes')->where('clientes.CNPJ','like','%'.$request->myInput.'%')->get();
                
                    return view(' viewAgenda',['agenda'=> $agenda,'clientes'=> $allClientes, 'situacoes' => $Situacoes,'dtLimite' => $dataAtual])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Sua Consulta não pode ser realizada, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAgenda',['agenda' => $agenda, 'clientes' => $allClientes, 'situacoes' => $Situacoes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
                }
            }    return view(' viewAgenda',['agenda'=> $agenda,'clientes'=> $allClientes, 'situacoes' => $Situacoes,'dtLimite' => $dataAtual])->with('DATA',$formatted_dateCarbon);    
            
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

            $historico = nl2br($request->input('HISTORICO'));
            
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
                'HISTORICO' => $historico,
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
            $allClientes = DB::table('clientes')
                                ->where('clientes.desativado', '=','False')
                                ->paginate(20);
            $Situacoes=situacao_agenda::all();
            $atendimentos = agenda::where('agenda.tipo', '=', 'ATENDIMENTO')
                ->where('agenda.data_agenda', '=', $dataAtual)
                ->orderByDesc('agenda.data_agenda')
                ->orderByDesc('agenda.hora_agenda')
                ->get();
            
          
        
            if(isset($request->inputCodCliente)&&isset($request->DtInicial)&&isset($request->DtFinal)){
                
                try{ 
                    $Filtro=agenda::where('agenda.tipo','=','ATENDIMENTO')
                                    ->where('agenda.cliente','=',$request->inputCodCliente)
                                    ->whereBetween('agenda.data_agenda',[$request->DtInicial,$request->DtFinal])
                                    ->orderByDesc('agenda.data_agenda')
                                    ->get();
            
                    return view(' viewAtendimento',['atendimento'=> $Filtro,'clientes'=> $allClientes, 'situacoes' => $Situacoes, 'dtLimite' => $dataAtual])->with('DATA',$formatted_dateCarbon);
                }catch(Exception $e){

                    $erroMsm='Sua Consulta não pode ser realizada, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAtendimento',['atendimento' => $atendimentos, 'clientes' => $allClientes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon,]);
                }    
            
            }else if(isset($request->inputCodCliente)){
                
                try{
                    $Filtro=agenda::where('agenda.tipo','=','ATENDIMENTO')
                    ->where('agenda.cliente','=',$request->inputCodCliente)
                    ->orderByDesc('agenda.data_agenda')
                    ->get();

                    return view(' viewAtendimento',['atendimento'=> $Filtro,'clientes'=> $allClientes, 'situacoes' => $Situacoes, 'dtLimite' => $dataAtual])->with('DATA',$formatted_dateCarbon);
                }catch(Exception $e){

                    $erroMsm='Sua Consulta não pode ser realizada, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAtendimento',['atendimento' => $atendimentos, 'clientes' => $allClientes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon,]);
                } 
       
            }else if(isset($request->DtInicial)&&isset($request->DtFinal)){

                try{
                    $Filtro=agenda::where('agenda.tipo','=','ATENDIMENTO')
                                ->whereBetween('agenda.data_agenda',[$request->DtInicial,$request->DtFinal])
                                ->orderByDesc('agenda.data_agenda')
                                ->get();
        
                    return view(' viewAtendimento',['atendimento'=> $Filtro,'clientes'=> $allClientes, 'situacoes' => $Situacoes, 'dtLimite' => $dataAtual])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Sua Consulta não pode ser realizada, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAtendimento',['atendimento' => $atendimentos, 'clientes' => $allClientes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon,]);
                } 
            }
        
            if(null!==$request->input('inputCliAtendimento') && strlen($request->input('inputCliAtendimento'))==14){
                
                try{
                    
                    if($request->ativo==='true'){
                        $allClientes=DB::table('clientes')
                                        ->where('clientes.CPF','like','%'.$request->inputCliAtendimento.'%')
                                        ->where('clientes.desativado', '=','False')
                                        ->get();
                    }else{
                        $allClientes=DB::table('clientes')
                                        ->where('clientes.CPF','like','%'.$request->inputCliAtendimento.'%')
                                        ->where('clientes.desativado', '=','True')
                                        ->get();
                    }

                                
                    return view(' viewAtendimento',['atendimento'=> $atendimentos,'clientes'=> $allClientes, 'situacoes' => $Situacoes, 'dtLimite' => $dataAtual])->with('DATA',$formatted_dateCarbon);
                    
                }catch(Exception $e){

                    $erroMsm='Cliente não Localizado, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAtendimento',['atendimento' => $atendimentos, 'clientes' => $allClientes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
                }
            }else if(null!==$request->input('inputCliAtendimento') && strlen($request->input('inputCliAtendimento'))==18){

                try{
                                    
                    if($request->ativo==='true'){
                        $allClientes=DB::table('clientes')
                                        ->where('clientes.CNPJ','like','%'.$request->inputCliAtendimento.'%')
                                        ->where('clientes.desativado', '=','False')
                                        ->get();
                    }else{
                        $allClientes=DB::table('clientes')
                                        ->where('clientes.CNPJ','like','%'.$request->inputCliAtendimento.'%')
                                        ->where('clientes.desativado', '=','True')
                                        ->get();
                    }
            
                    return view(' viewAtendimento',['atendimento'=> $atendimentos,'clientes'=> $allClientes, 'situacoes' => $Situacoes, 'dtLimite' => $dataAtual])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Cliente não Localizado, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAtendimento',['atendimento' => $atendimentos, 'clientes' => $allClientes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
                }


            }else if(null!==$request->input('inputCliAtendimento') && strlen($request->input('inputCliAtendimento'))<14){

                try{
                                    
                $allClientes=DB::table('clientes')->where('clientes.codigo','=',$request->inputCliAtendimento)->get();
        
                return view(' viewAtendimento',['atendimento'=> $atendimentos,'clientes'=> $allClientes, 'situacoes' => $Situacoes, 'dtLimite' => $dataAtual])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Cliente não Localizado, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAtendimento',['atendimento' => $atendimentos, 'clientes' => $allClientes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
                }

            }
            if(null!==$request->input('razaoFiltro')&&strlen($request->input('razaoFiltro'))>2){
                
                try{


                    if($request->ativo==='true'){
                        $allClientes=DB::table('clientes')
                                        ->where(function ($query) use ($request) {
                                            $query->where('clientes.nome', 'like', '%' . $request->razaoFiltro . '%')
                                            ->orWhere('clientes.nomefantasia', 'like', '%' . $request->razaoFiltro . '%');
                                            })
                                        ->where('clientes.desativado', '=','False')
                                        ->get();
                    }else{
                        $allClientes=DB::table('clientes')
                                        ->where(function ($query) use ($request) {
                                            $query->where('clientes.nome', 'like', '%' . $request->razaoFiltro . '%')
                                            ->orWhere('clientes.nomefantasia', 'like', '%' . $request->razaoFiltro . '%');
                                            })
                                        ->where('clientes.desativado', '=','True')
                                        ->get();
                    }
                    
                                            
                    return view(' viewAtendimento',['atendimento'=> $atendimentos,'clientes'=> $allClientes, 'situacoes' => $Situacoes, 'dtLimite' => $dataAtual])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Cliente não Localizado, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAtendimento',['atendimento' => $atendimentos, 'clientes' => $allClientes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
                }
            }
            if(null!==$request->input('razaoAT')&&strlen($request->input('razaoAT'))>2){
                
                try{

                    if($request->ativo==='true'){
                        $allClientes=DB::table('clientes')
                                        ->where(function ($query) use ($request) {
                                            $query->where('clientes.nome', 'like', '%' . $request->razaoAT . '%')
                                            ->orWhere('clientes.nomefantasia', 'like', '%' . $request->razaoAT . '%');
                                            })
                                        ->where('clientes.desativado', '=','False')
                                        ->get();
                    }else{
                        $allClientes=DB::table('clientes')
                                        ->where(function ($query) use ($request) {
                                            $query->where('clientes.nome', 'like', '%' . $request->razaoAT . '%')
                                            ->orWhere('clientes.nomefantasia', 'like', '%' . $request->razaoAT . '%');
                                            })
                                        ->where('clientes.desativado', '=','True')
                                        ->get();
                    }
                                            
                    return view(' viewAtendimento',['atendimento'=> $atendimentos,'clientes'=> $allClientes, 'situacoes' => $Situacoes, 'dtLimite' => $dataAtual])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Cliente não Localizado, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAtendimento',['atendimento' => $atendimentos, 'clientes' => $allClientes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
                }
            }
        
            if(null!==$request->input('myInput')&& strlen($request->input('myInput'))<15){
            
                try{
                            

                    if($request->ativo==='true'){
                        $allClientes=DB::table('clientes')
                                        ->where('clientes.CNPJ','like','%'.$request->myInput.'%')
                                        ->where('clientes.desativado', '=','False')
                                        ->get();
                    }else{
                        $allClientes=DB::table('clientes')
                                        ->where('clientes.CNPJ','like','%'.$request->myInput.'%')
                                        ->where('clientes.desativado', '=','True')
                                        ->get();
                    }
                                        
                    return view(' viewAtendimento',['atendimento'=> $atendimentos,'clientes'=> $allClientes, 'situacoes' => $Situacoes, 'dtLimite' => $dataAtual])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Cliente não Localizado, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAtendimento',['atendimento' => $atendimentos, 'clientes' => $allClientes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
                }

                    
            }else  if(null!==$request->input('myInput')&& strlen($request->input('myInput'))>14){

                try{
                                
                    if($request->ativo==='true'){
                        $allClientes=DB::table('clientes')
                                        ->where('clientes.CNPJ','like','%'.$request->myInput.'%')
                                        ->where('clientes.desativado', '=','False')
                                        ->get();
                    }else{
                        $allClientes=DB::table('clientes')
                                        ->where('clientes.CNPJ','like','%'.$request->myInput.'%')
                                        ->where('clientes.desativado', '=','True')
                                        ->get();
                    }
            
                    return view(' viewAtendimento',['atendimento'=> $atendimentos,'clientes'=> $allClientes , 'situacoes' => $Situacoes, 'dtLimite' => $dataAtual])->with('DATA',$formatted_dateCarbon);
                    
                }catch(Exception $e){

                    $erroMsm='Cliente não Localizado, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewAtendimento',['atendimento' => $atendimentos, 'clientes' => $allClientes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
                }

            }
            
       
        return view(' viewAtendimento',['atendimento'=> $atendimentos,'clientes'=> $allClientes , 'situacoes' => $Situacoes, 'dtLimite' => $dataAtual])->with('DATA',$formatted_dateCarbon);       

        }catch(Exception $e){

            $erroMsm='Não foi possível acessar o serviço, tente novamente mais tarde ou entre em contato com o responsável do sistema.'; 
            return view('viewpaginaPrincipal',[ 'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
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
                ->orderByDesc('agenda.data_agenda')
                ->orderByDesc('agenda.hora_agenda')
                ->get();

            if(isset($request->inputNomeClienteAT)){

                $historico = nl2br($request->input('HISTORICO'));
                
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
                    'HISTORICO' => $historico,
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
            $allClientes = DB::table('clientes')
                            ->where('clientes.desativado', '=','False')
                            ->paginate(20);
            $Situacoes=situacao_agenda::all();
            $treinamentos = agenda::where('agenda.tipo', '=', 'TREINAMENTO')
                ->where('agenda.data_agenda', '=', $dataAtual)
                ->orderByDesc('agenda.data_agenda')
                ->orderByDesc('agenda.hora_agenda')
                ->get();
            
        
            if(isset($request->inputCodCliente)&&isset($request->DtInicial)&&isset($request->DtFinal)){

                try{
                    $Filtro=agenda::where('agenda.tipo','=','TREINAMENTO')
                    ->where('agenda.cliente','=',$request->inputCodCliente)
                    ->whereBetween('agenda.data_agenda',[$request->DtInicial,$request->DtFinal])
                    ->orderByDesc('agenda.data_agenda')
                    ->get();

                    return view(' viewTreinamento',['treinamento'=> $Filtro,'clientes'=> $allClientes,'situacoes' => $Situacoes, 'dtLimite' => $dataAtual])->with('DATA',$formatted_dateCarbon);

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
        
                    return view(' viewTreinamento',['treinamento'=> $Filtro,'clientes'=> $allClientes,'situacoes' => $Situacoes, 'dtLimite' => $dataAtual])->with('DATA',$formatted_dateCarbon);
                    
                }catch(Exception $e){
                    $erroMsm='Sua Consulta não pode ser realizada, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewTreinamento',['atendimento' => $treinamentos, 'clientes' => $allClientes,'situacoes'=> $Situacoes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
        
                }
            
            }else if(isset($request->DtInicial)&&isset($request->DtFinal)){

                try{
                    $Filtro=agenda::where('agenda.tipo','=','TREINAMENTO')
                                ->whereBetween('agenda.data_agenda',[$request->DtInicial,$request->DtFinal])
                                ->orderByDesc('agenda.data_agenda')
                                ->get();
        
                    return view(' viewTreinamento',['treinamento'=> $Filtro,'clientes'=> $allClientes,'situacoes' => $Situacoes, 'dtLimite' => $dataAtual])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){
                    $erroMsm='Sua Consulta não pode ser realizada, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewTreinamento',['atendimento' => $treinamentos, 'clientes' => $allClientes,'situacoes'=> $Situacoes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
        
                }
            }
            
            if(null!==$request->input('inputCliTreinamento')&&strlen($request->input('inputCliTreinamento'))==14){

                try{
                        
                    if($request->ativo==='true'){
                        $allClientes=DB::table('clientes')
                                        ->where('clientes.CPF','like','%'.$request->inputCliTreinamento.'%')
                                        ->where('clientes.desativado', '=','False')
                                        ->get();
                    }else{
                        $allClientes=DB::table('clientes')
                                        ->where('clientes.CPF','like','%'.$request->inputCliTreinamento.'%')
                                        ->where('clientes.desativado', '=','True')
                                        ->get();
                    }

            
                    return view(' viewTreinamento',['treinamento'=> $treinamentos,'clientes'=> $allClientes,'situacoes' => $Situacoes, 'dtLimite' => $dataAtual])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){
  
                    $erroMsm='Cliente não Localizado, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewTreinamento',['treinamento' => $treinamentos, 'clientes' => $allClientes,'situacoes'=> $Situacoes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
        
                }

                    
            }else if(null!==$request->input('inputCliTreinamento')&&strlen($request->input('inputCliTreinamento'))==18){
 
                try{
                                    

                    if($request->ativo==='true'){
                        $allClientes=DB::table('clientes')
                                        ->where('clientes.CNPJ','like','%'.$request->inputCliTreinamento.'%')
                                        ->where('clientes.desativado', '=','False')
                                        ->get();
                    }else{
                        $allClientes=DB::table('clientes')
                                        ->where('clientes.CNPJ','like','%'.$request->inputCliTreinamento.'%')
                                        ->where('clientes.desativado', '=','True')
                                        ->get();
                    }
                    
  
                    return view(' viewTreinamento',['treinamento'=> $treinamentos,'clientes'=> $allClientes,'situacoes' => $Situacoes, 'dtLimite' => $dataAtual])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                        $erroMsm='Cliente não Localizado, verifique os dados informados ou contate o resposável pelo sistema.';           
                        return response()->view('viewTreinamento',['atendimento' => $treinamentos, 'clientes' => $allClientes,'situacoes'=> $Situacoes,
                                                'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
                }

    
            }else if(null!==$request->input('inputCliTreinamento')&&strlen($request->input('inputCliTreinamento'))<14){
   
                try{

                    $allClientes=DB::table('clientes')->where('clientes.codigo','=',$request->inputCliTreinamento)->get();
 
                    return view(' viewTreinamento',['treinamento'=> $Filtro,'clientes'=> $allClientes,'situacoes' => $Situacoes, 'dtLimite' => $dataAtual])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Cliente não Localizado, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewTreinamento',['treinamento' => $treinamentos, 'clientes' => $allClientes,'situacoes'=> $Situacoes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);

                }
            }
            if(null!==$request->input('razaoFiltro')&&strlen($request->input('razaoFiltro'))>2){
                
                try{

                    if($request->ativo==='true'){
                        $allClientes=DB::table('clientes')
                                        ->where(function ($query) use ($request) {
                                            $query->where('clientes.nome', 'like', '%' . $request->razaoFiltro . '%')
                                            ->orWhere('clientes.nomefantasia', 'like', '%' . $request->razaoFiltro . '%');
                                            })
                                        ->where('clientes.desativado', '=','False')
                                        ->get();
                    }else{
                        $allClientes=DB::table('clientes')
                                        ->where(function ($query) use ($request) {
                                            $query->where('clientes.nome', 'like', '%' . $request->razaoFiltro . '%')
                                            ->orWhere('clientes.nomefantasia', 'like', '%' . $request->razaoFiltro . '%');
                                            })
                                        ->where('clientes.desativado', '=','True')
                                        ->get();
                    }
                                            
                    return view(' viewTreinamento',['treinamento'=> $treinamentos,'clientes'=> $allClientes,'situacoes'=> $Situacoes, 'dtLimite' => $dataAtual])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Cliente não Localizado, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewTreinamento',['treinamento' => $treinamentos, 'clientes' => $allClientes,'situacoes'=> $Situacoes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
        
                }
            }
            if(null!==$request->input('razaoTR')&&strlen($request->input('razaoTR'))>2){
                
                try{

                    if($request->ativo==='true'){
                        $allClientes=DB::table('clientes')
                                        ->where(function ($query) use ($request) {
                                            $query->where('clientes.nome', 'like', '%' . $request->razaoTR . '%')
                                            ->orWhere('clientes.nomefantasia', 'like', '%' . $request->razaoTR . '%');
                                            })
                                        ->where('clientes.desativado', '=','False')
                                        ->get();
                    }else{
                        $allClientes=DB::table('clientes')
                                        ->where(function ($query) use ($request) {
                                            $query->where('clientes.nome', 'like', '%' . $request->razaoTR . '%')
                                            ->orWhere('clientes.nomefantasia', 'like', '%' . $request->razaoTR . '%');
                                            })
                                        ->where('clientes.desativado', '=','True')
                                        ->get();
                    }
                                            
                    return view(' viewTreinamento',['treinamento'=> $treinamentos,'clientes'=> $allClientes,'situacoes'=> $Situacoes, 'dtLimite' => $dataAtual])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Cliente não Localizado, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewTreinamento',['treinamento' => $treinamentos, 'clientes' => $allClientes,'situacoes'=> $Situacoes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
        
                }
            }
        
        
            if(null!==$request->input('myInput')&&strlen($request->input('myInput'))<15){

                try{

                    if($request->ativo==='true'){
                        $allClientes=DB::table('clientes')
                                        ->where('clientes.CPF','like','%'.$request->myInput.'%')
                                        ->where('clientes.desativado', '=','False')
                                        ->get();
                    }else{
                        $allClientes=DB::table('clientes')
                                        ->where('clientes.CPF','like','%'.$request->myInput.'%')
                                        ->where('clientes.desativado', '=','True')
                                        ->get();
                    }
                                    
                    return view(' viewTreinamento',['treinamento'=> $treinamentos,'clientes'=> $allClientes,'situacoes'=> $Situacoes, 'dtLimite' => $dataAtual])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Cliente não Localizado, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewTreinamento',['treinamento' => $treinamentos, 'clientes' => $allClientes,'situacoes'=> $Situacoes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);
        
                }
        
            }else  if(null!==$request->input('myInput')&&strlen($request->input('myInput'))>14){

                try{
                    
                    if($request->ativo==='true'){
                        $allClientes=DB::table('clientes')
                                        ->where('clientes.CNPJ','like','%'.$request->myInput.'%')
                                        ->where('clientes.desativado', '=','False')
                                        ->get();
                    }else{
                        $allClientes=DB::table('clientes')
                                        ->where('clientes.CNPJ','like','%'.$request->myInput.'%')
                                        ->where('clientes.desativado', '=','True')
                                        ->get();
                    }
        
                    return view(' viewTreinamento',['treinamento'=> $treinamentos,'clientes'=> $allClientes,'situacoes'=> $Situacoes, 'dtLimite' => $dataAtual])->with('DATA',$formatted_dateCarbon);

                }catch(Exception $e){

                    $erroMsm='Cliente não Localizado, verifique os dados informados ou contate o resposável pelo sistema.';           
                    return response()->view('viewTreinamento',['treinamento' => $treinamentos, 'clientes' => $allClientes,'situacoes'=> $Situacoes,
                                            'error' =>$erroMsm,'DATA' => $formatted_dateCarbon]);

                }
            }

        
        return view(' viewTreinamento',['treinamento'=> $treinamentos],['clientes'=> $allClientes,'situacoes'=> $Situacoes, 'dtLimite' => $dataAtual])->with('DATA',$formatted_dateCarbon);   

        }catch(Exception $e){
            
            $erroMsm='Não foi possível acessar o serviço, tente novamente mais tarde ou entre em contato com o responsável do sistema.'; 
            return view('viewpaginaPrincipal',[ 'error' =>$erroMsm, 'DATA' => $formatted_dateCarbon]);

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
                ->orderByDesc('agenda.data_agenda')
                ->orderByDesc('agenda.hora_agenda')
                ->get();

        if(isset($request->inputNomeClienteTR)){

            $historico = nl2br($request->input('HISTORICO'));
            
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
                'HISTORICO' => $historico,
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

    public function visualizarDetalhes($CODIGO,Request $request) {
        try {
            
            //$removerFormatacao = $request->query('removerFormatacao');

            if($request->removerFormatacao=='true'){
                
                $agenda = agenda::findOrFail($CODIGO);
                $agenda->HISTORICO = strip_tags(htmlspecialchars_decode($agenda->HISTORICO));
            
            }else{
                
                $agenda = agenda::findOrFail($CODIGO);
            }


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
            $historico = nl2br($request->input('HISTORICO'));

            if(null!==$request->ASSUNTO&&null!==$request->SITUACAO&&null!==$request->TELEFONE1){

                $agenda->update([
                    'ASSUNTO' => $request->input('ASSUNTO'),
                    'SITUACAO' => $request->input('SITUACAO'),
                    'TELEFONE1' => $request->input('TELEFONE1'),
                    'HISTORICO' => $historico
    
                ]);
                return response()->json(['message' => 'Situação atualizada com sucesso']);
            }
            
            return response()->json(['error' => 'Não foi possível atualizar a situação'], 500);
            
        } catch (Exception $e) {
            return response()->json(['error' => 'Não foi possível atualizar a situação'], 500);
        }
    }

    public function Install(){
        return view('viewInstaladores');
    }
    


    
    





  
}
