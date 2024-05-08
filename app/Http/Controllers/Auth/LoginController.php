<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Vendedor;
use Exception;


class LoginController extends Controller{

    public function login(){

        return view('auth.login');
    }
    public function Politicas(){

        return view('viewPoliticasDePrivacidade');
    }

    public function autenticar(Request $request){

        $credentials = $request->validate([
         
            'email' => ['required', 'EMAIL'],
            'password' => ['required'],
        ]);

       try{

            $user = Vendedor::where('email', $request->email)->first();

            if(!$user){
                return back()->withErrors([
                    'email' => 'Usuário Inválido.',
                ]);

            }elseif(Auth::guard('vendedor')->attempt($credentials,$remember = true)) {

                    $request->session()->regenerate();

                    return redirect()->intended('PaginaPrincipal');
            }

            
            return back()->withErrors([
                'email' => 'Senha Inválida.',
            ])->withInput($request->only('email'));

       }catch (Exception $e){

            return back()->withErrors([
                'email' => 'Servidor Inoperante entre em contato com suporte.',
            ]);

       }
      

    }

    public function logout(Request $request){
        Auth::guard('vendedor')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return view('auth.login');
    }
}
