<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use App\Models\vendedor;


class LoginController extends Controller{

    public function login()
    {

        return view('auth.login');
    }

    public function autenticar(Request $request){

        $dados = $request->all();
	    $EMAIL= $dados['EMAIL'];
	    $senha= $dados['SENHA'];

        /*try{*/

            $vendedor = Vendedor::where('EMAIL',$EMAIL)->first();
            if($vendedor!=null){
                $senhaEncrypt=bcrypt($vendedor->SENHA);

                if(Auth::check()||($vendedor && Hash::check($senha,$senhaEncrypt))){

                    Auth::login($vendedor);
            
                    //return redirect(route('PaginaPrincipal'))->withCookie(Cookie::forever('crm_galago_session', $cookivalue));
                    return redirect(route('PaginaPrincipal'));
                    
                    }else{
        
                    $erroMsm='Senha Inválida.';           
                    return response()->view('auth.login',['error' =>$erroMsm]);
                }

            }else{

                $erroMsm='Usuário Inválido.';           
                return response()->view('auth.login',['error' =>$erroMsm]);
            } 
        /*}catch(Exception $e){
            $erroMsm='Não Foi possível acessar o sistema, contate o administrador.';           
            return response()->view('auth.login',['error' =>$erroMsm]);

        }*/
      
    }
}

