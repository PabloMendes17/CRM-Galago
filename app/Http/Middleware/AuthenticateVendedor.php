<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

class AuthenticateVendedor
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    
    public function handle($request, $next)
    {
        if (Auth::guard('vendedor')->check() === false ) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}