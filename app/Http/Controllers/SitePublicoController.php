<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class SitePublicoController extends Controller
{
    public function paginaPrincipal(){

        return view('viewpaginaPrincipal');
    }
}
