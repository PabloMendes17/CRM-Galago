<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $headers = [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Headers' => 'Content-Type, X-Token, Authorization',
            'Access-Control-Expose-Headers' => 'Content-Length, Content-Range',
        ];

        // Verifica se é uma requisição OPTIONS
        if ($request->getMethod() === 'OPTIONS') {
            // Retorna uma resposta vazia com os cabeçalhos CORS definidos
            return response()->json([], 200)->withHeaders($headers);
        }

        // Continua a requisição normalmente
        $response = $next($request);

        // Adiciona os cabeçalhos CORS à resposta
        foreach ($headers as $key => $value) {
            $response->headers->set($key, $value);
        }

        return $response;
    }
}
