<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\vendedor;


class LoginController extends Controller{

    /*public function showLoginForm()
    {
        return view('auth.login');
    }*/

    public function autenticar(Request $request){

        $requisicao= $request;
        $credenciais = $request->only('email', 'senha');


       /* $credenciais= $request->validate([
            'email' => ['required','email'],
            'senha' => ['required'],
        ]);*/
        if (Auth::guard('vendedor')->attempt($credenciais)) {
            return view('viewTEST',['requisicao'=>$requisicao]);
        }else{
            return view('viewTEST',['requisicao'=>$requisicao]);
        }
        

       
        // Tenta autenticar o vendedor
      
    }
}

