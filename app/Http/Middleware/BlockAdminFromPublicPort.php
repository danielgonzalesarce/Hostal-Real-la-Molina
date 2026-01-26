<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockAdminFromPublicPort
{
    /**
     * Handle an incoming request.
     * 
     * Bloquea el acceso a rutas admin desde el puerto público (8000).
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // En producción, no bloquear por puerto (todo está en el mismo dominio)
        // Solo bloquear en desarrollo local
        if (app()->environment('production')) {
            return $next($request);
        }
        
        $adminPort = env('ADMIN_PORT', 8001);
        $publicPort = env('PUBLIC_PORT', 8000);
        $currentPort = $request->getPort();
        
        // Si la petición viene del puerto público y está intentando acceder a rutas admin, bloquear
        if ($currentPort == $publicPort && $request->is('admin*')) {
            abort(404, 'Panel administrativo no disponible en este puerto. Accede desde http://localhost:' . $adminPort . '/admin/login');
        }
        
        return $next($request);
    }
}

