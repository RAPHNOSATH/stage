<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class RedirectAuthenticatedUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifier si l'utilisateur est déjà authentifié
        if (Auth::check()) {
            // Rediriger en fonction du type d'utilisateur
            return redirect()->middleware('auth');
        }else{
            if(Auth::guard('membre')->check()){
                return redirect()->middleware('auth:membre');
            }
        }

        return $next($request);
    }
}
