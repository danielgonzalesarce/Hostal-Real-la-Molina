<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Usar el guard 'admin' para verificar autenticación
        if (!auth('admin')->check()) {
            // Si no está autenticado con el guard admin, redirigir al login admin
            return redirect()->route('admin.login');
        }

        if (auth('admin')->user()->role !== 'admin') {
            // Si está autenticado pero no es admin, redirigir al login admin con mensaje
            return redirect()->route('admin.login')
                ->with('error', 'Acceso denegado. Solo administradores pueden acceder a esta sección.');
        }

        return $next($request);
    }
}
