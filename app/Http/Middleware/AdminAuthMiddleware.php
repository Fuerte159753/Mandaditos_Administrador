<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('loginadmin')->withErrors(['message' => 'Debe iniciar sesión como administrador']);
        }

        return $next($request);
    }
}
