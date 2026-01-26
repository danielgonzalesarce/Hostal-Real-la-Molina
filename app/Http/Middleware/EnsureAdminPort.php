<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminPort
{
    /**
     * Handle an incoming request.
     * 
     * Verifica que las rutas admin solo sean accesibles desde el puerto configurado para admin.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // En producción, no verificar puertos (todo está en el mismo dominio)
        // Solo verificar en desarrollo local
        if (app()->environment('production')) {
            return $next($request);
        }
        
        $adminPort = env('ADMIN_PORT', 8001);
        $currentPort = $request->getPort();
        
        // Si la petición viene del puerto de admin, permitir acceso
        if ($currentPort == $adminPort) {
            return $next($request);
        }
        
        // Si no viene del puerto correcto, redirigir al puerto de admin
        // Solo redirigir si es una petición GET (no POST, PUT, DELETE, etc.)
        if ($request->isMethod('GET')) {
            $url = $request->getScheme() . '://' . $request->getHost() . ':' . $adminPort . $request->getRequestUri();
            return redirect($url);
        }
        
        // Para otros métodos HTTP, devolver error 403
        abort(403, 'El panel administrativo solo es accesible desde el puerto ' . $adminPort);
    }
}

