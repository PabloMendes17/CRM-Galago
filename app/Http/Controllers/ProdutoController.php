<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Produto;

class ProdutoController extends Controller
{
    public function listar(){

        $produtos= new Produto();
        $produtos= $produtos->getListaDeProdutos();   

        return view('viewProdutoListar',compact('produtos'));
    }
    public function cadastroAbrir(){
       
        return view('viewProdutoCadastro');
    }
    public function cadastroProcessar(Request $request){

        $result=Produto::cadastrar($request->prodDesc,$request->prodVal);
        if($result=="Sucesso"){

            return view('viewProdutoSucesso');
        }else{


            return view('viewProdutoCadastro',compact('result','request'));
        }


    }
}
