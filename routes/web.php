<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\sitePublicoController;
use App\Http\Controllers\Auth\LoginController;

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


Route:: get('/',[LoginController::class,'login'])->name('login');
Route:: post('/autenticar',[LoginController::class,'autenticar'])->name('autenticar');
Route:: get('/Politicas',[LoginController::class,'Politicas'])->name('Politicas');
Route:: get('/logout',[LoginController::class,'logout'])->name('logout');
Route:: get('/whatsapp', function(){
    return view('viewWhatsapp');
});
Route:: get('/whats', function(){
    dd(request()->all());
    //return view('viewWhatsWebsocket');
});

Route::middleware(['auth:vendedor'])->group(function(){
    Route:: get('/PaginaPrincipal',[SitePublicoController::class,'paginaPrincipal'])->name('PaginaPrincipal');
    
    Route:: any('/Agendamentos',[SitePublicoController::class,'Agendamentos']);
    Route:: any('/AgendamentosFiltrados',[SitePublicoController::class,'AgendamentosFiltrados']);
    Route:: any('/Agendamento',[SitePublicoController::class, 'CadastrarAgendamentos']);

    Route:: any('/Atendimentos',[SitePublicoController::class,'Atendimentos']);
    Route:: any('/AtendimentosFiltrados',[SitePublicoController::class,'AtendimentosFiltrados']);
    Route:: any('/Atendimento',[SitePublicoController::class, 'CadastrarAtendimentos']);

    Route:: any('/Treinamentos',[SitePublicoController::class,'Treinamentos']);
    Route:: any('/TreinamentosFiltrados',[SitePublicoController::class,'TreinamentosFiltrados']);
    Route:: any('/Treinamento',[SitePublicoController::class, 'CadastrarTreinamentos']);

    Route:: get('/visualizar/{CODIGO}',[SitePublicoController::class,'visualizarDetalhes']);
    Route:: post('/updateSituacao/{CODIGO}', [SitePublicoController::class, 'alterarSituacao']);

    Route:: get('/Instaladores',[SitePublicoController::class,'Install'])->name('Instaladores');

});




