<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;

class WebhookController extends Controller
{

    public function handleWebhook(Request $request){

        $webhookRecebido = $request->json()->all();
        $webhookDoChache= Cache::get('webhookData',[]);
        $webhookRecebido[]  = $webhookDoChache;
        Cache::put('webhookData', $webhookRecebido, 3600);
        return response()->json(['message' => 'Webhook recebido com sucesso'], 200);
    }
    public function visualizarWebhook() {

        $webhookData = Cache::get('webhookData');

        return view('viewWhatsWebsocket', compact('webhookData'));
    }
}
