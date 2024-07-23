<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CorsWebsocketMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Adicione os cabeçalhos CORS para WebSocket
        $headers = [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Headers' => 'Content-Type, X-Token, Authorization',
            'Access-Control-Expose-Headers' => 'Content-Length, Content-Range',
        ];

        // Verifica se é uma solicitação WebSocket
        if ($request->headers->get('Upgrade') == 'websocket') {
            // Retorna uma resposta vazia para as solicitações de handshake
            return $next($request);
        }

        // Continua a requisição normalmente
        $response = $next($request);

        // Adiciona os cabeçalhos CORS à resposta HTTP
        foreach ($headers as $key => $value) {
            $response->headers->set($key, $value);
        }

        return $response;
    
    }
}
