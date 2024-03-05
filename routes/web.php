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
Route:: post('/Agendamento',[SitePublicoController::class, 'CadastrarAgendamentos']);

Route:: any('/Atendimentos',[SitePublicoController::class,'Atendimentos']);
Route:: any('/AtendimentosFiltrados',[SitePublicoController::class,'AtendimentosFiltrados']);
Route:: post('/Atendimento',[SitePublicoController::class, 'CadastrarAtendimentos']);

Route:: any('/Treinamentos',[SitePublicoController::class,'Treinamentos']);
Route:: any('/TreinamentosFiltrados',[SitePublicoController::class,'TreinamentosFiltrados']);
Route:: post('/Treinamento',[SitePublicoController::class, 'CadastrarTreinamentos']);
