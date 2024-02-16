<?php

use App\Http\Controllers\ParametrosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\sitePublicoController;
use App\Http\Controllers\ProdutoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/welcome', function () {
    return view('welcome');
});*/

Route:: get('/',[SitePublicoController::class,'paginaPrincipal']);
Route:: any('/Agendamentos',[SitePublicoController::class,'Agendamentos']);
Route:: any('/AgendamentosFiltrados',[SitePublicoController::class,'AgendamentosFiltrados']);
Route::get('/AgendamentosFiltrados/{valor}',[SitePublicoController::class, 'AgendamentosFiltrados'])->name('chamar.funcao');
Route:: get('/Atendimentos',[SitePublicoController::class,'Atendimentos']);
Route:: any('/AtendimentosFiltrados',[SitePublicoController::class,'AtendimentosFiltrados']);
Route:: get('/Treinamentos',[SitePublicoController::class,'Treinamentos']);
Route:: any('/TreinamentosFiltrados',[SitePublicoController::class,'TreinamentosFiltrados']);
Route:: get('/vitrine',[SitePublicoController::class,'produtos']);
Route:: get('/info',[sitePublicoController::class,'info']);
Route:: get('/parametros',[ParametrosController::class,'acessandoParametrosViaRequest']);
Route:: get('/formsExibe',[ParametrosController::class,'formularioExibir']);
Route:: post('/formsRecebe',[ParametrosController::class,'formularioReceber']);
Route:: get('/produtos/listar',[ProdutoController::class,'listar']);
Route:: get('/produtos/listar',[ProdutoController::class,'ListaDeClientes']);
Route:: get ('/cadastrar',[ProdutoController::class,'CadastroAbrir']);
Route:: post ('/cadastrar',[ProdutoController::class,'CadastroProcessar']);