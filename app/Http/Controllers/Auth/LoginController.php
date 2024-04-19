<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


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
       
        if (Auth::guard('vendedor')->attempt($credentials,$remember = true)) {

            $request->session()->regenerate();

            return redirect()->intended('PaginaPrincipal');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');

    }

    public function logout(Request $request){
        Auth::guard('vendedor')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return view('auth.login');
    }
}
