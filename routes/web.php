<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\sitePublicoController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Session;

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
Route:: any('/visualizar-webhook', function(){
    return view('viewWhatsWebsocket');
});
Route::any('/whats',[WebhookController::class,'handleWebhook']);
//Route::get('/visualizar-webhook',[WebhookController::class, 'visualizarWebhook']);
Route::get('/webhook-data', function () {

    $webhookData = Cache::get('webhookData');

    return response()->json(['data' => $webhookData]);
});


Route::middleware(['auth:vendedor'])->group(function(){
    Route:: get('/PaginaPrincipal',[sitePublicoController::class,'paginaPrincipal'])->name('PaginaPrincipal');
    
    Route:: any('/Agendamentos',[sitePublicoController::class,'Agendamentos']);
    Route:: any('/AgendamentosFiltrados',[sitePublicoController::class,'AgendamentosFiltrados']);
    Route:: any('/Agendamento',[sitePublicoController::class, 'CadastrarAgendamentos']);

    Route:: any('/Atendimentos',[sitePublicoController::class,'Atendimentos']);
    Route:: any('/AtendimentosFiltrados',[sitePublicoController::class,'AtendimentosFiltrados']);
    Route:: any('/Atendimento',[sitePublicoController::class, 'CadastrarAtendimentos']);

    Route:: any('/Treinamentos',[sitePublicoController::class,'Treinamentos']);
    Route:: any('/TreinamentosFiltrados',[sitePublicoController::class,'TreinamentosFiltrados']);
    Route:: any('/Treinamento',[sitePublicoController::class, 'CadastrarTreinamentos']);

    Route:: get('/visualizar/{CODIGO}',[sitePublicoController::class,'visualizarDetalhes']);
    Route:: post('/updateSituacao/{CODIGO}', [sitePublicoController::class, 'alterarSituacao']);

    Route:: get('/Instaladores',[sitePublicoController::class,'Install'])->name('Instaladores');

});




