<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

class CustomizeDebugMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifique se o usuário está autenticado e se é o usuário específico
        if (Auth::check() && Auth::user()->CPF == '42338762800') {
            // Ativa o modo de debug
            Config::set('app.debug', true);
        } else {
            // Desativa o modo de debug
            Config::set('app.debug', false);
        }

        return $next($request);
    }
}
