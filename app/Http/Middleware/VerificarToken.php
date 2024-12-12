<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerificarToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->session()->has('token')) {
            return redirect()->route('login')->with('error', 'Você deve estar logado para acessar esta página.');
        }

        return $next($request);
    }
}
